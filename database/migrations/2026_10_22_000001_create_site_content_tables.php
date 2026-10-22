<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedInteger('sort')->default(0);
            $table->string('icon')->default('sparkle');
            $table->boolean('featured')->default(false);
            $table->boolean('soon')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->text('short_ar')->nullable();
            $table->text('short_en')->nullable();
            $table->text('body_ar')->nullable();
            $table->text('body_en')->nullable();
            $table->json('features_ar')->nullable();
            $table->json('features_en')->nullable();
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->text('intro_ar')->nullable();
            $table->text('intro_en')->nullable();
            $table->json('districts_ar')->nullable();
            $table->json('districts_en')->nullable();
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('source_ar')->nullable();
            $table->string('source_en')->nullable();
            $table->text('text_ar');
            $table->text('text_en')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->string('question_ar');
            $table->string('question_en')->nullable();
            $table->text('answer_ar');
            $table->text('answer_en')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->boolean('is_visible')->default(true);
            $table->date('published_at');
            $table->string('service_slug')->nullable();
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->text('excerpt_ar')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('body_ar')->nullable();
            $table->longText('body_en')->nullable();
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 30);
            $table->string('service_slug')->nullable();
            $table->string('service_title')->nullable();
            $table->string('city_slug')->nullable();
            $table->string('city_name')->nullable();
            $table->text('notes')->nullable();
            $table->string('locale', 5)->default('ar');
            $table->string('status', 20)->default('new');
            $table->text('admin_notes')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->json('value')->nullable();
            $table->timestamps();
        });

        Schema::create('ui_texts', function (Blueprint $table) {
            $table->id();
            $table->char('key_hash', 40)->unique();
            $table->text('key');
            $table->text('ar')->nullable();
            $table->text('en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['ui_texts', 'settings', 'bookings', 'posts', 'faqs', 'testimonials', 'cities', 'services'] as $t) {
            Schema::dropIfExists($t);
        }
    }
};
