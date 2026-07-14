<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\PageSection;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key')->all();
        $sections = PageSection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('key');

        return view('home', [
            'settings' => $settings,
            'sections' => $sections,
            'sliders' => Slider::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'newArrivals' => Product::query()->with('images')->where('is_active', true)->where('is_new_arrival', true)->orderBy('sort_order')->get(),
            'featuredProduct' => Product::query()->with('images')->where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->first(),
            'products' => Product::query()->with('images')->where('is_active', true)->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function product(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $settings = SiteSetting::query()->pluck('value', 'key')->all();
        $product->load('images');

        $relatedProducts = Product::query()
            ->with('images')
            ->where('is_active', true)
            ->whereKeyNot($product->id)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'settings', 'relatedProducts'));
    }

    public function contact(Request $request): RedirectResponse
    {
        ContactMessage::create($request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'mobile' => ['nullable', 'string', 'max:255'],
            'product_type' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ]));

        return redirect()->to(route('home').'#contact')->with('success', 'Message saved successfully.');
    }
}
