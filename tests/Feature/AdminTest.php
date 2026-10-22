<?php

namespace Tests\Feature;

use App\Mail\NewBookingMail;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Setting;
use App\Models\UiText;
use App\Models\User;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SiteContentSeeder::class);
    }

    public function test_admin_requires_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/login')->assertOk();
    }

    public function test_every_admin_page_opens_for_a_logged_in_user(): void
    {
        $this->actingAs(User::factory()->create());

        $pages = ['/admin', '/admin/settings', '/admin/services', '/admin/services/create', '/admin/cities',
            '/admin/testimonials', '/admin/faqs', '/admin/posts', '/admin/bookings', '/admin/ui-texts', '/admin/users'];
        foreach ($pages as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/admin/services/'.Service::first()->id.'/edit')->assertOk();
        $this->get('/admin/ui-texts/'.UiText::first()->id.'/edit')->assertOk();
    }

    public function test_site_shows_content_from_the_database(): void
    {
        $service = Service::where('slug', 'ac-cleaning')->first();
        $service->update(['title_ar' => 'غسيل مكيفات معدل', 'title_en' => 'Edited AC']);

        $this->get('/services')->assertSee('غسيل مكيفات معدل');
        $this->get('/en/services')->assertSee('Edited AC');

        $service->update(['is_visible' => false]);
        $this->get('/services')->assertDontSee('غسيل مكيفات معدل');
        $this->get('/services/ac-cleaning')->assertNotFound();
    }

    public function test_interface_texts_can_be_overridden(): void
    {
        UiText::where('key', 'اطلب الخدمة')->first()->update(['ar' => 'احجز موعدك', 'en' => 'Book your visit']);

        $this->get('/')->assertSee('احجز موعدك');
        $this->get('/en')->assertSee('Book your visit');
    }

    public function test_settings_change_phone_everywhere(): void
    {
        $s = Setting::find('site');
        $s->update(['value' => array_merge($s->value, ['phone_display' => '+966 50 000 0000'])]);

        $this->get('/')->assertSee('+966 50 000 0000');
    }

    public function test_booking_is_saved_and_emailed(): void
    {
        Mail::fake();
        $s = Setting::find('site');
        $s->update(['value' => array_merge($s->value, ['notify_emails' => ['owner@example.com']])]);

        $this->withoutMiddleware(ValidateCsrfToken::class)->post('/booking', [
            'name' => 'أحمد', 'phone' => '0551234567', 'service' => 'ac-cleaning', 'city' => 'khobar',
        ])->assertRedirectContains('wa.me');

        $booking = Booking::sole();
        $this->assertSame('غسيل المكيفات', $booking->service_title);
        $this->assertSame('الخبر', $booking->city_name);
        $this->assertSame('new', $booking->status);
        Mail::assertSent(NewBookingMail::class, fn ($m) => $m->hasTo('owner@example.com'));
    }

    public function test_settings_page_saves_from_the_dashboard(): void
    {
        $this->actingAs(User::factory()->create());

        \Livewire\Livewire::test(\App\Filament\Pages\Settings::class)
            ->set('data.working_hours_ar', 'يومياً من 9 صباحاً حتى 9 مساءً')
            ->set('data.notify_emails', ['team@example.com'])
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame(['team@example.com'], Setting::find('site')->value['notify_emails']);
        $this->get('/')->assertSee('يومياً من 9 صباحاً حتى 9 مساءً');
    }

    public function test_new_service_can_be_created_from_the_dashboard(): void
    {
        $this->actingAs(User::factory()->create());

        \Livewire\Livewire::test(\App\Filament\Resources\Services\Pages\CreateService::class)
            ->fillForm([
                'title_ar' => 'تلميع الرخام', 'title_en' => 'Marble Polishing',
                'short_ar' => 'جلي وتلميع الرخام', 'slug' => 'marble-polishing', 'icon' => 'sparkle',
                'features_ar' => ['جلي', 'تلميع'], 'is_visible' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->get('/services/marble-polishing')->assertOk()->assertSee('تلميع الرخام');
        $this->get('/en/services/marble-polishing')->assertOk()->assertSee('Marble Polishing');
    }
}
