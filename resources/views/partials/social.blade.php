<div class="social {{ $class ?? '' }}">
    <a href="{{ config('site.social.facebook') }}" target="_blank" rel="noopener" aria-label="{{ __('فيسبوك') }}" class="social__link social__link--fb"><x-mh-icon name="facebook" :size="18"/></a>
    <a href="{{ config('site.social.instagram') }}" @if(config('site.social.instagram') !== '#') target="_blank" rel="noopener" @endif aria-label="{{ __('إنستجرام') }}" class="social__link social__link--ig"><x-mh-icon name="instagram" :size="18"/></a>
    <a href="{{ config('site.social.tiktok') }}" @if(config('site.social.tiktok') !== '#') target="_blank" rel="noopener" @endif aria-label="{{ __('تيك توك') }}" class="social__link social__link--tt"><x-mh-icon name="tiktok" :size="18"/></a>
    <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" aria-label="{{ __('واتساب') }}" class="social__link social__link--wa"><x-mh-icon name="whatsapp" :size="18"/></a>
</div>
