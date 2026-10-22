<?php

namespace App\Support;

use App\Models\UiText;
use Illuminate\Contracts\Translation\Loader;
use Illuminate\Support\Facades\Cache;
use Throwable;

/**
 * Lets the dashboard override the interface texts (buttons, headings...).
 * The Arabic text is the key; edits are stored in the ui_texts table.
 */
class DbTranslationLoader implements Loader
{
    public function __construct(protected Loader $inner)
    {
    }

    public function load($locale, $group, $namespace = null)
    {
        $lines = $this->inner->load($locale, $group, $namespace);

        if ($group !== '*' || $namespace !== '*' || ! in_array($locale, ['ar', 'en'], true)) {
            return $lines;
        }

        try {
            $rows = Cache::rememberForever('ui_texts', fn () => UiText::query()->get(['key', 'ar', 'en'])->toArray());
        } catch (Throwable) {
            return $lines;
        }

        foreach ($rows as $row) {
            $value = $row[$locale] ?? null;
            if (filled($value) && ($locale === 'en' || $value !== $row['key'])) {
                $lines[$row['key']] = $value;
            }
        }

        return $lines;
    }

    public function addNamespace($namespace, $hint)
    {
        $this->inner->addNamespace($namespace, $hint);
    }

    public function addJsonPath($path)
    {
        $this->inner->addJsonPath($path);
    }

    public function namespaces()
    {
        return $this->inner->namespaces();
    }
}
