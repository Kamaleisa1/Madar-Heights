@extends('layouts.app')

@section('title', __('معرض أعمالنا'))
@section('description', __('صور حقيقية من أعمال مدار هايتس في التنظيف وغسيل السجاد والكنب والمكيفات والخزانات.'))

@section('content')
@include('partials.page-hero', ['title' => __('معرض أعمالنا'), 'text' => __('صور حقيقية من أعمال فريقنا.')])

<section class="section">
    <div class="container">
        @if (config('site.gallery'))
            @include('partials.gallery-grid', ['items' => config('site.gallery'), 'filters' => true])
        @else
            <p class="center muted-block">{{ __('هنضيف صور أعمالنا هنا قريباً.') }}</p>
        @endif
    </div>
</section>

@include('partials.cta')
@endsection
