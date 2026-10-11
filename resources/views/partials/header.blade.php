<div class="topbar">
    <div class="container topbar__inner">
        <div class="topbar__info">
            <a href="tel:{{ config('site.phone') }}"><x-icon name="phone" :size="15"/> <span dir="ltr">{{ config('site.phone_display') }}</span></a>
            <span class="topbar__sep"></span>
            <span><x-icon name="clock" :size="15"/> {{ config('site.working_hours') }}</span>
            <span class="topbar__sep hide-sm"></span>
            <span class="hide-sm"><x-icon name="map" :size="15"/> الدمام · القطيف · سيهات · الأحساء · الجبيل</span>
        </div>
        @include('partials.social', ['class' => 'social--sm'])
    </div>
</div>

<header class="header" id="header">
    <div class="container header__inner">
        @include('partials.brand')

        <nav class="nav" id="nav" aria-label="القائمة الرئيسية">
            <ul class="nav__list">
                <li><a href="{{ route('home') }}" @class(['is-active' => request()->routeIs('home')])>الرئيسية</a></li>
                <li><a href="{{ route('about') }}" @class(['is-active' => request()->routeIs('about')])>من نحن</a></li>
                <li class="has-drop">
                    <a href="{{ route('services') }}" @class(['is-active' => request()->routeIs('service*')])>خدماتنا <x-icon name="chevron" :size="14"/></a>
                    <div class="drop drop--grid">
                        @foreach (config('site.services') as $slug => $s)
                            <a href="{{ route('service', $slug) }}"><x-icon :name="$s['icon']" :size="18"/> {{ $s['title'] }}
                                @if (in_array($slug, config('site.new_services')))<em class="badge">جديد</em>@endif
                            </a>
                        @endforeach
                    </div>
                </li>
                <li class="has-drop">
                    <a href="#areas" @class(['is-active' => request()->routeIs('area')])>مناطق الخدمة <x-icon name="chevron" :size="14"/></a>
                    <div class="drop">
                        @foreach (config('site.cities') as $slug => $c)
                            <a href="{{ route('area', $slug) }}"><x-icon name="map" :size="18"/> {{ $c['name'] }}</a>
                        @endforeach
                    </div>
                </li>
                <li><a href="{{ route('blog') }}" @class(['is-active' => request()->routeIs('blog', 'post')])>المدونة</a></li>
                <li><a href="{{ route('contact') }}" @class(['is-active' => request()->routeIs('contact')])>اتصل بنا</a></li>
            </ul>
            <a href="{{ route('home') }}#booking" class="btn btn--order nav__order">اطلب الخدمة</a>
        </nav>

        <div class="header__actions">
            <button type="button" class="theme-toggle" id="themeToggle" aria-label="تبديل الوضع الليلي والنهاري">
                <x-icon name="sun" :size="20" class="theme-toggle__sun"/>
                <x-icon name="moon" :size="20" class="theme-toggle__moon"/>
            </button>
            <a href="{{ route('home') }}#booking" class="btn btn--order hide-md">اطلب الخدمة</a>
            <button type="button" class="burger" id="burger" aria-label="فتح القائمة" aria-expanded="false" aria-controls="nav">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
