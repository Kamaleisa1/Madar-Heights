<section class="cta-band">
    <div class="container cta-band__inner" data-reveal="zoom">
        <div>
            <h2>{{ __('جاهزون لخدمتك اليوم في :place', ['place' => $cityName ?? __('المنطقة الشرقية')]) }}</h2>
            <p>{{ __('تواصل معنا الآن واحصل على معاينة وتسعير مجاني.') }}</p>
        </div>
        <div class="cta-band__actions">
            <a href="{{ lroute('home') }}#booking" class="btn btn--order btn--lg">{{ __('اطلب الخدمة') }}</a>
            <a href="https://wa.me/{{ config('site.whatsapp') }}?text={{ rawurlencode(config('site.whatsapp_message')) }}" target="_blank" rel="noopener" class="btn btn--wa btn--lg"><x-mh-icon name="whatsapp" :size="20"/> {{ __('واتساب') }}</a>
        </div>
    </div>
</section>
