<a href="{{ lroute('service', $slug) }}" class="svc-card" data-reveal data-delay="{{ ($i ?? 0) % 4 * 90 }}" data-tilt>
    @if (! empty($s['featured']))<em class="badge badge--float">{{ __('خدمتنا الأساسية') }}</em>@endif
    @if (! empty($s['soon']))<em class="badge badge--float badge--soon">{{ __('قريباً') }}</em>@endif
    <span class="svc-card__icon"><x-icon :name="$s['icon']" :size="34"/></span>
    <h3>{{ $s['title'] }}</h3>
    <p>{{ $s['short'] }}</p>
    <span class="svc-card__more">{{ __('التفاصيل') }} <x-icon name="arrow" :size="16"/></span>
</a>
