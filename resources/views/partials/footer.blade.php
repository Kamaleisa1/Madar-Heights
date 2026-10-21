<footer class="footer">
    <div class="footer__wave" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none"><path d="M0 40c240 40 480 40 720 0s480-40 720 0v40H0z"/></svg>
    </div>
    <div class="container footer__grid">
        <div class="footer__about">
            @include('partials.brand')
            <p>{{ config('site.description') }}</p>
            @include('partials.social')
        </div>
        @php($svcCols = array_chunk(config('site.services'), (int) ceil(count(config('site.services')) / 2), true))
        <div>
            <h4>{{ __('خدماتنا') }}</h4>
            <ul>
                @foreach ($svcCols[0] as $slug => $s)
                    <li><a href="{{ lroute('service', $slug) }}">{{ $s['title'] }}</a></li>
                @endforeach
            </ul>
        </div>
        <div>
            <h4>{{ __('المزيد من الخدمات') }}</h4>
            <ul>
                @foreach ($svcCols[1] ?? [] as $slug => $s)
                    <li><a href="{{ lroute('service', $slug) }}">{{ $s['title'] }}</a></li>
                @endforeach
            </ul>
            <h4 class="mt">{{ __('مناطق الخدمة') }}</h4>
            <ul class="footer__inline">
                @foreach (config('site.cities') as $slug => $c)
                    <li><a href="{{ lroute('area', $slug) }}">{{ $c['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
        <div>
            <h4>{{ __('تواصل معنا') }}</h4>
            <ul class="footer__contact">
                <li><x-icon name="phone" :size="18"/> <a href="tel:{{ config('site.phone') }}" dir="ltr">{{ config('site.phone_display') }}</a></li>
                <li><x-icon name="whatsapp" :size="18"/> <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener">{{ __('راسلنا على واتساب') }}</a></li>
                @if (config('site.email'))
                    <li><x-icon name="mail" :size="18"/> <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
                @endif
                <li><x-icon name="clock" :size="18"/> {{ config('site.working_hours') }}</li>
                <li><x-icon name="map" :size="18"/> {{ __('المنطقة الشرقية - المملكة العربية السعودية') }}</li>
            </ul>
            <a href="{{ lroute('home') }}#booking" class="btn btn--order btn--block">{{ __('اطلب الخدمة') }}</a>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <p class="footer__legal">
                <span>{{ __('السجل التجاري (C.R)') }}: <bdi>{{ config('site.cr_number') }}</bdi></span>
                <span>{{ __('الرقم الضريبي') }}: <bdi>{{ config('site.vat_number') }}</bdi></span>
            </p>
            <p>{{ __('جميع الحقوق محفوظة') }} &copy; {{ date('Y') }} {{ config('site.name') }}@if (! is_en()) - {{ config('site.name_en') }}@endif</p>
        </div>
    </div>
</footer>
