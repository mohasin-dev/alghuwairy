<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->text('image_url');
            $table->string('alt_ar')->nullable();
            $table->string('alt_en')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        DB::table('products')
            ->whereNotNull('image_url')
            ->where('image_url', '<>', '')
            ->orderBy('id')
            ->select(['id', 'image_url', 'name_ar', 'name_en'])
            ->chunk(100, function ($products) {
                foreach ($products as $product) {
                    DB::table('product_images')->insert([
                        'product_id' => $product->id,
                        'image_url' => $product->image_url,
                        'alt_ar' => $product->name_ar,
                        'alt_en' => $product->name_en,
                        'sort_order' => 0,
                        'is_primary' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
