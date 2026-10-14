<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@hasSection('title')@yield('title') | {{ config('site.name') }}@else{{ config('site.name') }} {{ config('site.tagline') }} | الدمام - القطيف - سيهات - الأحساء - الجبيل@endif</title>
    <meta name="description" content="@yield('description', config('site.description'))">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#061A44">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ar_SA">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:title" content="@yield('title', config('site.name').' '.config('site.tagline'))">
    <meta property="og:description" content="@yield('description', config('site.description'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <meta property="og:image" content="{{ asset('assets/img/icon-512.png') }}">

    {{-- Apply the saved theme before paint to avoid a flash --}}
    <script>
        (function () {
            var t = null;
            try { t = localStorage.getItem('mh-theme'); } catch (e) {}
            if (t !== 'light' && t !== 'dark') t = 'dark'; // dark by default
            document.documentElement.setAttribute('data-theme', t);
            document.documentElement.classList.add('js');
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}?v={{ filemtime(public_path('assets/css/app.css')) }}">

    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => config('site.name'),
        'alternateName' => config('site.name_en'),
        'description' => config('site.description'),
        'url' => url('/'),
        'telephone' => config('site.phone'),
        'logo' => asset('assets/img/logo.png'),
        'areaServed' => array_values(array_map(fn ($c) => $c['name'], config('site.cities'))),
        'sameAs' => array_values(array_filter(config('site.social'), fn ($u) => $u !== '#')),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
</head>
<body class="@yield('body_class')">
    <div class="preloader" id="preloader" aria-hidden="true">
        <div class="preloader__orbit">
            @include('partials.logo', ['alt' => '', 'eager' => true])
            <span class="preloader__planet"></span>
        </div>
    </div>

    <div class="scroll-progress" id="scrollProgress"></div>

    @include('partials.header')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.floating')

    <script src="{{ asset('assets/js/app.js') }}?v={{ filemtime(public_path('assets/js/app.js')) }}" defer></script>
</body>
</html>
