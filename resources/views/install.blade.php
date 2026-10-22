<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>تركيب لوحة التحكم | مدار هايتس</title>
    <style>
        body { margin: 0; font-family: Tahoma, Arial, sans-serif; background: #F4F7FC; color: #0A1B3D; }
        .box { max-width: 480px; margin: 40px auto; background: #fff; border: 1px solid #DCE4F2; border-radius: 18px; padding: 28px; box-shadow: 0 10px 30px rgba(11,61,145,.08); }
        .logo { display: block; height: 72px; margin: 0 auto 10px; }
        h1 { font-size: 22px; text-align: center; margin: 0 0 6px; }
        p.lead { text-align: center; color: #55617A; margin: 0 0 22px; line-height: 1.7; }
        label { display: block; font-weight: bold; margin: 14px 0 6px; font-size: 15px; }
        input { width: 100%; box-sizing: border-box; padding: 11px 12px; border: 1.5px solid #DCE4F2; border-radius: 10px; font-size: 16px; }
        input:focus { outline: none; border-color: #1E63E9; }
        .ltr { direction: ltr; text-align: left; }
        button { width: 100%; margin-top: 22px; padding: 13px; border: 0; border-radius: 999px; background: #0B3D91; color: #fff; font-size: 17px; font-weight: bold; cursor: pointer; }
        .err { background: #FDECEC; color: #B42318; border-radius: 10px; padding: 10px 12px; margin-bottom: 14px; font-size: 14px; line-height: 1.6; }
        .ok { background: #E7F8EE; color: #067647; border-radius: 10px; padding: 10px 12px; margin-bottom: 14px; }
        small { color: #55617A; }
    </style>
</head>
<body>
<div class="box">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Madar Heights" class="logo">

    @if ($mode === 'setup')
        <h1>تركيب لوحة التحكم</h1>
        <p class="lead">الصفحة دي بتجهز قاعدة البيانات وتنقل محتوى الموقع ليها وتعمل حساب الأدمن الأول. بتشتغل مرة واحدة بس.</p>

        @if ($errors->any())
            <div class="err">@foreach ($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
        @endif

        <form method="post" action="{{ url('/install') }}">
            @csrf
            <label>مفتاح التركيب <small>(نفس اللي كتبته في INSTALL_KEY في ملف .env)</small></label>
            <input type="password" name="key" required class="ltr" autocomplete="off">

            <label>اسمك</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            <label>الإيميل (هتدخل بيه على لوحة التحكم)</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="ltr">

            <label>كلمة المرور <small>(10 حروف على الأقل)</small></label>
            <input type="password" name="password" required minlength="10" class="ltr" autocomplete="new-password">

            <label>تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" required minlength="10" class="ltr" autocomplete="new-password">

            <button type="submit">تركيب</button>
        </form>
    @else
        <h1>تحديث قاعدة البيانات</h1>
        @if (session('status') === 'updated')
            <div class="ok">تم التحديث بنجاح.</div>
        @endif
        <p class="lead">استخدم الزرار ده بعد رفع نسخة جديدة من الموقع عشان أي تحديثات في قاعدة البيانات تتطبق. المحتوى اللي عدلته من لوحة التحكم مش هيتغير.</p>
        <form method="post" action="{{ url('/install/update') }}">
            @csrf
            <button type="submit">تحديث قاعدة البيانات</button>
        </form>
        <p class="lead" style="margin-top:16px"><a href="{{ url('/admin') }}">الرجوع للوحة التحكم</a></p>
    @endif
</div>
</body>
</html>
