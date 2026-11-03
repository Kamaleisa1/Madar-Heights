<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\Setting;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SiteContentSeeder::class);
    }

    public function test_gallery_is_hidden_until_it_has_photos(): void
    {
        $this->get('/')->assertDontSee('id="gallery"', false)->assertDontSee('/gallery"', false);
        $this->get('/gallery')->assertOk()->assertSee('هنضيف صور أعمالنا هنا قريباً.');
    }

    public function test_gallery_shows_photos_filters_and_before_after(): void
    {
        GalleryItem::create(['image' => 'uploads/gallery/a.jpg', 'before_image' => 'uploads/gallery/b.jpg', 'service_slug' => 'sofa-majlis-cleaning', 'caption_ar' => 'كنب في الخبر', 'caption_en' => 'Sofa in Khobar']);
        GalleryItem::create(['image' => 'uploads/gallery/c.jpg', 'service_slug' => 'ac-cleaning']);
        GalleryItem::create(['image' => 'uploads/gallery/hidden.jpg', 'is_visible' => false]);

        $this->get('/')->assertSee('id="gallery"', false)->assertSee('uploads/gallery/a.jpg')->assertSee(url('/gallery'));
        $this->get('/gallery')->assertSee('data-filter="sofa-majlis-cleaning"', false)
            ->assertSee('uploads/gallery/b.jpg')->assertSee('كنب في الخبر')->assertDontSee('hidden.jpg');
        $this->get('/en/gallery')->assertSee('Sofa in Khobar')->assertSee('Before');

        // each service page shows only its own photos
        $this->get('/services/ac-cleaning')->assertSee('uploads/gallery/c.jpg')->assertDontSee('uploads/gallery/a.jpg');
    }

    public function test_service_city_and_settings_images_appear(): void
    {
        Service::where('slug', 'sofa-majlis-cleaning')->update(['image' => 'uploads/services/sofa.jpg']);
        City::where('slug', 'khobar')->update(['image' => 'uploads/cities/khobar.jpg']);
        $s = Setting::find('site');
        $s->update(['value' => array_merge($s->value, [
            'hero_image' => 'uploads/hero/hero.jpg',
            'page_hero_image' => 'uploads/hero/pages.jpg',
            'logo_light' => 'uploads/logo/logo.png',
            'favicon' => 'uploads/logo/icon.png',
        ])]);

        $this->get('/')->assertSee('uploads/services/sofa.jpg')->assertSee('uploads/hero/hero.jpg')
            ->assertSee('uploads/cities/khobar.jpg')->assertSee('uploads/logo/logo.png')->assertSee('uploads/logo/icon.png');
        $this->get('/services/sofa-majlis-cleaning')->assertSee('detail__banner--img', false);
        $this->get('/about')->assertSee('uploads/hero/pages.jpg');
        $this->get('/areas/khobar')->assertSee('uploads/cities/khobar.jpg');
    }

    public function test_photo_can_be_uploaded_from_the_dashboard(): void
    {
        \Illuminate\Support\Facades\Storage::fake('site');
        $this->actingAs(\App\Models\User::factory()->create());

        \Livewire\Livewire::test(\App\Filament\Resources\GalleryItems\Pages\CreateGalleryItem::class)
            ->fillForm([
                'image' => \Illuminate\Http\UploadedFile::fake()->image('work.jpg', 1200, 900),
                'service_slug' => 'ac-cleaning',
                'caption_ar' => 'غسيل مكيف سبليت',
                'is_visible' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $item = GalleryItem::sole();
        $this->assertStringStartsWith('uploads/gallery/', $item->image);
        \Illuminate\Support\Facades\Storage::disk('site')->assertExists($item->image);
        $this->get('/gallery')->assertSee($item->image)->assertSee('غسيل مكيف سبليت');
    }
}
