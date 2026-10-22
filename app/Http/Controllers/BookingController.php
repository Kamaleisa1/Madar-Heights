<?php

namespace App\Http\Controllers;

use App\Mail\NewBookingMail;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Throwable;

class BookingController extends Controller
{
    /**
     * Validate the booking request, keep a copy in the log,
     * then hand the customer over to WhatsApp with a ready message.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\s\-()]{8,20}$/'],
            'service' => ['required', Rule::in(array_keys(array_filter(config('site.services'), fn ($s) => empty($s['soon']))))],
            'city' => ['required', Rule::in(array_keys(config('site.cities')))],
            'notes' => ['nullable', 'string', 'max:500'],
            'website' => ['prohibited'], // honeypot
        ], [], [
            'name' => __('الاسم'),
            'phone' => __('رقم الجوال'),
            'service' => __('الخدمة'),
            'city' => __('المدينة'),
            'notes' => __('الملاحظات'),
        ]);

        unset($data['website']);

        Log::channel('bookings')->info('New booking', $data + ['locale' => app()->getLocale(), 'ip' => $request->ip()]);
        $this->saveAndNotify($data, $request);

        $lines = [
            __('طلب خدمة جديد من موقع :name', ['name' => config('site.name')]),
            __('الاسم').': '.$data['name'],
            __('الجوال').': '.$data['phone'],
            __('الخدمة').': '.config('site.services.'.$data['service'].'.title'),
            __('المدينة').': '.config('site.cities.'.$data['city'].'.name'),
        ];
        if (! empty($data['notes'])) {
            $lines[] = __('ملاحظات').': '.$data['notes'];
        }

        return redirect()->away(
            'https://wa.me/'.config('site.whatsapp').'?text='.rawurlencode(implode("\n", $lines))
        );
    }

    /**
     * Keep the request in the dashboard and email it. Neither step may stop the
     * customer from reaching WhatsApp, so failures are only logged.
     */
    protected function saveAndNotify(array $data, Request $request): void
    {
        try {
            $booking = Booking::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'service_slug' => $data['service'],
                'service_title' => config('site.services.'.$data['service'].'.title'),
                'city_slug' => $data['city'],
                'city_name' => config('site.cities.'.$data['city'].'.name'),
                'notes' => $data['notes'] ?? null,
                'locale' => app()->getLocale(),
                'ip' => $request->ip(),
            ]);
        } catch (Throwable $e) {
            Log::warning('Booking not saved: '.$e->getMessage());

            return;
        }

        $emails = config('site.notify_emails') ?: [];
        if ($emails) {
            try {
                Mail::to($emails)->send(new NewBookingMail($booking));
            } catch (Throwable $e) {
                Log::warning('Booking email failed: '.$e->getMessage());
            }
        }
    }
}
