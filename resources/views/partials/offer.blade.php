@php($offer = config('site.offer'))
@if (! empty($offer['enabled']) && config('site.services.'.$offer['service']))
    @php($svc = config('site.services.'.$offer['service']))
    @php($hasImage = ! empty($offer['image']) && file_exists(public_path($offer['image'])))
    <section class="section offer" id="offer">
        <div class="container">
            <a href="{{ lroute('home') }}#booking" class="offer__card @if ($hasImage) offer__card--image @endif" data-pick-service="{{ $offer['service'] }}" data-reveal="zoom" aria-label="{{ $offer['title'] }}">
                @if ($hasImage)
                    <img src="{{ asset($offer['image']) }}?v={{ filemtime(public_path($offer['image'])) }}" alt="{{ $offer['title'] }}" loading="lazy">
                @else
                    {{-- Designed fallback until the offer image is uploaded --}}
                    <span class="offer__badge">{{ $offer['badge'] }}</span>
                    <span class="offer__icon"><x-icon :name="$svc['icon']" :size="90"/></span>
                    <span class="offer__body">
                        <small>{{ $svc['title'] }}</small>
                        <strong>{{ $offer['title'] }}</strong>
                        <span>{{ $offer['text'] }}</span>
                        <span class="btn btn--order">{{ __('اطلب الخدمة') }}</span>
                    </span>
                    <span class="offer__shine" aria-hidden="true"></span>
                @endif
            </a>
        </div>
    </section>
@endif
