@extends('layouts.app')

@section('title', 'خدماتنا')
@section('description', 'جميع خدمات مدار هايتس: تنظيف المنازل والفلل والمجالس والكنب والسجاد والمكاتب، غسيل الخزانات الأرضية والعلوية، مكافحة الحشرات وغسيل المكيفات.')

@section('content')
@include('partials.page-hero', ['title' => 'خدماتنا', 'text' => 'خدمات متكاملة للتنظيف وغسيل الخزانات ومكافحة الحشرات وغسيل المكيفات في المنطقة الشرقية.'])

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
