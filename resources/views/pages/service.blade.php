@extends('layouts.app')

@section('title', $service['title'])
@section('description', $service['short'])

@section('content')
@include('partials.page-hero', ['title' => $service['title'], 'text' => $service['short'], 'crumbs' => [__('خدماتنا') => lroute('services')]])

<section class="section">
    <div class="container detail">
        <article class="detail__main">
            <div class="detail__banner" data-reveal="zoom">
                <div class="bubbles" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
                <x-mh-icon :name="$service['icon']" :size="110"/>
            </div>
            <h2 data-reveal>{{ __(':service في :cities', ['service' => $service['title'], 'cities' => cities_list()]) }}</h2>
            <p data-reveal>{{ $service['body'] }}</p>

            <h3 data-reveal>{{ __('ماذا تشمل الخدمة؟') }}</h3>
            <ul class="feature-list">
                @foreach ($service['features'] as $f)
                    <li data-reveal data-delay="{{ $loop->index * 70 }}"><x-mh-icon name="check" :size="18"/> {{ $f }}</li>
                @endforeach
            </ul>

            <h3 data-reveal>{{ __('نقدم الخدمة في') }}</h3>
            <div class="chips" data-reveal>
                @foreach (config('site.cities') as $cslug => $c)
                    <a href="{{ lroute('area', $cslug) }}" class="chip"><x-mh-icon name="map" :size="15"/> {{ __(':service في :cities', ['service' => $service['title'], 'cities' => $c['name']]) }}</a>
                @endforeach
            </div>
        </article>

        <aside class="detail__side">
            <div class="card side-card" data-reveal="left">
                <h3>{{ __('خدمات أخرى') }}</h3>
                <ul class="side-links">
                    @foreach (config('site.services') as $oslug => $o)
                        @continue($oslug === $slug)
                        <li><a href="{{ lroute('service', $oslug) }}"><x-mh-icon :name="$o['icon']" :size="18"/> {{ $o['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="card side-card side-card--cta" data-reveal="left" data-delay="120">
                @if (! empty($service['soon']))
                    <h3><em class="badge badge--soon">{{ __('قريباً') }}</em></h3>
                    <p>{{ __('هذه الخدمة ستتوفر قريباً. تواصل معنا ليصلك خبر إطلاقها.') }}</p>
                    <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" class="btn btn--wa btn--block"><x-mh-icon name="whatsapp" :size="20"/> {{ __('واتساب') }}</a>
                @else
                    <h3>{{ __('تحتاج هذه الخدمة؟') }}</h3>
                    <p>{{ __('تواصل معنا الآن واحصل على معاينة مجانية.') }}</p>
                    <a href="#booking" class="btn btn--order btn--block">{{ __('اطلب الخدمة') }}</a>
                @endif
                <a href="tel:{{ config('site.phone') }}" class="btn btn--ghost btn--block"><x-mh-icon name="phone" :size="18"/> <span dir="ltr">{{ config('site.phone_display') }}</span></a>
            </div>
        </aside>
    </div>
</section>

@if (config('site.offer.service') === $slug)
    @include('partials.offer')
@endif

@include('partials.booking', ['selectedService' => empty($service['soon']) ? $slug : null])
@endsection
