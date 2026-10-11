@extends('layouts.app')

@section('title', $service['title'])
@section('description', $service['short'])

@section('content')
@include('partials.page-hero', ['title' => $service['title'], 'text' => $service['short'], 'crumbs' => ['خدماتنا' => route('services')]])

<section class="section">
    <div class="container detail">
        <article class="detail__main">
            <div class="detail__banner" data-reveal="zoom">
                <div class="bubbles" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
                <x-icon :name="$service['icon']" :size="110"/>
            </div>
            <h2 data-reveal>{{ $service['title'] }} في الدمام والقطيف وسيهات والأحساء والجبيل</h2>
            <p data-reveal>{{ $service['body'] }}</p>

            <h3 data-reveal>ماذا تشمل الخدمة؟</h3>
            <ul class="feature-list">
                @foreach ($service['features'] as $f)
                    <li data-reveal data-delay="{{ $loop->index * 70 }}"><x-icon name="check" :size="18"/> {{ $f }}</li>
                @endforeach
            </ul>

            <h3 data-reveal>نقدم الخدمة في</h3>
            <div class="chips" data-reveal>
                @foreach (config('site.cities') as $cslug => $c)
                    <a href="{{ route('area', $cslug) }}" class="chip"><x-icon name="map" :size="15"/> {{ $service['title'] }} في {{ $c['name'] }}</a>
                @endforeach
            </div>
        </article>

        <aside class="detail__side">
            <div class="card side-card" data-reveal="left">
                <h3>خدمات أخرى</h3>
                <ul class="side-links">
                    @foreach (config('site.services') as $oslug => $o)
                        @continue($oslug === $slug)
                        <li><a href="{{ route('service', $oslug) }}"><x-icon :name="$o['icon']" :size="18"/> {{ $o['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="card side-card side-card--cta" data-reveal="left" data-delay="120">
                <h3>تحتاج هذه الخدمة؟</h3>
                <p>تواصل معنا الآن واحصل على معاينة مجانية.</p>
                <a href="#booking" class="btn btn--order btn--block">اطلب الخدمة</a>
                <a href="tel:{{ config('site.phone') }}" class="btn btn--ghost btn--block"><x-icon name="phone" :size="18"/> <span dir="ltr">{{ config('site.phone_display') }}</span></a>
            </div>
        </aside>
    </div>
</section>

@include('partials.booking', ['selectedService' => $slug])
@endsection
