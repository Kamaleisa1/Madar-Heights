<div class="container stats">
    @foreach (config('site.stats') as $i => $st)
        <div class="stat" data-reveal data-delay="{{ $i * 100 }}">
            <strong data-count="{{ isset($st['count']) ? count(config('site.'.$st['count'])) : $st['value'] }}" data-suffix="{{ $st['suffix'] }}">0</strong>
            <span>{{ $st['label'] }}</span>
        </div>
    @endforeach
</div>
