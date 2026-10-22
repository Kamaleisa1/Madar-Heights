<?php

namespace App\Support;

use App\Models\City;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Throwable;

/**
 * Builds the site content array (same shape as config/site.php) for a language.
 * Content edited in the dashboard (database) wins; the config files are the
 * fallback so the site keeps working even before the database is set up.
 */
class SiteContent
{
    public static function build(string $locale): array
    {
        $base = config('site_defaults') ?? config('site');
        if ($locale === 'en') {
            $base = array_replace_recursive($base, config('site_en'));
        }

        try {
            $db = Cache::rememberForever("site_content_{$locale}", fn () => static::fromDatabase($locale));
        } catch (Throwable) {
            return $base;
        }

        return array_replace($base, $db);
    }

    public static function flush(): void
    {
        foreach (['site_content_ar', 'site_content_en', 'ui_texts'] as $key) {
            Cache::forget($key);
        }
    }

    /** Only the parts that exist in the database are returned. */
    protected static function fromDatabase(string $locale): array
    {
        $pick = fn ($ar, $en) => ($locale === 'en' && filled($en)) ? $en : $ar;
        $out = [];

        $s = Setting::find('site')?->value;
        if ($s) {
            $out = [
                'name' => $pick($s['name_ar'] ?? null, $s['name_en'] ?? null),
                'name_en' => $s['name_en'] ?? 'Madar Heights',
                'tagline' => $pick($s['tagline_ar'] ?? null, $s['tagline_en'] ?? null),
                'description' => $pick($s['description_ar'] ?? null, $s['description_en'] ?? null),
                'phone' => $s['phone'] ?? null,
                'phone_display' => $s['phone_display'] ?? null,
                'whatsapp' => $s['whatsapp'] ?? null,
                'whatsapp_message' => $pick($s['whatsapp_message_ar'] ?? null, $s['whatsapp_message_en'] ?? null),
                'email' => $s['email'] ?? '',
                'working_hours' => $pick($s['working_hours_ar'] ?? null, $s['working_hours_en'] ?? null),
                'cr_number' => $s['cr_number'] ?? '',
                'vat_number' => $s['vat_number'] ?? '',
                'social' => [
                    'facebook' => $s['social_facebook'] ?: '#',
                    'instagram' => $s['social_instagram'] ?: '#',
                    'tiktok' => $s['social_tiktok'] ?: '#',
                ],
                'notify_emails' => array_values(array_filter($s['notify_emails'] ?? [])),
                'about_photo' => $s['about_photo'] ?? 'assets/img/about-photo.jpg',
                'hero_words' => $pick($s['hero_words_ar'] ?? [], $s['hero_words_en'] ?? []),
                'stats' => array_map(fn ($r) => [
                    'value' => (int) ($r['value'] ?? 0),
                    'count' => ($r['count'] ?? '') ?: null,
                    'suffix' => $r['suffix'] ?? '',
                    'label' => $pick($r['label_ar'] ?? '', $r['label_en'] ?? ''),
                ], $s['stats'] ?? []),
                'why' => array_map(fn ($r) => [
                    'icon' => $r['icon'] ?? 'check',
                    'title' => $pick($r['title_ar'] ?? '', $r['title_en'] ?? ''),
                    'text' => $pick($r['text_ar'] ?? '', $r['text_en'] ?? ''),
                ], $s['why'] ?? []),
                'steps' => array_map(fn ($r) => [
                    'title' => $pick($r['title_ar'] ?? '', $r['title_en'] ?? ''),
                    'text' => $pick($r['text_ar'] ?? '', $r['text_en'] ?? ''),
                ], $s['steps'] ?? []),
                'offer' => [
                    'enabled' => (bool) ($s['offer_enabled'] ?? false),
                    'service' => $s['offer_service'] ?? null,
                    'image' => $pick($s['offer_image_ar'] ?? null, $s['offer_image_en'] ?? null),
                    'title' => $pick($s['offer_title_ar'] ?? '', $s['offer_title_en'] ?? ''),
                    'text' => $pick($s['offer_text_ar'] ?? '', $s['offer_text_en'] ?? ''),
                    'badge' => $pick($s['offer_badge_ar'] ?? '', $s['offer_badge_en'] ?? ''),
                ],
            ];
            $out = array_filter($out, fn ($v) => $v !== null);
        }

        $services = Service::where('is_visible', true)->orderBy('sort')->orderBy('id')->get();
        if ($services->isNotEmpty()) {
            $out['services'] = $services->mapWithKeys(fn (Service $x) => [$x->slug => [
                'title' => $pick($x->title_ar, $x->title_en),
                'icon' => $x->icon,
                'featured' => $x->featured,
                'soon' => $x->soon,
                'short' => $pick($x->short_ar, $x->short_en),
                'body' => $pick($x->body_ar, $x->body_en),
                'features' => array_values(array_filter($pick($x->features_ar ?? [], $x->features_en ?? []))),
            ]])->all();
        }

        $cities = City::where('is_visible', true)->orderBy('sort')->orderBy('id')->get();
        if ($cities->isNotEmpty()) {
            $out['cities'] = $cities->mapWithKeys(fn (City $x) => [$x->slug => [
                'name' => $pick($x->name_ar, $x->name_en),
                'intro' => $pick($x->intro_ar, $x->intro_en),
                'districts' => array_values(array_filter($pick($x->districts_ar ?? [], $x->districts_en ?? []))),
            ]])->all();
        }

        $testimonials = Testimonial::where('is_visible', true)->orderBy('sort')->orderBy('id')->get();
        if ($testimonials->isNotEmpty() || Testimonial::query()->exists()) {
            $out['testimonials'] = $testimonials->map(fn (Testimonial $x) => [
                'name' => $pick($x->name_ar, $x->name_en),
                'source' => $pick($x->source_ar, $x->source_en),
                'text' => $pick($x->text_ar, $x->text_en),
                'image' => $x->image,
            ])->all();
        }

        $faqs = Faq::where('is_visible', true)->orderBy('sort')->orderBy('id')->get();
        if ($faqs->isNotEmpty() || Faq::query()->exists()) {
            $out['faq'] = $faqs->map(fn (Faq $x) => [
                'q' => $pick($x->question_ar, $x->question_en),
                'a' => $pick($x->answer_ar, $x->answer_en),
            ])->all();
        }

        $posts = Post::where('is_visible', true)->orderByDesc('published_at')->get();
        if ($posts->isNotEmpty() || Post::query()->exists()) {
            $out['posts'] = $posts->mapWithKeys(fn (Post $x) => [$x->slug => [
                'title' => $pick($x->title_ar, $x->title_en),
                'date' => $x->published_at->format('Y-m-d'),
                'service' => $x->service_slug,
                'excerpt' => $pick($x->excerpt_ar, $x->excerpt_en),
                'body' => array_values(array_filter(array_map('trim', preg_split("/\R\s*\R/u", (string) $pick($x->body_ar, $x->body_en))))),
            ]])->all();
        }

        return $out;
    }
}
