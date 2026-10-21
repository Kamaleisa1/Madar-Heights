@extends('layouts.app')

@section('body_class', 'is-home')

@section('content')
{{-- ============ HERO ============ --}}
<section class="hero">
    <div class="hero__bg" aria-hidden="true">
        <span class="blob blob--1"></span>
        <span class="blob blob--2"></span>
        <span class="blob blob--3"></span>
    </div>
    <div class="bubbles" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>

    <div class="container hero__grid">
        <div class="hero__content">
            <span class="eyebrow eyebrow--pill" data-reveal><x-icon name="sparkle" :size="16"/> {{ __('الخيار الأول للنظافة في المنطقة الشرقية') }}</span>
            <h1 class="hero__title" data-reveal data-delay="100">
                {{ config('site.name') }}
                <span class="hero__rotator">
                    @php($words = is_en() ? ['Upholstery dry cleaning', 'Sofa & majlis cleaning', 'Carpet & curtain cleaning', 'AC cleaning', 'Apartment & villa cleaning', 'Pest control'] : ['الغسيل الجاف للمفروشات', 'غسيل الكنب والمجالس', 'تنظيف السجاد والستائر', 'غسيل المكيفات', 'تنظيف الشقق والفلل', 'مكافحة الحشرات'])
                    <span class="typed grad" data-words='@json($words, JSON_UNESCAPED_UNICODE)'>{{ $words[0] }}</span><span class="caret"></span>
                </span>
            </h1>
            <p class="hero__lead" data-reveal data-delay="200">
                {{ __('غسيل جاف وعميق للمفروشات ونظافة متقنة بلمسة احترافية. فريق مدرب، معدات حديثة، ومواد آمنة… وكل ذلك بضمان.') }}
                @include('partials.city-pins')
            </p>
            <div class="hero__actions" data-reveal data-delay="300">
                <a href="#booking" class="btn btn--order btn--lg">{{ __('اطلب الخدمة') }}</a>
                <a href="https://wa.me/{{ config('site.whatsapp') }}?text={{ rawurlencode(config('site.whatsapp_message')) }}" target="_blank" rel="noopener" class="btn btn--wa btn--lg"><x-icon name="whatsapp" :size="20"/> {{ __('واتساب') }}</a>
                <a href="tel:{{ config('site.phone') }}" class="btn btn--ghost btn--lg"><x-icon name="phone" :size="18"/> <span dir="ltr">{{ config('site.phone_display') }}</span></a>
            </div>
            <div class="hero__trust" data-reveal data-delay="400">
                <div class="avatars">@if (is_en())<span>M</span><span>H</span><span>S</span>@else<span>م</span><span>ع</span><span>س</span>@endif<span>+</span></div>
                <div>
                    <div class="stars">@for ($i = 0; $i < 5; $i++)<x-icon name="star" :size="16"/>@endfor</div>
                    <small>{{ __('أكثر من 5000 عميل يثقون بنا') }}</small>
                </div>
            </div>
        </div>

        <div class="hero__visual" data-reveal="zoom" data-delay="200">
            <div class="orbit">
                <div class="orbit__ring orbit__ring--1"><span class="orbit__sat"><x-icon name="sofa" :size="22"/></span></div>
                <div class="orbit__ring orbit__ring--2"><span class="orbit__sat"><x-icon name="ac" :size="22"/></span></div>
                <div class="orbit__ring orbit__ring--3"><span class="orbit__sat"><x-icon name="bug" :size="22"/></span></div>
                <div class="orbit__core">
                    @include('partials.logo', ['alt' => config('site.name'), 'eager' => true])
                </div>
            </div>
            <div class="float-card float-card--1">
                <span class="float-card__ico"><x-icon name="sofa" :size="22"/></span>
                <span><strong>{{ __('غسيل جاف للمفروشات') }}</strong><small>{{ __('غسيل عميق وتعقيم وتعطير') }}</small></span>
            </div>
            <div class="float-card float-card--2">
                <span class="float-card__ico"><x-icon name="shield" :size="22"/></span>
                <span><strong>{{ __('ضمان الجودة') }}</strong><small>{{ __('نضمن لك جودة العمل') }}</small></span>
            </div>
            <div class="float-card float-card--3">
                <span class="float-card__ico"><x-icon name="clock" :size="22"/></span>
                <span><strong>{{ __('خدمة سريعة') }}</strong><small>{{ __('في نفس اليوم') }}</small></span>
            </div>
        </div>
    </div>

    <a href="#about" class="scroll-hint" aria-label="{{ __('انزل للأسفل') }}"><span></span></a>
