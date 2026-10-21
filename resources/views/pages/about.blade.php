@extends('layouts.app')

@section('title', 'من نحن')

@section('content')
@include('partials.page-hero', ['title' => 'من نحن', 'text' => 'تعرف على '.config('site.name').' وقيمنا وطريقة عملنا.'])

<section class="section about">
    <div class="container about__grid">
        <div class="about__visual" data-reveal="right">
            <div class="about__card about__card--main">
                <img src="{{ asset('assets/img/logo-dark.webp') }}" alt="{{ config('site.name_en') }}" width="640" height="509" class="about__logo" loading="lazy">
                <strong>{{ config('site.name') }}</strong>
                <span>{{ config('site.tagline') }}</span>
            </div>
        </div>
        <div class="about__content" data-reveal="left">
            <span class="eyebrow">قصتنا</span>
            <h2 class="section-title">نرتقي <span class="grad">بمعايير النظافة</span></h2>
            <p>اسم "مدار" يعبر عن رؤيتنا: خدمة متكاملة تدور حول احتياجاتك، و"هايتس" يعبر عن سعينا الدائم للوصول إلى أعلى مستويات الجودة.</p>
            <p>تخصصنا الأساسي هو الغسيل الجاف والعميق للمفروشات، ومعه نقدم تنظيف السجاد والكنب والستائر والمجالس ومراتب الأسرّة، وغسيل المكيفات، وتنظيف الشقق والفلل والقصور والمكاتب والمطابخ والحمامات والنوافذ والخزانات والمسابح، ومكافحة الحشرات، وخدمات المساجد، لنكون الوجهة الواحدة لكل احتياجات بيتك ومنشأتك في {{ implode(' و', array_column(config('site.cities'), 'name')) }}.</p>
            <div class="mv">
                <div class="mv__item"><x-icon name="sparkle" :size="26"/><div><h3>رؤيتنا</h3><p>أن نكون الشركة الأكثر ثقة في خدمات النظافة بالمنطقة الشرقية.</p></div></div>
                <div class="mv__item"><x-icon name="shield" :size="26"/><div><h3>رسالتنا</h3><p>تقديم خدمة احترافية آمنة بأسعار عادلة والتزام كامل بالمواعيد.</p></div></div>
            </div>
        </div>
    </div>
    @include('partials.stats')
</section>

<section class="section why section--alt">
    <div class="container">
        @include('partials.section-head', ['eyebrow' => 'قيمنا', 'title' => 'ما يميزنا'])
        <div class="why-grid">
            @foreach (config('site.why') as $w)
                <div class="why-item" data-reveal data-delay="{{ $loop->index % 3 * 100 }}">
                    <span class="why-item__icon"><x-icon :name="$w['icon']" :size="28"/></span>
                    <div><h3>{{ $w['title'] }}</h3><p>{{ $w['text'] }}</p></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('partials.cta')
@endsection
