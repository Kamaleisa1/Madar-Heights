{{-- Gallery grid with optional service filter and a lightbox (assets/js/app.js) --}}
@php($usedServices = array_values(array_unique(array_filter(array_column($items, 'service')))))
<div class="gallery" data-gallery>
    @if (($filters ?? false) && count($usedServices) > 1)
        <div class="gallery__filters" role="tablist">
            <button type="button" class="chip is-active" data-filter="*">{{ __('الكل') }}</button>
            @foreach ($usedServices as $svc)
                @if (config("site.services.$svc"))
                    <button type="button" class="chip" data-filter="{{ $svc }}">{{ config("site.services.$svc.title") }}</button>
                @endif
            @endforeach
        </div>
    @endif
    <div class="gallery__grid">
        @foreach ($items as $g)
            <figure class="gallery__item @if (! empty($g['before'])) gallery__item--ba @endif" data-service="{{ $g['service'] }}" data-reveal="zoom" data-delay="{{ $loop->index % 4 * 80 }}">
                <button type="button" class="gallery__open" data-full="{{ asset($g['image']) }}" @if (! empty($g['before'])) data-before="{{ asset($g['before']) }}" @endif data-caption="{{ $g['caption'] }}" aria-label="{{ __('تكبير الصورة') }}">
                    @if (! empty($g['before']))
                        <span class="gallery__ba">
                            <span><img src="{{ asset($g['before']) }}" alt="{{ __('قبل') }}" loading="lazy"><em>{{ __('قبل') }}</em></span>
                            <span><img src="{{ asset($g['image']) }}" alt="{{ __('بعد') }}" loading="lazy"><em>{{ __('بعد') }}</em></span>
                        </span>
                    @else
                        <img src="{{ asset($g['image']) }}" alt="{{ $g['caption'] ?: config("site.services.{$g['service']}.title") }}" loading="lazy">
                    @endif
                </button>
                @if ($g['caption'] || config("site.services.{$g['service']}.title"))
                    <figcaption>
                        @if (config("site.services.{$g['service']}.title"))<small>{{ config("site.services.{$g['service']}.title") }}</small>@endif
                        @if ($g['caption'])<span>{{ $g['caption'] }}</span>@endif
                    </figcaption>
                @endif
            </figure>
        @endforeach
    </div>
</div>
