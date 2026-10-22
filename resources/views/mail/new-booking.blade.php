<!DOCTYPE html>
<html lang="ar" dir="rtl">
<body style="margin:0;padding:24px;background:#F4F7FC;font-family:Tahoma,Arial,sans-serif;color:#0A1B3D">
    <div style="max-width:560px;margin:auto;background:#fff;border-radius:16px;overflow:hidden;border:1px solid #DCE4F2">
        <div style="background:#0B3D91;color:#fff;padding:18px 24px;font-size:20px;font-weight:bold">طلب خدمة جديد من الموقع</div>
        <table style="width:100%;border-collapse:collapse;font-size:16px">
            @foreach ([
                'الاسم' => $booking->name,
                'الجوال' => $booking->phone,
                'الخدمة' => $booking->service_title,
                'المدينة' => $booking->city_name,
                'ملاحظات' => $booking->notes ?: '—',
                'لغة الطلب' => $booking->locale === 'en' ? 'English' : 'عربي',
                'التاريخ' => $booking->created_at->timezone(config('app.timezone'))->format('Y-m-d H:i'),
            ] as $label => $value)
                <tr>
                    <td style="padding:12px 24px;border-bottom:1px solid #EEF2F8;color:#55617A;width:110px">{{ $label }}</td>
                    <td style="padding:12px 24px;border-bottom:1px solid #EEF2F8;font-weight:bold">{{ $value }}</td>
                </tr>
            @endforeach
        </table>
        <div style="padding:20px 24px">
            <a href="https://wa.me/{{ preg_replace('/\D+/', '', preg_replace('/^0/', '966', $booking->phone)) }}" style="display:inline-block;background:#25D366;color:#fff;text-decoration:none;padding:10px 18px;border-radius:999px;font-weight:bold">تواصل مع العميل على واتساب</a>
            <a href="{{ url('/admin/bookings') }}" style="display:inline-block;margin-inline-start:8px;color:#0B3D91;font-weight:bold">فتح لوحة التحكم</a>
        </div>
    </div>
</body>
</html>
