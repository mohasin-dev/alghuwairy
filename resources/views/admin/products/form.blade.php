@extends('admin.layout')

@section('title', $product->exists ? 'Edit Product' : 'Add Product')

@section('content')
    <form class="content-card p-4" method="post" enctype="multipart/form-data" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
        @csrf
        @if ($product->exists) @method('put') @endif
        <div class="row g-3">
            <div class="col-md-6"><label>Name Arabic</label><input name="name_ar" class="form-control" value="{{ old('name_ar', $product->name_ar) }}" required></div>
            <div class="col-md-6"><label>Name English</label><input name="name_en" class="form-control" value="{{ old('name_en', $product->name_en) }}" required></div>
            <div class="col-md-6"><label>Description Arabic</label><textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar', $product->description_ar) }}</textarea></div>
            <div class="col-md-6"><label>Description English</label><textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $product->description_en) }}</textarea></div>
            <div class="col-12">
                <label class="form-label">Featured Image</label>
                <input type="file" name="primary_image" class="form-control @error('primary_image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp,image/gif">
                <small class="text-muted">JPG, PNG, WebP or GIF, up to 5 MB. A new upload replaces the current featured image.</small>
                @error('primary_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Gallery Images</label>
                <input type="file" name="gallery_images[]" class="form-control @error('gallery_images.*') is-invalid @enderror" accept="image/jpeg,image/png,image/webp,image/gif" multiple>
                <small class="text-muted">Select up to 12 images; each can be up to 5 MB. New images are added to the gallery.</small>
                @error('gallery_images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @if ($product->exists && $product->images->count())
                <div class="col-12">
                    <label class="form-label">Current Images</label>
                    <div class="row g-2">
                        @foreach ($product->images as $image)
                            <div class="col-6 col-md-3 col-lg-2">
                                <img src="{{ $image->image_url }}" alt="{{ $image->alt_en }}" class="img-fluid rounded border" style="height:110px;width:100%;object-fit:cover">
                                <div class="small mt-1">
                                    @if ($image->is_primary)
                                        <span class="badge text-bg-success">Featured</span>
                                    @else
                                        <label class="text-danger"><input type="checkbox" name="remove_image_ids[]" value="{{ $image->id }}"> Remove</label>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="col-md-3"><label>Price</label><input name="price" type="number" step="0.01" class="form-control" value="{{ old('price', $product->price) }}"></div>
            <div class="col-md-3"><label>Old Price</label><input name="old_price" type="number" step="0.01" class="form-control" value="{{ old('old_price', $product->old_price) }}"></div>
            <div class="col-md-3"><label>Badge Arabic</label><input name="badge_ar" class="form-control" value="{{ old('badge_ar', $product->badge_ar) }}"></div>
            <div class="col-md-3"><label>Badge English</label><input name="badge_en" class="form-control" value="{{ old('badge_en', $product->badge_en) }}"></div>
            <div class="col-md-4"><label>Category</label><input name="category" class="form-control" value="{{ old('category', $product->category ?: 'products') }}"></div>
            <div class="col-md-2"><label>Sort Order</label><input name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $product->sort_order ?? 0) }}"></div>
            <div class="col-md-6 d-flex align-items-end gap-4">
                <label><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))> Featured</label>
                <label><input type="checkbox" name="is_new_arrival" value="1" @checked(old('is_new_arrival', $product->is_new_arrival))> New Arrival</label>
                <label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->exists ? $product->is_active : true))> Active</label>
            </div>
            <div class="col-12"><button class="btn btn-success">Save Product</button> <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancel</a></div>
        </div>
    </form>
@endsection
