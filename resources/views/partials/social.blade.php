<div class="social {{ $class ?? '' }}">
    <a href="{{ config('site.social.facebook') }}" target="_blank" rel="noopener" aria-label="فيسبوك" class="social__link social__link--fb"><x-icon name="facebook" :size="18"/></a>
    <a href="{{ config('site.social.instagram') }}" @if(config('site.social.instagram') !== '#') target="_blank" rel="noopener" @endif aria-label="إنستجرام" class="social__link social__link--ig"><x-icon name="instagram" :size="18"/></a>
    <a href="{{ config('site.social.tiktok') }}" @if(config('site.social.tiktok') !== '#') target="_blank" rel="noopener" @endif aria-label="تيك توك" class="social__link social__link--tt"><x-icon name="tiktok" :size="18"/></a>
    <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" aria-label="واتساب" class="social__link social__link--wa"><x-icon name="whatsapp" :size="18"/></a>
</div>
