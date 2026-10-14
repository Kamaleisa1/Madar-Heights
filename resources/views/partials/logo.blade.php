{{-- Theme-aware logo: navy tagline on light backgrounds, white tagline on dark ones --}}
<picture class="logo-on-light">
    <source srcset="{{ asset('assets/img/logo.webp') }}" type="image/webp">
    <img src="{{ asset('assets/img/logo.png') }}" alt="{{ $alt ?? config('site.name_en') }}" width="640" height="509" class="{{ $class ?? '' }}" @isset($eager) fetchpriority="high" @else loading="lazy" @endisset>
</picture>
<picture class="logo-on-dark">
    <source srcset="{{ asset('assets/img/logo-dark.webp') }}" type="image/webp">
    <img src="{{ asset('assets/img/logo-dark.png') }}" alt="{{ $alt ?? config('site.name_en') }}" width="640" height="509" class="{{ $class ?? '' }}" @isset($eager) fetchpriority="high" @else loading="lazy" @endisset>
</picture>
