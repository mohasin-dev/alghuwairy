<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [HomeController::class, 'product'])->name('products.show');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class)->except('show');
        Route::resource('sliders', SliderController::class)->except('show');
        Route::resource('testimonials', TestimonialController::class)->except('show');
        Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::put('messages/{message}', [ContactMessageController::class, 'update'])->name('messages.update');
        Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
        Route::get('sections', [PageSectionController::class, 'index'])->name('sections.index');
        Route::get('sections/{section}/edit', [PageSectionController::class, 'edit'])->name('sections.edit');
        Route::put('sections/{section}', [PageSectionController::class, 'update'])->name('sections.update');
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
