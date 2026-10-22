<div class="site-top">
<div class="topbar">
    <div class="container topbar__inner">
        <div class="topbar__info">
            <a href="{{ lroute('home') }}" class="topbar__logo"><img src="{{ asset('assets/img/logo-dark.webp') }}" alt="{{ config('site.name_en') }}" width="36" height="29"></a>
            <span class="topbar__sep"></span>
            <a href="tel:{{ config('site.phone') }}"><x-icon name="phone" :size="15"/> <span dir="ltr">{{ config('site.phone_display') }}</span></a>
            <span class="topbar__sep"></span>
            <span><x-icon name="clock" :size="15"/> {{ config('site.working_hours') }}</span>
            <span class="topbar__sep hide-sm"></span>
            <span class="hide-sm"><x-icon name="map" :size="15"/> {{ implode(' · ', array_column(config('site.cities'), 'name')) }}</span>
        </div>
        @include('partials.social', ['class' => 'social--sm'])
    </div>
</div>

<header class="header" id="header">
    <div class="container header__inner">
        @include('partials.brand')

        <nav class="nav" id="nav" aria-label="{{ __('القائمة الرئيسية') }}">
            <ul class="nav__list">
                <li><a href="{{ lroute('home') }}" @class(['is-active' => route_is('home')])>{{ __('الرئيسية') }}</a></li>
                <li><a href="{{ lroute('about') }}" @class(['is-active' => route_is('about')])>{{ __('من نحن') }}</a></li>
                <li class="has-drop">
                    <a href="{{ lroute('services') }}" @class(['is-active' => route_is('service*')])>{{ __('خدماتنا') }} <x-icon name="chevron" :size="14"/></a>
                    <div class="drop drop--grid">
                        @foreach (config('site.services') as $slug => $s)
                            <a href="{{ lroute('service', $slug) }}"><x-icon :name="$s['icon']" :size="18"/> {{ $s['title'] }}
                                @if (! empty($s['featured']))<em class="badge">{{ __('الأساسية') }}</em>@endif
                                @if (! empty($s['soon']))<em class="badge badge--soon">{{ __('قريباً') }}</em>@endif
                            </a>
                        @endforeach
                    </div>
                </li>
                <li class="has-drop">
                    <a href="#areas" @class(['is-active' => route_is('area')])>{{ __('مناطق الخدمة') }} <x-icon name="chevron" :size="14"/></a>
                    <div class="drop">
                        @foreach (config('site.cities') as $slug => $c)
                            <a href="{{ lroute('area', $slug) }}"><x-icon name="map" :size="18"/> {{ $c['name'] }}</a>
                        @endforeach
                    </div>
                </li>
                <li><a href="{{ lroute('blog') }}" @class(['is-active' => route_is('blog', 'post')])>{{ __('المدونة') }}</a></li>
                <li><a href="{{ lroute('contact') }}" @class(['is-active' => route_is('contact')])>{{ __('اتصل بنا') }}</a></li>
            </ul>
            <a href="{{ lroute('home') }}#booking" class="btn btn--order nav__order">{{ __('اطلب الخدمة') }}</a>
        </nav>

        <div class="header__actions">
            <a href="{{ switch_locale_url() }}" class="lang-switch" hreflang="{{ is_en() ? 'ar' : 'en' }}" lang="{{ is_en() ? 'ar' : 'en' }}" aria-label="{{ is_en() ? 'العربية' : 'English' }}">{{ is_en() ? 'عربي' : 'EN' }}</a>
            <button type="button" class="theme-toggle" id="themeToggle" aria-label="{{ __('تبديل الوضع الليلي والنهاري') }}">
                <x-icon name="sun" :size="20" class="theme-toggle__sun"/>
                <x-icon name="moon" :size="20" class="theme-toggle__moon"/>
            </button>
            <a href="{{ lroute('home') }}#booking" class="btn btn--order hide-md">{{ __('اطلب الخدمة') }}</a>
            <button type="button" class="burger" id="burger" aria-label="{{ __('فتح القائمة') }}" aria-expanded="false" aria-controls="nav">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
</div>
