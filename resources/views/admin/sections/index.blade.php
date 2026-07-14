@extends('admin.layout')

@section('title', 'Page Sections')

@section('content')
    <div class="content-card p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Key</th><th>Title</th><th>Order</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <td><code>{{ $section->key }}</code></td>
                            <td>{{ $section->title_en }}<br><small class="text-muted">{{ $section->title_ar }}</small></td>
                            <td>{{ $section->sort_order }}</td>
                            <td>{{ $section->is_active ? 'Active' : 'Hidden' }}</td>
                            <td class="text-end"><a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-sm btn-primary">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
