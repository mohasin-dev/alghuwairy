@extends('admin.layout')

@section('title', 'Edit Section: ' . $section->key)

@section('content')
    <form class="content-card p-4" method="post" enctype="multipart/form-data" action="{{ route('admin.sections.update', $section) }}">
        @csrf
        @method('put')
        <div class="row g-3">
            <div class="col-md-6"><label>Title Arabic</label><input name="title_ar" class="form-control" value="{{ old('title_ar', $section->title_ar) }}"></div>
            <div class="col-md-6"><label>Title English</label><input name="title_en" class="form-control" value="{{ old('title_en', $section->title_en) }}"></div>
            <div class="col-md-6"><label>Subtitle Arabic</label><textarea name="subtitle_ar" class="form-control" rows="3">{{ old('subtitle_ar', $section->subtitle_ar) }}</textarea></div>
            <div class="col-md-6"><label>Subtitle English</label><textarea name="subtitle_en" class="form-control" rows="3">{{ old('subtitle_en', $section->subtitle_en) }}</textarea></div>
            <div class="col-md-6"><label>Content Arabic</label><textarea name="content_ar" class="form-control" rows="5">{{ old('content_ar', $section->content_ar) }}</textarea></div>
            <div class="col-md-6"><label>Content English</label><textarea name="content_en" class="form-control" rows="5">{{ old('content_en', $section->content_en) }}</textarea></div>
            <div class="col-md-12">
                <label class="form-label">Section Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp,image/gif">
                <small class="text-muted">JPG, PNG, WebP or GIF, up to 8 MB. Leave empty to keep the current image.</small>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @if ($section->image_url)
                <div class="col-12"><img src="{{ $section->image_url }}" alt="Current section" class="rounded border" style="width:240px;height:120px;object-fit:cover"></div>
            @endif
            <div class="col-md-4"><label>Button Text Arabic</label><input name="button_text_ar" class="form-control" value="{{ old('button_text_ar', $section->button_text_ar) }}"></div>
            <div class="col-md-4"><label>Button Text English</label><input name="button_text_en" class="form-control" value="{{ old('button_text_en', $section->button_text_en) }}"></div>
            <div class="col-md-4"><label>Button URL</label><input name="button_url" class="form-control" value="{{ old('button_url', $section->button_url) }}"></div>
            <div class="col-md-2"><label>Sort Order</label><input name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $section->sort_order) }}"></div>
            <div class="col-md-10 d-flex align-items-end"><label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $section->is_active))> Active</label></div>
            <div class="col-12"><button class="btn btn-success">Save Section</button> <a href="{{ route('admin.sections.index') }}" class="btn btn-light">Cancel</a></div>
        </div>
    </form>
@endsection
