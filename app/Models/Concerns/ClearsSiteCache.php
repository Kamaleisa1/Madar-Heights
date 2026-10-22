<?php

namespace App\Models\Concerns;

use App\Support\SiteContent;

/** Any change made from the dashboard refreshes the cached site content. */
trait ClearsSiteCache
{
    public static function bootClearsSiteCache(): void
    {
        static::saved(fn () => SiteContent::flush());
        static::deleted(fn () => SiteContent::flush());
    }
}
