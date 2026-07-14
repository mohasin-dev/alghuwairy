<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index(): View
    {
        return view('admin.sliders.index', ['sliders' => Slider::query()->orderBy('sort_order')->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.sliders.form', ['slider' => new Slider()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image_url'] = $this->resolveImage($data);
        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slide created.');
    }

    public function edit(Slider $slider): View
    {
        return view('admin.sliders.form', compact('slider'));
    }

    public function update(Request $request, Slider $slider): RedirectResponse
    {
        $data = $this->validated($request, $slider);
        $oldImage = $slider->image_url;
        $data['image_url'] = $this->resolveImage($data, $slider);
        $slider->update($data);

        if ($oldImage !== $slider->image_url) {
            $this->deleteUploadedImage($oldImage);
        }

        return redirect()->route('admin.sliders.index')->with('success', 'Slide updated.');
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        $this->deleteUploadedImage($slider->image_url);
        $slider->delete();

        return back()->with('success', 'Slide deleted.');
    }

    private function validated(Request $request, ?Slider $slider = null): array
    {
        $data = $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'subtitle_ar' => ['nullable', 'string'],
            'subtitle_en' => ['nullable', 'string'],
            'image' => [$slider ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:8192'],
            'button_text_ar' => ['nullable', 'string', 'max:255'],
            'button_text_en' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function resolveImage(array &$data, ?Slider $slider = null): string
    {
        $upload = $data['image'] ?? null;
        unset($data['image']);

        if ($upload instanceof UploadedFile) {
            return '/storage/'.$upload->store('sliders', 'public');
        }

        return $slider?->image_url;
    }

    private function deleteUploadedImage(?string $url): void
    {
        $path = parse_url((string) $url, PHP_URL_PATH);

        if (is_string($path) && str_starts_with($path, '/storage/sliders/')) {
            Storage::disk('public')->delete(substr($path, strlen('/storage/')));
        }
    }
}
