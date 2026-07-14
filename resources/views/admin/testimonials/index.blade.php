@extends('admin.layout')

@section('title', 'Testimonials')

@section('content')
    <div class="content-card p-4">
        <div class="d-flex justify-content-end mb-3"><a href="{{ route('admin.testimonials.create') }}" class="btn btn-success">Add Testimonial</a></div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>City</th><th>Message</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @foreach ($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->name_en }}<br><small class="text-muted">{{ $testimonial->name_ar }}</small></td>
                            <td>{{ $testimonial->city }}</td>
                            <td>{{ Str::limit($testimonial->message_en, 90) }}</td>
                            <td>{{ $testimonial->is_active ? 'Active' : 'Hidden' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="post" class="d-inline" onsubmit="return confirm('Delete this testimonial?')">@csrf @method('delete')<button class="btn btn-sm btn-danger">Delete</button></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
