@extends('layouts.app')

@section('title', __('شركة تنظيف في :city', ['city' => $city['name']]))
@section('description', __('مدار هايتس: غسيل السجاد والكنب وتنظيف وغسيل مكيفات وخزانات ومكافحة حشرات في :city.', ['city' => $city['name']]).' '.$city['intro'])

@section('content')
@include('partials.page-hero', ['title' => __('شركة تنظيف في :city', ['city' => $city['name']]), 'text' => $city['intro']])

<section class="section">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => $city['name'],
            'title' => __('خدماتنا في <span class="grad">:city</span>', ['city' => e($city['name'])]),
        ])
        <div class="svc-grid">
            @foreach (config('site.services') as $slug => $s)
                @include('partials.service-card', ['i' => $loop->index])
            @endforeach
        </div>
    </div>
</section>

<section class="section section--alt">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => __('الأحياء'),
            'title' => __('نغطي جميع أحياء <span class="grad">:city</span>', ['city' => e($city['name'])]),
        ])
        <div class="chips chips--center" data-reveal>
            @foreach ($city['districts'] as $d)
                <span class="chip"><x-mh-icon name="map" :size="15"/> {{ $d }}</span>
            @endforeach
        </div>
        <div class="chips chips--center mt" data-reveal>
            @foreach (config('site.cities') as $cslug => $c)
                @continue($cslug === $slug)
                <a href="{{ lroute('area', $cslug) }}" class="chip chip--link">{{ __('شركة تنظيف في :city', ['city' => $c['name']]) }}</a>
            @endforeach
        </div>
    </div>
</section>

@include('partials.cta', ['cityName' => $city['name']])
@include('partials.booking', ['selectedCity' => $slug])
@endsection
