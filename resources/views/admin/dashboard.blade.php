@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3"><div class="content-card p-4"><div class="text-muted">Products</div><div class="display-6 fw-bold">{{ $productsCount }}</div></div></div>
        <div class="col-md-3"><div class="content-card p-4"><div class="text-muted">Hero Slides</div><div class="display-6 fw-bold">{{ $slidersCount }}</div></div></div>
        <div class="col-md-3"><div class="content-card p-4"><div class="text-muted">Sections</div><div class="display-6 fw-bold">{{ $sectionsCount }}</div></div></div>
        <div class="col-md-3"><div class="content-card p-4"><div class="text-muted">Testimonials</div><div class="display-6 fw-bold">{{ $testimonialsCount }}</div></div></div>
    </div>
    <div class="content-card p-4">
        <h5 class="mb-3">Latest Contact Messages</h5>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>Mobile</th><th>Product</th><th>Message</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr><td>{{ $message->name }}</td><td>{{ $message->mobile }}</td><td>{{ $message->product_type }}</td><td>{{ Str::limit($message->message, 80) }}</td><td>{{ $message->created_at->format('Y-m-d') }}</td></tr>
                    @empty
                        <tr><td colspan="5" class="text-muted">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