</section>

{{-- ============ MARQUEE ============ --}}
<div class="marquee" aria-hidden="true">
    <div class="marquee__track">
        @for ($r = 0; $r < 2; $r++)
            @foreach (config('site.services') as $s)
                <span><x-icon :name="$s['icon']" :size="20"/> {{ $s['title'] }}</span>
            @endforeach
        @endfor
    </div>
</div>

{{-- ============ ABOUT + STATS ============ --}}
<section class="section about" id="about">
    <div class="container about__grid">
        <div class="about__content" data-reveal="right">
            <span class="eyebrow">{{ __('من نحن') }}</span>
            <h2 class="section-title">{{ config('site.name') }}… {!! __('<span class="grad">مدار من النظافة</span> يحيط ببيتك') !!}</h2>
            <p>
                {!! __(':name شركة متخصصة في <strong>الغسيل الجاف والعميق للمفروشات</strong>، وتنظيف السجاد والكنب والستائر والمجالس، وغسيل المكيفات، وتنظيف الشقق والفلل والقصور والمكاتب والخزانات والمسابح، ومكافحة الحشرات. نعمل بعمالة مدربة وماهرة وأحدث المعدات ومواد آمنة ومعتمدة، لنقدم لك نتيجة تليق ببيتك أو منشأتك في :cities.', ['name' => e(config('site.name')), 'cities' => e(cities_list())]) !!}
            </p>
            <ul class="checklist checklist--2">
                <li><x-icon name="check" :size="18"/> {{ __('عمالة مدربة وذات مهارة عالية') }}</li>
                <li><x-icon name="check" :size="18"/> {{ __('معاينة وتسعير مجاني') }}</li>
                <li><x-icon name="check" :size="18"/> {{ __('مواد آمنة ومعتمدة') }}</li>
                <li><x-icon name="check" :size="18"/> {{ __('ضمان على الخدمة') }}</li>
            </ul>
            <a href="{{ lroute('about') }}" class="btn btn--primary">{{ __('اعرف أكثر عنا') }}</a>
        </div>
        <div class="about__visual" data-reveal="left">
            <div class="about__card about__card--main">
                <x-icon name="sparkle" :size="56"/>
                <strong>{{ __('نظافة بمعايير عالية') }}</strong>
                <span>{{ __('منذ سنوات ونحن نخدم بيوت وشركات المنطقة الشرقية') }}</span>
            </div>
            <div class="about__card about__card--badge">
                <strong data-count="5000" data-suffix="+">0</strong>
                <span>{{ __('عميل سعيد') }}</span>
            </div>
        </div>
    </div>

    @include('partials.stats')
</section>

{{-- ============ SERVICES ============ --}}
<section class="section services" id="services">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => __('خدماتنا'),
            'title' => __('كل ما يحتاجه بيتك <span class="grad">في مكان واحد</span>'),
            'text' => __('خدمتنا الأساسية الغسيل الجاف والعميق للمفروشات، ومعها كل خدمات النظافة التي يحتاجها بيتك ومنشأتك.'),
        ])
        <div class="svc-grid">
            @foreach (config('site.services') as $slug => $s)
                @include('partials.service-card', ['i' => $loop->index])
            @endforeach
        </div>
    </div>
</section>

{{-- ============ OFFER ============ --}}
@include('partials.offer')

