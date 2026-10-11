<section class="cta-band">
    <div class="container cta-band__inner" data-reveal="zoom">
        <div>
            <h2>جاهزون لخدمتك اليوم في {{ $cityName ?? 'المنطقة الشرقية' }}</h2>
            <p>تواصل معنا الآن واحصل على معاينة وتسعير مجاني.</p>
        </div>
        <div class="cta-band__actions">
            <a href="{{ route('home') }}#booking" class="btn btn--order btn--lg">اطلب الخدمة</a>
            <a href="https://wa.me/{{ config('site.whatsapp') }}?text={{ rawurlencode(config('site.whatsapp_message')) }}" target="_blank" rel="noopener" class="btn btn--wa btn--lg"><x-icon name="whatsapp" :size="20"/> واتساب</a>
        </div>
    </div>
</section>
