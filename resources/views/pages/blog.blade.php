@extends('layouts.app')

@section('title', __('المدونة'))
@section('description', __('نصائح ومقالات من مدار هايتس حول غسيل المفروشات والنظافة وغسيل المكيفات والخزانات ومكافحة الحشرات.'))

@section('content')
@include('partials.page-hero', ['title' => __('المدونة'), 'text' => __('نصائح ومقالات تساعدك في الحفاظ على بيت نظيف وصحي.')])

<section class="section">
    <div class="container posts-grid">
        @foreach (config('site.posts') as $slug => $p)
            @include('partials.post-card')
        @endforeach
    </div>
</section>
@endsection
