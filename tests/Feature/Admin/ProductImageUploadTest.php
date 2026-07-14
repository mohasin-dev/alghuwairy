<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_an_admin_can_upload_a_featured_image_and_gallery_images(): void
    {
        Storage::fake('public');

        $response = $this->post(route('admin.products.store'), $this->productData([
            'primary_image' => UploadedFile::fake()->image('featured.jpg'),
            'gallery_images' => [
                UploadedFile::fake()->image('gallery-one.png'),
                UploadedFile::fake()->image('gallery-two.webp'),
            ],
        ]));

        $response->assertRedirect(route('admin.products.index'));

        $product = Product::with('images')->firstOrFail();
        $this->assertCount(3, $product->images);
        $this->assertTrue($product->images->first()->is_primary);
        $this->assertSame($product->images->first()->image_url, $product->image_url);

        foreach ($product->images as $image) {
            Storage::disk('public')->assertExists(str_replace('/storage/', '', $image->image_url));
        }
    }

    public function test_updating_a_product_can_add_and_remove_gallery_images(): void
    {
        Storage::fake('public');

        $product = Product::create($this->productData(['image_url' => '/storage/products/featured.jpg']));
        $primary = $product->images()->create([
            'image_url' => '/storage/products/featured.jpg',
            'is_primary' => true,
            'sort_order' => 0,
        ]);
        $gallery = $product->images()->create([
            'image_url' => '/storage/products/gallery.jpg',
            'is_primary' => false,
            'sort_order' => 1,
        ]);
        Storage::disk('public')->put('products/featured.jpg', 'featured');
        Storage::disk('public')->put('products/gallery.jpg', 'gallery');

        $response = $this->put(route('admin.products.update', $product), $this->productData([
            'image_url' => $primary->image_url,
            'remove_image_ids' => [$gallery->id],
            'gallery_images' => [UploadedFile::fake()->image('replacement.png')],
        ]));

        $response->assertRedirect(route('admin.products.index'));
        Storage::disk('public')->assertMissing('products/gallery.jpg');
        $this->assertCount(2, $product->fresh()->images);
        $this->assertSame($primary->image_url, $product->fresh()->image_url);
    }

    private function productData(array $overrides = []): array
    {
        return array_merge([
            'name_ar' => 'منتج',
            'name_en' => 'Product',
            'category' => 'products',
            'is_active' => '1',
        ], $overrides);
    }
}
