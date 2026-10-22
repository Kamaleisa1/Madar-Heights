<section class="section booking" id="booking">
    <div class="container booking__grid">
        <div class="booking__intro" data-reveal="right">
            <span class="eyebrow">{{ __('احجز الآن') }}</span>
            <h2 class="section-title">{!! __('اطلب خدمتك في <span class="grad">أقل من دقيقة</span>') !!}</h2>
            <p>{{ __('املأ النموذج وسيتم تحويلك مباشرة إلى واتساب برسالة جاهزة، وسيتواصل معك فريق :name لتأكيد الموعد والسعر.', ['name' => config('site.name')]) }}</p>
            <ul class="checklist">
                <li><x-mh-icon name="check" :size="18"/> {{ __('معاينة وتسعير مجاني') }}</li>
                <li><x-mh-icon name="check" :size="18"/> {{ __('فريق يصلك في نفس اليوم') }}</li>
                <li><x-mh-icon name="check" :size="18"/> {{ __('ضمان على جودة الخدمة') }}</li>
            </ul>
            <a href="tel:{{ config('site.phone') }}" class="booking__phone">
                <span class="booking__phone-ico"><x-mh-icon name="phone" :size="22"/></span>
                <span><small>{{ __('أو اتصل مباشرة') }}</small><strong dir="ltr">{{ config('site.phone_display') }}</strong></span>
            </a>
        </div>

        <form class="card form" action="{{ lroute('booking') }}" method="post" data-reveal="left" novalidate>
            @csrf
            <div class="form__row">
                <label class="field">
                    <span>{{ __('الاسم') }}</span>
                    <input type="text" name="name" value="{{ old('name') }}" required maxlength="100" placeholder="{{ __('اسمك الكريم') }}" autocomplete="name">
                    @error('name')<em class="field__error">{{ $message }}</em>@enderror
                </label>
                <label class="field">
                    <span>{{ __('رقم الجوال') }}</span>
                    <input type="tel" name="phone" value="{{ old('phone') }}" required maxlength="20" placeholder="05xxxxxxxx" dir="ltr" autocomplete="tel">
                    @error('phone')<em class="field__error">{{ $message }}</em>@enderror
                </label>
            </div>
            <div class="form__row">
                <label class="field">
                    <span>{{ __('الخدمة المطلوبة') }}</span>
                    <select name="service" required>
                        <option value="" disabled @selected(! old('service', $selectedService ?? null))>{{ __('اختر الخدمة') }}</option>
                        @foreach (config('site.services') as $slug => $s)
                            @continue(! empty($s['soon']))
                            <option value="{{ $slug }}" @selected(old('service', $selectedService ?? null) === $slug)>{{ $s['title'] }}</option>
                        @endforeach
                    </select>
                    @error('service')<em class="field__error">{{ $message }}</em>@enderror
                </label>
                <label class="field">
                    <span>{{ __('المدينة') }}</span>
                    <select name="city" required>
                        <option value="" disabled @selected(! old('city', $selectedCity ?? null))>{{ __('اختر المدينة') }}</option>
                        @foreach (config('site.cities') as $slug => $c)
                            <option value="{{ $slug }}" @selected(old('city', $selectedCity ?? null) === $slug)>{{ $c['name'] }}</option>
                        @endforeach
                    </select>
                    @error('city')<em class="field__error">{{ $message }}</em>@enderror
                </label>
            </div>
            <label class="field">
                <span>{{ __('ملاحظات (اختياري)') }}</span>
                <textarea name="notes" rows="3" maxlength="500" placeholder="{{ __('مثال: كنب 3 قطع ومجلس عربي، أو فيلا دورين...') }}">{{ old('notes') }}</textarea>
            </label>
            <label class="hp" aria-hidden="true">Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
            <button type="submit" class="btn btn--order btn--lg btn--block">
                <x-mh-icon name="whatsapp" :size="22"/> {{ __('اطلب الخدمة') }}
            </button>
        </form>
    </div>
</section>
