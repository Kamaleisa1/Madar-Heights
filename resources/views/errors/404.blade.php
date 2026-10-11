@extends('layouts.app')

@section('title', 'الصفحة غير موجودة')

@section('content')
<section class="section notfound">
    <div class="container">
        <strong class="notfound__code grad">404</strong>
        <h1>عذراً، الصفحة غير موجودة</h1>
        <p>ربما تم نقل الصفحة أو أن الرابط غير صحيح.</p>
        <a href="{{ route('home') }}" class="btn btn--primary">العودة للرئيسية</a>
    </div>
</section>
@endsection
