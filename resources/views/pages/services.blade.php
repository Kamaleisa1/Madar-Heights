@extends('layouts.app')

@section('title', __('خدماتنا'))
@section('description', __('جميع خدمات مدار هايتس: الغسيل الجاف للمفروشات، تنظيف السجاد والكنب والستائر والمجالس، غسيل المكيفات، تنظيف الشقق والفلل والمكاتب والخزانات والمسابح، ومكافحة الحشرات.'))

@section('content')
@include('partials.page-hero', ['title' => __('خدماتنا'), 'text' => __('خدمتنا الأساسية الغسيل الجاف والعميق للمفروشات، ومعها خدمات نظافة متكاملة في المنطقة الشرقية.')])

<section class="section">
    <div class="container">
        <div class="svc-grid">
            @foreach (config('site.services') as $slug => $s)
                @include('partials.service-card', ['i' => $loop->index])
            @endforeach
        </div>
    </div>
</section>

@include('partials.cta')
@endsection
