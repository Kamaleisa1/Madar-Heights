<?php

/*
| Small helpers for the bilingual site.
| Arabic lives at "/", English at "/en". English route names are prefixed "en.".
*/

if (! function_exists('set_site_locale')) {
    /** Switch the app (and the site content) to 'ar' or 'en'. */
    function set_site_locale(string $locale): void
    {
        app()->setLocale($locale);
        \Illuminate\Support\Carbon::setLocale($locale);

        // Keep the original file content once, then build the page content for this
        // language: dashboard (database) first, config files as the fallback.
        if (! config('site_defaults')) {
            config(['site_defaults' => config('site')]);
        }
        config(['site' => \App\Support\SiteContent::build($locale)]);
    }
}

if (! function_exists('is_en')) {
    function is_en(): bool
    {
        return app()->getLocale() === 'en';
    }
}

if (! function_exists('lroute')) {
    /** route() for the current language. */
    function lroute(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        return route((is_en() ? 'en.' : '').$name, $parameters, $absolute);
    }
}

if (! function_exists('route_is')) {
    /** request()->routeIs() that ignores the language prefix. */
    function route_is(string ...$names): bool
    {
        $all = [];
        foreach ($names as $n) {
            $all[] = $n;
            $all[] = 'en.'.$n;
        }

        return request()->routeIs(...$all);
    }
}

if (! function_exists('cities_list')) {
    /** "الدمام والخبر و..." / "Dammam, Khobar, ... and Jubail" */
    function cities_list(): string
    {
        $names = array_column(config('site.cities'), 'name');
        if (! is_en()) {
            return implode(' و', $names);
        }
        $last = array_pop($names);

        return implode(', ', $names).' and '.$last;
    }
}

if (! function_exists('switch_locale_url')) {
    /** The same page in the other language. */
    function switch_locale_url(?string $to = null): string
    {
        $to ??= is_en() ? 'ar' : 'en';
        $route = request()->route();
        $name = $route?->getName();
        if (! $name) {
            return $to === 'en' ? url('/en') : url('/');
        }
        $base = str_starts_with($name, 'en.') ? substr($name, 3) : $name;

        return route(($to === 'en' ? 'en.' : '').$base, $route->parameters());
    }
}
