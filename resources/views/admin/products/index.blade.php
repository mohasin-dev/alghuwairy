@extends('admin.layout')

@section('title', 'Products')

@section('content')
    <div class="content-card p-4">
        <div class="d-flex justify-content-end mb-3"><a href="{{ route('admin.products.create') }}" class="btn btn-success">Add Product</a></div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Image</th><th>Name</th><th>Price</th><th>Flags</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><img src="{{ $product->primary_image_url }}" alt="" style="width:72px;height:52px;object-fit:cover;border-radius:8px"></td>
                            <td>{{ $product->name_en }}<br><small class="text-muted">{{ $product->name_ar }}</small></td>
                            <td>{{ $product->price ? number_format($product->price) . ' SAR' : '-' }}</td>
                            <td>@if($product->is_featured)<span class="badge text-bg-warning">Featured</span>@endif @if($product->is_new_arrival)<span class="badge text-bg-info">New</span>@endif</td>
                            <td>{{ $product->is_active ? 'Active' : 'Hidden' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="post" class="d-inline" onsubmit="return confirm('Delete this product?')">@csrf @method('delete')<button class="btn btn-sm btn-danger">Delete</button></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
@endsection
