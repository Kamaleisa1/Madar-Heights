<article class="post-card" data-reveal data-delay="{{ $loop->index * 120 }}">
    <a href="{{ lroute('post', $slug) }}" class="post-card__thumb">
        <x-mh-icon :name="config('site.services.'.$p['service'].'.icon')" :size="60"/>
    </a>
    <div class="post-card__body">
        <time datetime="{{ $p['date'] }}"><x-mh-icon name="calendar" :size="15"/> {{ \Illuminate\Support\Carbon::parse($p['date'])->locale(app()->getLocale())->translatedFormat('j F Y') }}</time>
        <h3><a href="{{ lroute('post', $slug) }}">{{ $p['title'] }}</a></h3>
        <p>{{ $p['excerpt'] }}</p>
        <a href="{{ lroute('post', $slug) }}" class="link-more">{{ __('اقرأ المزيد') }} <x-mh-icon name="arrow" :size="16"/></a>
    </div>
</article>
