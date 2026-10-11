<section class="section booking" id="booking">
    <div class="container booking__grid">
        <div class="booking__intro" data-reveal="right">
            <span class="eyebrow">احجز الآن</span>
            <h2 class="section-title">اطلب خدمتك في <span class="grad">أقل من دقيقة</span></h2>
            <p>املأ النموذج وسيتم تحويلك مباشرة إلى واتساب برسالة جاهزة، وسيتواصل معك فريق {{ config('site.name') }} لتأكيد الموعد والسعر.</p>
            <ul class="checklist">
                <li><x-icon name="check" :size="18"/> معاينة وتسعير مجاني</li>
                <li><x-icon name="check" :size="18"/> فريق يصلك في نفس اليوم</li>
                <li><x-icon name="check" :size="18"/> ضمان على جودة الخدمة</li>
            </ul>
            <a href="tel:{{ config('site.phone') }}" class="booking__phone">
                <span class="booking__phone-ico"><x-icon name="phone" :size="22"/></span>
                <span><small>أو اتصل مباشرة</small><strong dir="ltr">{{ config('site.phone_display') }}</strong></span>
            </a>
        </div>

        <form class="card form" action="{{ route('booking') }}" method="post" data-reveal="left" novalidate>
            @csrf
            <div class="form__row">
                <label class="field">
                    <span>الاسم</span>
                    <input type="text" name="name" value="{{ old('name') }}" required maxlength="100" placeholder="اسمك الكريم" autocomplete="name">
                    @error('name')<em class="field__error">{{ $message }}</em>@enderror
                </label>
                <label class="field">
                    <span>رقم الجوال</span>
                    <input type="tel" name="phone" value="{{ old('phone') }}" required maxlength="20" placeholder="05xxxxxxxx" dir="ltr" autocomplete="tel">
                    @error('phone')<em class="field__error">{{ $message }}</em>@enderror
                </label>
            </div>
            <div class="form__row">
                <label class="field">
                    <span>الخدمة المطلوبة</span>
                    <select name="service" required>
                        <option value="" disabled @selected(! old('service', $selectedService ?? null))>اختر الخدمة</option>
                        @foreach (config('site.services') as $slug => $s)
                            <option value="{{ $slug }}" @selected(old('service', $selectedService ?? null) === $slug)>{{ $s['title'] }}</option>
                        @endforeach
                    </select>
                    @error('service')<em class="field__error">{{ $message }}</em>@enderror
                </label>
                <label class="field">
                    <span>المدينة</span>
                    <select name="city" required>
                        <option value="" disabled @selected(! old('city', $selectedCity ?? null))>اختر المدينة</option>
                        @foreach (config('site.cities') as $slug => $c)
                            <option value="{{ $slug }}" @selected(old('city', $selectedCity ?? null) === $slug)>{{ $c['name'] }}</option>
                        @endforeach
                    </select>
                    @error('city')<em class="field__error">{{ $message }}</em>@enderror
                </label>
            </div>
            <label class="field">
                <span>ملاحظات (اختياري)</span>
                <textarea name="notes" rows="3" maxlength="500" placeholder="مثال: فيلا دورين، خزان أرضي 20 طن...">{{ old('notes') }}</textarea>
            </label>
            <label class="hp" aria-hidden="true">Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
            <button type="submit" class="btn btn--order btn--lg btn--block">
                <x-icon name="whatsapp" :size="22"/> اطلب الخدمة
            </button>
        </form>
    </div>
</section>
