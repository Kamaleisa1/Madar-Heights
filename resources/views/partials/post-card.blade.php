<article class="post-card" data-reveal data-delay="{{ $loop->index * 120 }}">
    <a href="{{ route('post', $slug) }}" class="post-card__thumb">
        <x-icon :name="config('site.services.'.$p['service'].'.icon')" :size="60"/>
    </a>
    <div class="post-card__body">
        <time datetime="{{ $p['date'] }}"><x-icon name="calendar" :size="15"/> {{ \Illuminate\Support\Carbon::parse($p['date'])->locale('ar')->translatedFormat('j F Y') }}</time>
        <h3><a href="{{ route('post', $slug) }}">{{ $p['title'] }}</a></h3>
        <p>{{ $p['excerpt'] }}</p>
        <a href="{{ route('post', $slug) }}" class="link-more">اقرأ المزيد <x-icon name="arrow" :size="16"/></a>
    </div>
</article>
