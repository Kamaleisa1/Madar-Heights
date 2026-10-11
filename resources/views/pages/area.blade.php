@extends('layouts.app')

@section('title', 'شركة تنظيف في '.$city['name'])
@section('description', 'مدار هايتس: شركة تنظيف وغسيل خزانات ومكافحة حشرات وغسيل مكيفات في '.$city['name'].'. '.$city['intro'])

@section('content')
@include('partials.page-hero', ['title' => 'شركة تنظيف في '.$city['name'], 'text' => $city['intro']])

<section class="section">
    <div class="container">
        @include('partials.section-head', [
            'eyebrow' => $city['name'],
            'title' => 'خدماتنا في <span class="grad">' . e($city['name']) . '</span>',
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
            'eyebrow' => 'الأحياء',
            'title' => 'نغطي جميع أحياء <span class="grad">' . e($city['name']) . '</span>',
        ])
        <div class="chips chips--center" data-reveal>
            @foreach ($city['districts'] as $d)
                <span class="chip"><x-icon name="map" :size="15"/> {{ $d }}</span>
            @endforeach
        </div>
        <div class="chips chips--center mt" data-reveal>
            @foreach (config('site.cities') as $cslug => $c)
                @continue($cslug === $slug)
                <a href="{{ route('area', $cslug) }}" class="chip chip--link">شركة تنظيف في {{ $c['name'] }}</a>
            @endforeach
        </div>
    </div>
</section>

@include('partials.cta', ['cityName' => $city['name']])
@include('partials.booking', ['selectedCity' => $slug])
@endsection
