<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PageSectionController extends Controller
{
    public function index(): View
    {
        return view('admin.sections.index', ['sections' => PageSection::orderBy('sort_order')->get()]);
    }

    public function edit(PageSection $section): View
    {
        return view('admin.sections.form', compact('section'));
    }

    public function update(Request $request, PageSection $section): RedirectResponse
    {
        $data = $request->validate([
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'subtitle_ar' => ['nullable', 'string'],
            'subtitle_en' => ['nullable', 'string'],
            'content_ar' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:8192'],
            'button_text_ar' => ['nullable', 'string', 'max:255'],
            'button_text_en' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $image = $data['image'] ?? null;
        unset($data['image']);

        if ($image instanceof UploadedFile) {
            $oldImage = $section->image_url;
            $data['image_url'] = '/storage/'.$image->store('sections', 'public');
            $this->deleteUploadedImage($oldImage);
        }

        $section->update($data);

        return redirect()->route('admin.sections.index')->with('success', 'Section updated.');
    }

    private function deleteUploadedImage(?string $url): void
    {
        $path = parse_url((string) $url, PHP_URL_PATH);

        if (is_string($path) && str_starts_with($path, '/storage/sections/')) {
            Storage::disk('public')->delete(substr($path, strlen('/storage/')));
        }
    }
}
