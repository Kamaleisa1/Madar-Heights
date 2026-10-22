<div class="floating">
    <a href="https://wa.me/{{ config('site.whatsapp') }}?text={{ rawurlencode(config('site.whatsapp_message')) }}" target="_blank" rel="noopener" class="floating__btn floating__btn--wa" aria-label="{{ __('تواصل عبر واتساب') }}">
        <x-mh-icon name="whatsapp" :size="30"/>
        <span class="floating__label">{{ __('واتساب') }}</span>
    </a>
    <a href="tel:{{ config('site.phone') }}" class="floating__btn floating__btn--call" aria-label="{{ __('اتصل بنا') }}">
        <x-mh-icon name="phone" :size="26"/>
        <span class="floating__label">{{ __('اتصل الآن') }}</span>
    </a>
</div>
<button type="button" class="to-top" id="toTop" aria-label="{{ __('العودة للأعلى') }}"><x-mh-icon name="up" :size="22"/></button>
