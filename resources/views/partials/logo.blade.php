{{-- Theme-aware logo: navy tagline on light backgrounds, white tagline on dark ones.
     Logos uploaded from the dashboard replace the built-in files. --}}
@php($lightLogo = config('site.logo_light'))
@php($darkLogo = config('site.logo_dark') ?: $lightLogo)
<picture class="logo-on-light">
    @unless ($lightLogo)<source srcset="{{ asset('assets/img/logo.webp') }}" type="image/webp">@endunless
    <img src="{{ asset($lightLogo ?: 'assets/img/logo.png') }}" alt="{{ $alt ?? config('site.name_en') }}" width="640" height="509" class="{{ $class ?? '' }}" @isset($eager) fetchpriority="high" @else loading="lazy" @endisset>
</picture>
<picture class="logo-on-dark">
    @unless ($darkLogo)<source srcset="{{ asset('assets/img/logo-dark.webp') }}" type="image/webp">@endunless
    <img src="{{ asset($darkLogo ?: 'assets/img/logo-dark.png') }}" alt="{{ $alt ?? config('site.name_en') }}" width="640" height="509" class="{{ $class ?? '' }}" @isset($eager) fetchpriority="high" @else loading="lazy" @endisset>
</picture>
