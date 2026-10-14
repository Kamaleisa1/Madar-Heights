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
            <span class="eyebrow eyebrow--pill" data-reveal><x-icon name="sparkle" :size="16"/> الخيار الأول للنظافة في المنطقة الشرقية</span>
            <h1 class="hero__title" data-reveal data-delay="100">
                {{ config('site.name') }}
                <span class="hero__rotator">
                    لـ<span class="typed grad" data-words='["تنظيف المنازل والفلل","غسيل الخزانات","مكافحة الحشرات","غسيل المكيفات","تنظيف المجالس والكنب"]'>تنظيف المنازل والفلل</span><span class="caret"></span>
                </span>
            </h1>
            <p class="hero__lead" data-reveal data-delay="200">
                نظافة متقنة بلمسة احترافية في <strong>الدمام والقطيف وسيهات والأحساء والجبيل</strong>.
                فريق مدرب، معدات حديثة، ومواد آمنة… وكل ذلك بضمان.
            </p>
            <div class="hero__actions" data-reveal data-delay="300">
                <a href="#booking" class="btn btn--order btn--lg">اطلب الخدمة</a>
                <a href="https://wa.me/{{ config('site.whatsapp') }}?text={{ rawurlencode(config('site.whatsapp_message')) }}" target="_blank" rel="noopener" class="btn btn--wa btn--lg"><x-icon name="whatsapp" :size="20"/> واتساب</a>
                <a href="tel:{{ config('site.phone') }}" class="btn btn--ghost btn--lg"><x-icon name="phone" :size="18"/> <span dir="ltr">{{ config('site.phone_display') }}</span></a>
            </div>
            <div class="hero__trust" data-reveal data-delay="400">
                <div class="avatars"><span>م</span><span>ع</span><span>س</span><span>+</span></div>
                <div>
                    <div class="stars">@for ($i = 0; $i < 5; $i++)<x-icon name="star" :size="16"/>@endfor</div>
                    <small>أكثر من 5000 عميل يثقون بنا</small>
                </div>
            </div>
        </div>

        <div class="hero__visual" data-reveal="zoom" data-delay="200">
            <div class="orbit">
                <div class="orbit__ring orbit__ring--1"><span class="orbit__sat"><x-icon name="drop" :size="22"/></span></div>
                <div class="orbit__ring orbit__ring--2"><span class="orbit__sat"><x-icon name="ac" :size="22"/></span></div>
                <div class="orbit__ring orbit__ring--3"><span class="orbit__sat"><x-icon name="bug" :size="22"/></span></div>
                <div class="orbit__core">
                    @include('partials.logo', ['alt' => config('site.name'), 'eager' => true])
                </div>
            </div>
            <div class="float-card float-card--1">
                <span class="float-card__ico"><x-icon name="tank-ground" :size="22"/></span>
                <span><strong>غسيل الخزانات</strong><small>أرضية وعلوية</small></span>
            </div>
            <div class="float-card float-card--2">
                <span class="float-card__ico"><x-icon name="shield" :size="22"/></span>
                <span><strong>ضمان الجودة</strong><small>أو نعيد الخدمة مجاناً</small></span>
            </div>
            <div class="float-card float-card--3">
                <span class="float-card__ico"><x-icon name="clock" :size="22"/></span>
                <span><strong>خدمة سريعة</strong><small>في نفس اليوم</small></span>
            </div>
        </div>
    </div>

    <a href="#about" class="scroll-hint" aria-label="انزل للأسفل"><span></span></a>
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
        <div class="about__visual" data-reveal="right">
            <div class="about__card about__card--main">
                <x-icon name="sparkle" :size="56"/>
                <strong>نظافة بمعايير عالية</strong>
                <span>منذ سنوات ونحن نخدم بيوت وشركات المنطقة الشرقية</span>
            </div>
            <div class="about__card about__card--badge">
                <strong data-count="5000" data-suffix="+">0</strong>
                <span>عميل سعيد</span>
            </div>
        </div>
        <div class="about__content" data-reveal="left">
            <span class="eyebrow">من نحن</span>
            <h2 class="section-title">{{ config('site.name') }}… <span class="grad">مدار من النظافة</span> يحيط ببيتك</h2>
            <p>
                {{ config('site.name') }} شركة متخصصة في خدمات التنظيف الشامل وغسيل الخزانات ومكافحة الحشرات وغسيل المكيفات.
                نعمل بفرق مدربة وأحدث المعدات ومواد آمنة ومعتمدة، لنقدم لك نتيجة تليق ببيتك أو منشأتك في
                الدمام والقطيف وسيهات والأحساء والجبيل.
            </p>
            <ul class="checklist checklist--2">
                <li><x-icon name="check" :size="18"/> عمالة مدربة وموثوقة</li>
                <li><x-icon name="check" :size="18"/> معاينة وتسعير مجاني</li>
                <li><x-icon name="check" :size="18"/> مواد آمنة ومعتمدة</li>
                <li><x-icon name="check" :size="18"/> ضمان على الخدمة</li>
            </ul>
            <a href="{{ route('about') }}" class="btn btn--primary">اعرف أكثر عنا</a>
        </div>
    </div>

    <div class="container stats">
        @foreach (config('site.stats') as $i => $st)
            <div class="stat" data-reveal data-delay="{{ $i * 100 }}">
                <strong data-count="{{ $st['value'] }}" data-suffix="{{ $st['suffix'] }}">0</strong>
                <span>{{ $st['label'] }}</span>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ SERVICES ============ --}}
