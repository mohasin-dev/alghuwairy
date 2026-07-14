<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\PageSection;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'productsCount' => Product::count(),
            'slidersCount' => Slider::count(),
            'sectionsCount' => PageSection::count(),
            'testimonialsCount' => Testimonial::count(),
            'messages' => ContactMessage::latest()->take(8)->get(),
        ]);
    }
}
