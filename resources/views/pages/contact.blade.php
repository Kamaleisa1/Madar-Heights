@extends('layouts.app')

@section('title', 'اتصل بنا')

@section('content')
@include('partials.page-hero', ['title' => 'اتصل بنا', 'text' => 'نسعد بتواصلك معنا في أي وقت عبر الهاتف أو واتساب أو مواقع التواصل.'])

<section class="section">
    <div class="container contact-grid">
        <a href="tel:{{ config('site.phone') }}" class="contact-card" data-reveal data-delay="0">
            <span class="contact-card__icon"><x-icon name="phone" :size="28"/></span>
            <h3>اتصل بنا</h3>
            <p dir="ltr">{{ config('site.phone_display') }}</p>
        </a>
        <a href="https://wa.me/{{ config('site.whatsapp') }}?text={{ rawurlencode(config('site.whatsapp_message')) }}" target="_blank" rel="noopener" class="contact-card contact-card--wa" data-reveal data-delay="100">
            <span class="contact-card__icon"><x-icon name="whatsapp" :size="28"/></span>
            <h3>واتساب</h3>
            <p dir="ltr">{{ config('site.phone_display') }}</p>
        </a>
        <div class="contact-card" data-reveal data-delay="200">
            <span class="contact-card__icon"><x-icon name="clock" :size="28"/></span>
            <h3>مواعيد العمل</h3>
            <p>{{ config('site.working_hours') }}</p>
        </div>
        <div class="contact-card" data-reveal data-delay="300">
            <span class="contact-card__icon"><x-icon name="sparkle" :size="28"/></span>
            <h3>تابعنا</h3>
            @include('partials.social', ['class' => 'social--center'])
        </div>
    </div>
</section>

@include('partials.booking')
@endsection
