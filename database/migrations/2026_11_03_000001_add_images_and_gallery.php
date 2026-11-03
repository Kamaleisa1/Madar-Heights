<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['services', 'cities', 'posts'] as $table) {
            if (! Schema::hasColumn($table, 'image')) {
                Schema::table($table, fn (Blueprint $t) => $t->string('image')->nullable());
            }
        }

        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->string('image');
            $table->string('before_image')->nullable();
            $table->string('service_slug')->nullable();
            $table->string('caption_ar')->nullable();
            $table->string('caption_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
        foreach (['services', 'cities', 'posts'] as $table) {
            Schema::table($table, fn (Blueprint $t) => $t->dropColumn('image'));
        }
    }
};
