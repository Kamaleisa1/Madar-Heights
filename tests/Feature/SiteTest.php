<?php

namespace Tests\Feature;

use Tests\TestCase;

class SiteTest extends TestCase
{
    public function test_static_pages_render(): void
    {
        foreach (['/', '/services', '/about', '/blog', '/contact', '/sitemap.xml'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_every_service_city_and_post_page_renders(): void
    {
        foreach (array_keys(config('site.services')) as $slug) {
            $this->get("/services/$slug")->assertOk()->assertSee(config("site.services.$slug.title"));
        }
        foreach (array_keys(config('site.cities')) as $slug) {
            $this->get("/areas/$slug")->assertOk()->assertSee(config("site.cities.$slug.name"));
        }
        foreach (array_keys(config('site.posts')) as $slug) {
            $this->get("/blog/$slug")->assertOk();
        }
    }

    public function test_unknown_slugs_return_404(): void
    {
        $this->get('/services/nope')->assertNotFound();
        $this->get('/areas/riyadh')->assertNotFound();
    }

    public function test_home_shows_contact_details_and_socials(): void
    {
        $this->get('/')
            ->assertSee('+966 57 925 5992')
            ->assertSee('wa.me/966579255992', false)
            ->assertSee('facebook.com/MadarHeights', false)
            ->assertSee('اطلب الخدمة');
    }

    public function test_booking_redirects_to_whatsapp(): void
    {
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->post('/booking', [
                'name' => 'أحمد',
                'phone' => '0551234567',
                'service' => 'pest-control',
                'city' => 'jubail',
            ])
            ->assertRedirectContains('https://wa.me/966579255992?text=');
    }

    public function test_booking_rejects_unknown_city(): void
    {
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->post('/booking', [
                'name' => 'أحمد',
                'phone' => '0551234567',
                'service' => 'pest-control',
                'city' => 'riyadh',
            ])
            ->assertSessionHasErrors('city');
    }

    public function test_english_pages_render_in_english(): void
    {
        foreach (['/en', '/en/services', '/en/about', '/en/blog', '/en/contact'] as $url) {
            $this->get($url)->assertOk()->assertSee('lang="en"', false)->assertSee('dir="ltr"', false);
        }

        $this->get('/en/services/sofa-majlis-cleaning')->assertOk()->assertSee('Sofa &amp; Majlis Cleaning', false);
        $this->get('/en/areas/khobar')->assertOk()->assertSee('Cleaning company in Khobar');
        $this->get('/en/blog/why-ac-cleaning')->assertOk()->assertSee('Why should you clean your AC?');
    }

    public function test_every_english_page_has_no_arabic_ui_left_in_main_content(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();
        // strip the parts that are Arabic on purpose: the language switch, review screenshots alt-free images, and logo
        $main = preg_replace('#<a [^>]*class="lang-switch"[^>]*>.*?</a>#s', '', $html);
        $main = preg_replace('#<script.*?</script>#s', '', $main);
        $text = strip_tags($main);
        $this->assertDoesNotMatchRegularExpression('/[\x{0600}-\x{06FF}]/u', $text);
    }

    public function test_language_switch_links_to_the_same_page(): void
    {
        $this->get('/services/ac-cleaning')->assertSee('href="'.url('/en/services/ac-cleaning').'"', false);
        $this->get('/en/services/ac-cleaning')->assertSee('href="'.url('/services/ac-cleaning').'"', false);
    }

    public function test_english_booking_sends_english_whatsapp_message(): void
    {
        $response = $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->post('/en/booking', [
                'name' => 'John',
                'phone' => '0551234567',
                'service' => 'ac-cleaning',
                'city' => 'khobar',
            ]);

        $this->assertStringContainsString(rawurlencode('Service: AC Cleaning'), $response->headers->get('Location'));
        $this->assertStringContainsString(rawurlencode('City: Khobar'), $response->headers->get('Location'));
    }

    public function test_light_theme_is_the_default(): void
    {
        $this->get('/')->assertSee("t = 'light'; // light by default", false);
    }

    public function test_car_wash_is_listed_as_coming_soon_but_not_bookable(): void
    {
        $this->get('/services')->assertSee('غسيل السيارات')->assertSee('قريباً');
        $this->get('/services/car-wash')->assertOk()->assertDontSee('<option value="car-wash"', false);
        $this->get('/en/services/car-wash')->assertOk()->assertSee('Coming soon');

        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
            ->post('/booking', ['name' => 'أحمد', 'phone' => '0551234567', 'service' => 'car-wash', 'city' => 'dammam'])
            ->assertSessionHasErrors('service');
    }

    public function test_removed_words_and_old_screenshot_are_gone(): void
    {
        foreach (['/', '/services', '/services/sofa-majlis-cleaning', '/services/mattress-cleaning', '/services/mosque-cleaning'] as $url) {
            $this->get($url)->assertDontSee('بخار')->assertDontSee('مازكلين')->assertDontSee('review-1.jpg')->assertDontSee('دورات المياه');
        }
        foreach (['/en', '/en/services/sofa-majlis-cleaning', '/en/services/mattress-cleaning'] as $url) {
            $this->get($url)->assertDontSee('steam')->assertDontSee('Steam');
        }
        $this->assertFileDoesNotExist(public_path('assets/img/reviews/review-1.jpg'));
    }

    public function test_upholstery_service_is_gone(): void
    {
        $this->get('/services/upholstery-cleaning')->assertNotFound();
        $this->get('/en/services/upholstery-cleaning')->assertNotFound();
        foreach (['/', '/services', '/about', '/blog'] as $url) {
            $this->get($url)->assertDontSee('مفروشات')->assertDontSee('upholstery-cleaning');
        }
        foreach (['/en', '/en/services', '/en/about'] as $url) {
            $this->get($url)->assertDontSee('pholstery');
        }
    }
}
