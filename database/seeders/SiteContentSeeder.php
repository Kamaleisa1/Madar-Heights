<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\UiText;
use App\Support\SiteContent;
use Illuminate\Database\Seeder;

/**
 * Copies the current site content (config/site.php + config/site_en.php +
 * lang/en.json) into the database. Safe to run again: it only fills what is
 * still empty, so edits made in the dashboard are never overwritten.
 */
class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $ar = config('site_defaults') ?? config('site');
        $en = config('site_en');

        if (! Setting::find('site')) {
            $whyAr = $ar['why'];
            $stepsAr = $ar['steps'];
            Setting::create(['key' => 'site', 'value' => [
                'name_ar' => $ar['name'], 'name_en' => $en['name'],
                'tagline_ar' => $ar['tagline'], 'tagline_en' => $en['tagline'],
                'description_ar' => $ar['description'], 'description_en' => $en['description'],
                'phone' => $ar['phone'], 'phone_display' => $ar['phone_display'], 'whatsapp' => $ar['whatsapp'],
                'whatsapp_message_ar' => $ar['whatsapp_message'], 'whatsapp_message_en' => $en['whatsapp_message'],
                'email' => $ar['email'],
                'working_hours_ar' => $ar['working_hours'], 'working_hours_en' => $en['working_hours'],
                'cr_number' => $ar['cr_number'], 'vat_number' => $ar['vat_number'],
                'social_facebook' => $ar['social']['facebook'],
                'social_instagram' => $ar['social']['instagram'],
                'social_tiktok' => $ar['social']['tiktok'],
                'notify_emails' => $ar['notify_emails'] ?? [],
                'about_photo' => $ar['about_photo'],
                'hero_words_ar' => $ar['hero_words'], 'hero_words_en' => $en['hero_words'],
                'stats' => array_map(fn ($s, $i) => [
                    'value' => $s['value'] ?? 0, 'count' => $s['count'] ?? '', 'suffix' => $s['suffix'],
                    'label_ar' => $s['label'], 'label_en' => $en['stats'][$i]['label'] ?? '',
                ], $ar['stats'], array_keys($ar['stats'])),
                'why' => array_map(fn ($w, $i) => [
                    'icon' => $w['icon'], 'title_ar' => $w['title'], 'title_en' => $en['why'][$i]['title'] ?? '',
                    'text_ar' => $w['text'], 'text_en' => $en['why'][$i]['text'] ?? '',
                ], $whyAr, array_keys($whyAr)),
                'steps' => array_map(fn ($w, $i) => [
                    'title_ar' => $w['title'], 'title_en' => $en['steps'][$i]['title'] ?? '',
                    'text_ar' => $w['text'], 'text_en' => $en['steps'][$i]['text'] ?? '',
                ], $stepsAr, array_keys($stepsAr)),
                'offer_enabled' => $ar['offer']['enabled'],
                'offer_service' => $ar['offer']['service'],
                'offer_image_ar' => $ar['offer']['image'], 'offer_image_en' => $en['offer']['image'],
                'offer_title_ar' => $ar['offer']['title'], 'offer_title_en' => $en['offer']['title'],
                'offer_text_ar' => $ar['offer']['text'], 'offer_text_en' => $en['offer']['text'],
                'offer_badge_ar' => $ar['offer']['badge'], 'offer_badge_en' => $en['offer']['badge'],
            ]]);
        }

        if (! Service::query()->exists()) {
            $i = 0;
            foreach ($ar['services'] as $slug => $s) {
                $e = $en['services'][$slug] ?? [];
                Service::create([
                    'slug' => $slug, 'sort' => ++$i, 'icon' => $s['icon'],
                    'featured' => ! empty($s['featured']), 'soon' => ! empty($s['soon']),
                    'title_ar' => $s['title'], 'title_en' => $e['title'] ?? null,
                    'short_ar' => $s['short'], 'short_en' => $e['short'] ?? null,
                    'body_ar' => $s['body'], 'body_en' => $e['body'] ?? null,
                    'features_ar' => $s['features'], 'features_en' => $e['features'] ?? [],
                ]);
            }
        }

        if (! City::query()->exists()) {
            $i = 0;
            foreach ($ar['cities'] as $slug => $c) {
                $e = $en['cities'][$slug] ?? [];
                City::create([
                    'slug' => $slug, 'sort' => ++$i,
                    'name_ar' => $c['name'], 'name_en' => $e['name'] ?? null,
                    'intro_ar' => $c['intro'], 'intro_en' => $e['intro'] ?? null,
                    'districts_ar' => $c['districts'], 'districts_en' => $e['districts'] ?? [],
                ]);
            }
        }

        if (! Testimonial::query()->exists()) {
            foreach ($ar['testimonials'] as $i => $t) {
                $e = $en['testimonials'][$i] ?? [];
                Testimonial::create([
                    'sort' => $i + 1,
                    'name_ar' => $t['name'], 'name_en' => $e['name'] ?? null,
                    'source_ar' => $t['source'], 'source_en' => $e['source'] ?? null,
                    'text_ar' => $t['text'], 'text_en' => $e['text'] ?? null,
                    'image' => $t['image'] ?? null,
                ]);
            }
        }

        if (! Faq::query()->exists()) {
            foreach ($ar['faq'] as $i => $f) {
                $e = $en['faq'][$i] ?? [];
                Faq::create([
                    'sort' => $i + 1,
                    'question_ar' => $f['q'], 'question_en' => $e['q'] ?? null,
                    'answer_ar' => $f['a'], 'answer_en' => $e['a'] ?? null,
                ]);
            }
        }

        if (! Post::query()->exists()) {
            foreach ($ar['posts'] as $slug => $p) {
                $e = $en['posts'][$slug] ?? [];
                Post::create([
                    'slug' => $slug, 'published_at' => $p['date'], 'service_slug' => $p['service'],
                    'title_ar' => $p['title'], 'title_en' => $e['title'] ?? null,
                    'excerpt_ar' => $p['excerpt'], 'excerpt_en' => $e['excerpt'] ?? null,
                    'body_ar' => implode("\n\n", $p['body']), 'body_en' => implode("\n\n", $e['body'] ?? []),
                ]);
            }
        }

        // Interface texts: add any that are missing, keep the ones already edited
        $json = json_decode(file_get_contents(lang_path('en.json')), true) ?: [];
        foreach ($json as $key => $english) {
            UiText::firstOrCreate(['key_hash' => sha1($key)], ['key' => $key, 'ar' => $key, 'en' => $english]);
        }

        SiteContent::flush();
    }
}
