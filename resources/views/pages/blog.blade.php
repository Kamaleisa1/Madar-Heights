@extends('layouts.app')

@section('title', 'المدونة')
@section('description', 'نصائح ومقالات من مدار هايتس حول النظافة وغسيل الخزانات ومكافحة الحشرات وغسيل المكيفات.')

@section('content')
@include('partials.page-hero', ['title' => 'المدونة', 'text' => 'نصائح ومقالات تساعدك في الحفاظ على بيت نظيف وصحي.'])

<section class="section">
    <div class="container posts-grid">
        @foreach (config('site.posts') as $slug => $p)
            @include('partials.post-card')
        @endforeach
    </div>
</section>
@endsection
