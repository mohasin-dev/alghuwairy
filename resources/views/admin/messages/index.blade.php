@extends('admin.layout')

@section('title', 'Contact Messages')

@section('content')
    <div class="content-card p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>Mobile</th><th>Product</th><th>Message</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr>
                            <td>{{ $message->name ?: '-' }}</td>
                            <td>{{ $message->mobile ?: '-' }}</td>
                            <td>{{ $message->product_type ?: '-' }}</td>
                            <td>{{ $message->message ?: '-' }}</td>
                            <td>{{ $message->is_read ? 'Read' : 'New' }}</td>
                            <td class="text-end">
                                @unless ($message->is_read)
                                    <form action="{{ route('admin.messages.update', $message) }}" method="post" class="d-inline">@csrf @method('put')<button class="btn btn-sm btn-primary">Mark Read</button></form>
                                @endunless
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="post" class="d-inline" onsubmit="return confirm('Delete this message?')">@csrf @method('delete')<button class="btn btn-sm btn-danger">Delete</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-muted">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $messages->links() }}
    </div>
@endsection
