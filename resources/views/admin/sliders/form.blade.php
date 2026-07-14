@extends('admin.layout')

@section('title', $slider->exists ? 'Edit Slide' : 'Add Slide')

@section('content')
    <form class="content-card p-4" method="post" enctype="multipart/form-data" action="{{ $slider->exists ? route('admin.sliders.update', $slider) : route('admin.sliders.store') }}">
        @csrf
        @if ($slider->exists) @method('put') @endif
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Title Arabic</label><input name="title_ar" class="form-control" value="{{ old('title_ar', $slider->title_ar) }}" required></div>
            <div class="col-md-6"><label class="form-label">Title English</label><input name="title_en" class="form-control" value="{{ old('title_en', $slider->title_en) }}" required></div>
            <div class="col-md-6"><label class="form-label">Subtitle Arabic</label><textarea name="subtitle_ar" class="form-control" rows="3">{{ old('subtitle_ar', $slider->subtitle_ar) }}</textarea></div>
            <div class="col-md-6"><label class="form-label">Subtitle English</label><textarea name="subtitle_en" class="form-control" rows="3">{{ old('subtitle_en', $slider->subtitle_en) }}</textarea></div>
            <div class="col-12">
                <label class="form-label">Background Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp,image/gif">
                <small class="text-muted">JPG, PNG, WebP or GIF, up to 8 MB.</small>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @if ($slider->image_url)
                <div class="col-12"><img src="{{ $slider->image_url }}" alt="Current slide" class="rounded border" style="width:240px;height:120px;object-fit:cover"></div>
            @endif
            <div class="col-md-4"><label class="form-label">Button Text Arabic</label><input name="button_text_ar" class="form-control" value="{{ old('button_text_ar', $slider->button_text_ar) }}"></div>
            <div class="col-md-4"><label class="form-label">Button Text English</label><input name="button_text_en" class="form-control" value="{{ old('button_text_en', $slider->button_text_en) }}"></div>
            <div class="col-md-4"><label class="form-label">Button URL</label><input name="button_url" class="form-control" value="{{ old('button_url', $slider->button_url ?: '#products') }}"></div>
            <div class="col-md-3"><label class="form-label">Sort Order</label><input name="sort_order" type="number" min="0" class="form-control" value="{{ old('sort_order', $slider->sort_order ?? 0) }}"></div>
            <div class="col-md-3 d-flex align-items-end"><label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $slider->exists ? $slider->is_active : true))> Active</label></div>
            <div class="col-12"><button class="btn btn-success">Save Slide</button> <a href="{{ route('admin.sliders.index') }}" class="btn btn-light">Cancel</a></div>
        </div>
    </form>
@endsection