{{-- ============ WHY US ============ --}}
<section class="section why">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => __('لماذا نحن'),
            'title' => __('لماذا تختار <span class="grad">:name</span>؟', ['name' => e(config('site.name'))]),
        ])
        <div class="why-grid">
            @foreach (config('site.why') as $w)
                <div class="why-item" data-reveal data-delay="{{ $loop->index % 3 * 100 }}">
                    <span class="why-item__icon"><x-icon :name="$w['icon']" :size="28"/></span>
                    <div>
                        <h3>{{ $w['title'] }}</h3>
                        <p>{{ $w['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ STEPS ============ --}}
<section class="section steps">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => __('كيف نعمل'),
            'title' => __('4 خطوات <span class="grad">لبيت نظيف</span>'),
        ])
        <ol class="steps__list">
            @foreach (config('site.steps') as $st)
                <li class="step" data-reveal data-delay="{{ $loop->index * 140 }}">
                    <span class="step__num">{{ $loop->iteration }}</span>
                    <h3>{{ $st['title'] }}</h3>
                    <p>{{ $st['text'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ============ AREAS ============ --}}
<section class="section areas" id="areas">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => __('مناطق الخدمة'),
            'title' => __('نصلك أينما كنت في <span class="grad">المنطقة الشرقية</span>'),
        ])
        <div class="areas__grid">
            @foreach (config('site.cities') as $slug => $c)
                <a href="{{ lroute('area', $slug) }}" class="area-card" data-reveal="zoom" data-delay="{{ $loop->index * 90 }}">
                    <span class="area-card__pin"><x-icon name="map" :size="26"/></span>
                    <strong>{{ $c['name'] }}</strong>
                    <small>{{ __(':count+ أحياء ومناطق', ['count' => count($c['districts'])]) }}</small>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ TESTIMONIALS ============ --}}
<section class="section testimonials">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => __('آراء عملائنا'),
            'title' => __('ماذا يقول <span class="grad">عملاؤنا</span>؟'),
        ])
        <div class="slider" data-slider data-reveal>
            <div class="slider__track">
                @foreach (config('site.testimonials') as $t)
                    <figure class="testi">
                        <x-icon name="quote" :size="34" class="testi__quote"/>
                        <div class="stars">@for ($i = 0; $i < 5; $i++)<x-icon name="star" :size="16"/>@endfor</div>
                        <blockquote>{{ $t['text'] }}</blockquote>
                        <figcaption>
                            <span class="testi__avatar"><x-icon name="whatsapp" :size="24"/></span>
                            <span><strong>{{ $t['name'] }}</strong><small>{{ $t['source'] }}</small></span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
            <div class="slider__dots" role="tablist" aria-label="{{ __('تنقل بين الآراء') }}"></div>
        </div>

        <div class="reviews-shots">
            <h3 class="reviews-shots__title" data-reveal>{{ __('من محادثات عملائنا على واتساب') }}</h3>
            <div class="reviews-shots__grid">
                @foreach (config('site.testimonials') as $t)
                    @continue(empty($t['image']))
                    <a href="{{ asset($t['image']) }}" target="_blank" rel="noopener" class="reviews-shots__item" data-reveal="zoom" data-delay="{{ $loop->index * 80 }}">
                        <img src="{{ asset($t['image']) }}" alt="{{ __('رأي عميل عبر واتساب') }}" loading="lazy">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============ FAQ ============ --}}
<section class="section faq">
    <div class="container faq__grid">
        <div data-reveal="right">
            <span class="eyebrow">{{ __('الأسئلة الشائعة') }}</span>
            <h2 class="section-title">{!! __('عندك <span class="grad">سؤال</span>؟') !!}</h2>
            <p>{{ __('جمعنا لك أكثر الأسئلة تكراراً. لم تجد إجابتك؟ تواصل معنا مباشرة.') }}</p>
            <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" class="btn btn--wa"><x-icon name="whatsapp" :size="20"/> {{ __('اسألنا على واتساب') }}</a>
        </div>
        <div class="accordion" data-reveal="left">
            @foreach (config('site.faq') as $f)
                <details class="acc" @if ($loop->first) open @endif>
                    <summary>{{ $f['q'] }} <x-icon name="chevron" :size="18"/></summary>
                    <div class="acc__body"><p>{{ $f['a'] }}</p></div>
                </details>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ BOOKING ============ --}}
@include('partials.booking')

{{-- ============ BLOG ============ --}}
<section class="section blog-latest">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => __('المدونة'),
            'title' => __('نصائح <span class="grad">ومقالات</span>'),
        ])
        <div class="posts-grid">
            @foreach (config('site.posts') as $slug => $p)
                @include('partials.post-card')
            @endforeach
        </div>
    </div>
</section>
@endsection
