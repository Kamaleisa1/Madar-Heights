@extends('layouts.app')

@section('title', $post['title'])
@section('description', $post['excerpt'])

@section('content')
@include('partials.page-hero', ['title' => $post['title'], 'crumbs' => [__('المدونة') => lroute('blog')]])

<section class="section">
    <div class="container detail">
        <article class="detail__main prose">
            <time datetime="{{ $post['date'] }}" class="muted"><x-icon name="calendar" :size="15"/> {{ \Illuminate\Support\Carbon::parse($post['date'])->locale(app()->getLocale())->translatedFormat('j F Y') }}</time>
            @foreach ($post['body'] as $para)
                <p data-reveal>{{ $para }}</p>
            @endforeach
            <a href="{{ lroute('service', $post['service']) }}" class="btn btn--primary" data-reveal>{{ __('تعرف على خدمة :service', ['service' => config('site.services.'.$post['service'].'.title')]) }}</a>
        </article>
        <aside class="detail__side">
            <div class="card side-card" data-reveal="left">
                <h3>{{ __('مقالات أخرى') }}</h3>
                <ul class="side-links">
                    @foreach (config('site.posts') as $oslug => $o)
                        @continue($oslug === $slug)
                        <li><a href="{{ lroute('post', $oslug) }}">{{ $o['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="card side-card side-card--cta" data-reveal="left" data-delay="120">
                <h3>{{ __('تحتاج مساعدة؟') }}</h3>
                <p>{{ __('فريقنا جاهز لخدمتك اليوم.') }}</p>
                <a href="{{ lroute('home') }}#booking" class="btn btn--order btn--block">{{ __('اطلب الخدمة') }}</a>
            </div>
        </aside>
    </div>
</section>
@endsection
