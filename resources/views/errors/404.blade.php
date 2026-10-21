@php(set_site_locale(request()->segment(1) === 'en' ? 'en' : 'ar'))
@extends('layouts.app')

@section('title', __('الصفحة غير موجودة'))

@section('content')
<section class="section notfound">
    <div class="container">
        <strong class="notfound__code grad">404</strong>
        <h1>{{ __('عذراً، الصفحة غير موجودة') }}</h1>
        <p>{{ __('ربما تم نقل الصفحة أو أن الرابط غير صحيح.') }}</p>
        <a href="{{ lroute('home') }}" class="btn btn--primary">{{ __('العودة للرئيسية') }}</a>
    </div>
</section>
@endsection
