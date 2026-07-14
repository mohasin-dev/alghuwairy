<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('subtitle_ar')->nullable();
            $table->text('subtitle_en')->nullable();
            $table->text('image_url');
            $table->string('button_text_ar')->nullable();
            $table->string('button_text_en')->nullable();
            $table->string('button_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        if (Schema::hasTable('page_sections')) {
            $hero = DB::table('page_sections')->where('key', 'hero')->first();

            if ($hero && filled($hero->image_url)) {
                DB::table('sliders')->insert([
                    'title_ar' => $hero->title_ar ?: '', 'title_en' => $hero->title_en ?: '',
                    'subtitle_ar' => $hero->subtitle_ar, 'subtitle_en' => $hero->subtitle_en,
                    'image_url' => $hero->image_url,
                    'button_text_ar' => $hero->button_text_ar, 'button_text_en' => $hero->button_text_en,
                    'button_url' => $hero->button_url, 'sort_order' => 0, 'is_active' => true,
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
