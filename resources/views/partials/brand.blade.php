<a href="{{ route('home') }}" class="brand" aria-label="{{ config('site.name') }} - الرئيسية">
    @include('partials.logo', ['class' => 'brand__logo', 'alt' => config('site.name_en'), 'eager' => true])
    <span class="brand__text">
        <strong>{{ config('site.name') }}</strong>
        <small>{{ config('site.tagline') }}</small>
    </span>
</a>
