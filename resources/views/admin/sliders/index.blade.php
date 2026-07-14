@extends('admin.layout')

@section('title', 'Hero Slider')

@section('content')
    <div class="content-card p-4">
        <div class="d-flex justify-content-end mb-3"><a href="{{ route('admin.sliders.create') }}" class="btn btn-success">Add Slide</a></div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Image</th><th>Title</th><th>Order</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @forelse ($sliders as $slider)
                        <tr>
                            <td><img src="{{ $slider->image_url }}" alt="" style="width:110px;height:64px;object-fit:cover;border-radius:8px"></td>
                            <td>{{ $slider->title_en }}<br><small class="text-muted">{{ $slider->title_ar }}</small></td>
                            <td>{{ $slider->sort_order }}</td>
                            <td>{{ $slider->is_active ? 'Active' : 'Hidden' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.sliders.destroy', $slider) }}" method="post" class="d-inline" onsubmit="return confirm('Delete this slide?')">@csrf @method('delete')<button class="btn btn-sm btn-danger">Delete</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No slides yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
