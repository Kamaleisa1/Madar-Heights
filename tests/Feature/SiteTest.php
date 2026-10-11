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
}
