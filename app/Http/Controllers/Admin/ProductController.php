<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::with('images')->orderBy('sort_order')->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.form', ['product' => new Product()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $assets = $this->extractAssets($data);

        $product = Product::create($data);
        $this->syncImages($product, $assets);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product): View
    {
        $product->load('images');

        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validated($request);
        $assets = $this->extractAssets($data);

        $product->update($data);
        $this->syncImages($product, $assets);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->load('images');
        $product->images->each(fn (ProductImage $image) => $this->deleteUploadedImage($image->image_url));
        $product->delete();

        return back()->with('success', 'Product deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'primary_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'gallery_images' => ['nullable', 'array', 'max:12'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'remove_image_ids' => ['nullable', 'array'],
            'remove_image_ids.*' => ['integer'],
            'price' => ['nullable', 'numeric'],
            'old_price' => ['nullable', 'numeric'],
            'badge_ar' => ['nullable', 'string', 'max:255'],
            'badge_en' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_new_arrival'] = $request->boolean('is_new_arrival');
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function extractAssets(array &$data): array
    {
        $assets = [
            'primary_image' => $data['primary_image'] ?? null,
            'gallery_images' => $data['gallery_images'] ?? [],
            'remove_image_ids' => $data['remove_image_ids'] ?? [],
        ];

        unset(
            $data['primary_image'],
            $data['gallery_images'],
            $data['remove_image_ids'],
        );

        return $assets;
    }

    private function syncImages(Product $product, array $assets): void
    {
        $product->load('images');

        $removeIds = collect($assets['remove_image_ids'])->map(fn ($id) => (int) $id);
        $product->images
            ->whereIn('id', $removeIds)
            ->each(function (ProductImage $image): void {
                $this->deleteUploadedImage($image->image_url);
                $image->delete();
            });

        $primary = $product->images()->where('is_primary', true)->first();
        $newPrimaryUrl = $assets['primary_image'] instanceof UploadedFile
            ? $this->storeImage($assets['primary_image'])
            : null;

        if (filled($newPrimaryUrl) && $newPrimaryUrl !== $primary?->image_url) {
            if ($primary) {
                $this->deleteUploadedImage($primary->image_url);
                $primary->delete();
            }

            $product->images()->update(['is_primary' => false]);
            $primary = $product->images()->create([
                'image_url' => $newPrimaryUrl,
                'alt_ar' => $product->name_ar,
                'alt_en' => $product->name_en,
                'sort_order' => 0,
                'is_primary' => true,
            ]);
        }

        foreach ($assets['gallery_images'] as $image) {
            $this->createGalleryImage($product, $this->storeImage($image));
        }

        $primary ??= $product->images()->orderBy('sort_order')->first();
        if ($primary && ! $primary->is_primary) {
            $product->images()->update(['is_primary' => false]);
            $primary->update(['is_primary' => true, 'sort_order' => 0]);
        }

        $product->updateQuietly(['image_url' => $primary?->image_url]);
    }

    private function createGalleryImage(Product $product, string $url): void
    {
        $product->images()->create([
            'image_url' => $url,
            'alt_ar' => $product->name_ar,
            'alt_en' => $product->name_en,
            'sort_order' => ((int) $product->images()->max('sort_order')) + 1,
            'is_primary' => false,
        ]);
    }

    private function storeImage(UploadedFile $image): string
    {
        return '/storage/'.$image->store('products', 'public');
    }

    private function deleteUploadedImage(?string $url): void
    {
        $path = parse_url((string) $url, PHP_URL_PATH);

        if (is_string($path) && str_starts_with($path, '/storage/products/')) {
            Storage::disk('public')->delete(substr($path, strlen('/storage/')));
        }
    }
}
