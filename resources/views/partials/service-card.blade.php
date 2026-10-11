<a href="{{ route('service', $slug) }}" class="svc-card" data-reveal data-delay="{{ ($i ?? 0) % 4 * 90 }}" data-tilt>
    @if (in_array($slug, config('site.new_services')))<em class="badge badge--float">جديد</em>@endif
    <span class="svc-card__icon"><x-icon :name="$s['icon']" :size="34"/></span>
    <h3>{{ $s['title'] }}</h3>
    <p>{{ $s['short'] }}</p>
    <span class="svc-card__more">التفاصيل <x-icon name="arrow" :size="16"/></span>
</a>