<section class="section services" id="services">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => 'خدماتنا',
            'title' => 'كل ما يحتاجه بيتك <span class="grad">في مكان واحد</span>',
            'text' => 'من التنظيف الشامل إلى غسيل الخزانات ومكافحة الحشرات وغسيل المكيفات، فرقنا جاهزة لخدمتك.',
        ])
        <div class="svc-grid">
            @foreach (config('site.services') as $slug => $s)
                @include('partials.service-card', ['i' => $loop->index])
            @endforeach
        </div>
    </div>
</section>

{{-- ============ NEW SERVICES HIGHLIGHT ============ --}}
<section class="section highlight">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => 'خدمات جديدة',
            'title' => 'مياه أنقى، هواء أنظف، وبيت <span class="grad">بلا حشرات</span>',
        ])
        <div class="hl-grid">
            @foreach (config('site.new_services') as $slug)
                @php($s = config("site.services.$slug"))
                <article class="hl-card" data-reveal data-delay="{{ $loop->index * 120 }}">
                    <span class="hl-card__icon"><x-icon :name="$s['icon']" :size="40"/></span>
                    <h3>{{ $s['title'] }}</h3>
                    <ul>
                        @foreach (array_slice($s['features'], 0, 4) as $f)
                            <li><x-icon name="check" :size="16"/> {{ $f }}</li>
                        @endforeach
                    </ul>
                    <div class="hl-card__actions">
                        <a href="{{ route('service', $slug) }}" class="link-more">التفاصيل <x-icon name="arrow" :size="16"/></a>
                        <a href="#booking" class="btn btn--order btn--sm" data-pick-service="{{ $slug }}">اطلب الخدمة</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ WHY US ============ --}}
<section class="section why">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => 'لماذا نحن',
            'title' => 'لماذا تختار <span class="grad">' . e(config('site.name')) . '</span>؟',
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
            'eyebrow' => 'كيف نعمل',
            'title' => '4 خطوات <span class="grad">لبيت نظيف</span>',
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
            'eyebrow' => 'مناطق الخدمة',
            'title' => 'نصلك أينما كنت في <span class="grad">المنطقة الشرقية</span>',
        ])
        <div class="areas__grid">
            @foreach (config('site.cities') as $slug => $c)
                <a href="{{ route('area', $slug) }}" class="area-card" data-reveal="zoom" data-delay="{{ $loop->index * 90 }}">
                    <span class="area-card__pin"><x-icon name="map" :size="26"/></span>
                    <strong>{{ $c['name'] }}</strong>
                    <small>{{ count($c['districts']) }}+ حي ومنطقة</small>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ TESTIMONIALS ============ --}}
<section class="section testimonials">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => 'آراء عملائنا',
            'title' => 'ماذا يقول <span class="grad">عملاؤنا</span>؟',
        ])
        <div class="slider" data-slider data-reveal>
            <div class="slider__track">
                @foreach (config('site.testimonials') as $t)
                    <figure class="testi">
                        <x-icon name="quote" :size="34" class="testi__quote"/>
                        <div class="stars">@for ($i = 0; $i < 5; $i++)<x-icon name="star" :size="16"/>@endfor</div>
                        <blockquote>{{ $t['text'] }}</blockquote>
                        <figcaption>
                            <span class="testi__avatar">{{ mb_substr($t['name'], 0, 1) }}</span>
                            <span><strong>{{ $t['name'] }}</strong><small>{{ $t['city'] }}</small></span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
            <div class="slider__dots" role="tablist" aria-label="تنقل بين الآراء"></div>
        </div>
    </div>
</section>

{{-- ============ FAQ ============ --}}
<section class="section faq">
    <div class="container faq__grid">
        <div data-reveal="right">
            <span class="eyebrow">الأسئلة الشائعة</span>
            <h2 class="section-title">عندك <span class="grad">سؤال</span>؟</h2>
            <p>جمعنا لك أكثر الأسئلة تكراراً. لم تجد إجابتك؟ تواصل معنا مباشرة.</p>
            <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" class="btn btn--wa"><x-icon name="whatsapp" :size="20"/> اسألنا على واتساب</a>
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
            'eyebrow' => 'المدونة',
            'title' => 'نصائح <span class="grad">ومقالات</span>',
        ])
        <div class="posts-grid">
            @foreach (config('site.posts') as $slug => $p)
                @include('partials.post-card')
            @endforeach
        </div>
    </div>
</section>
@endsection
