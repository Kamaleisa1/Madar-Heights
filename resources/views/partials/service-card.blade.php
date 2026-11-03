<a href="{{ lroute('service', $slug) }}" @class(['svc-card', 'svc-card--img' => ! empty($s['image'])]) data-reveal data-delay="{{ ($i ?? 0) % 4 * 90 }}" data-tilt>
    @if (! empty($s['featured']))<em class="badge badge--float">{{ __('خدمتنا الأساسية') }}</em>@endif
    @if (! empty($s['soon']))<em class="badge badge--float badge--soon">{{ __('قريباً') }}</em>@endif
    @if (! empty($s['image']))
        <span class="svc-card__img"><img src="{{ asset($s['image']) }}" alt="{{ $s['title'] }}" loading="lazy"></span>
    @else
        <span class="svc-card__icon"><x-mh-icon :name="$s['icon']" :size="34"/></span>
    @endif
    <h3>{{ $s['title'] }}</h3>
    <p>{{ $s['short'] }}</p>
    <span class="svc-card__more">{{ __('التفاصيل') }} <x-mh-icon name="arrow" :size="16"/></span>
</a>
