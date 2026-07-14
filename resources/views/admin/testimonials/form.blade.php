@extends('admin.layout')

@section('title', $testimonial->exists ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
    <form class="content-card p-4" method="post" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
        @csrf
        @if ($testimonial->exists) @method('put') @endif
        <div class="row g-3">
            <div class="col-md-6"><label>Name Arabic</label><input name="name_ar" class="form-control" value="{{ old('name_ar', $testimonial->name_ar) }}" required></div>
            <div class="col-md-6"><label>Name English</label><input name="name_en" class="form-control" value="{{ old('name_en', $testimonial->name_en) }}" required></div>
            <div class="col-md-4"><label>City</label><input name="city" class="form-control" value="{{ old('city', $testimonial->city) }}"></div>
            <div class="col-md-4"><label>Sort Order</label><input name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}"></div>
            <div class="col-md-4 d-flex align-items-end"><label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $testimonial->exists ? $testimonial->is_active : true))> Active</label></div>
            <div class="col-md-6"><label>Message Arabic</label><textarea name="message_ar" class="form-control" rows="5" required>{{ old('message_ar', $testimonial->message_ar) }}</textarea></div>
            <div class="col-md-6"><label>Message English</label><textarea name="message_en" class="form-control" rows="5" required>{{ old('message_en', $testimonial->message_en) }}</textarea></div>
            <div class="col-12"><button class="btn btn-success">Save Testimonial</button> <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light">Cancel</a></div>
        </div>
    </form>
@endsection
