<section class="page-hero">
    <div class="bubbles" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span></div>
    <div class="container page-hero__inner">
        <nav class="crumbs" aria-label="مسار الصفحة">
            <a href="{{ route('home') }}">الرئيسية</a>
            @foreach ($crumbs ?? [] as $label => $url)
                <span>/</span><a href="{{ $url }}">{{ $label }}</a>
            @endforeach
            <span>/</span><span aria-current="page">{{ $title }}</span>
        </nav>
        <h1 class="page-hero__title" data-reveal>{{ $title }}</h1>
        @isset($text)<p data-reveal data-delay="120">{{ $text }}</p>@endisset
    </div>
</section>
