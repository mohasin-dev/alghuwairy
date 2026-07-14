@extends('admin.layout')

@section('title', 'Site Settings')

@section('content')
    <form class="content-card p-4" method="post" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('put')
        @php
            $fields = [
                'brand_ar' => 'Brand Arabic',
                'brand_en' => 'Brand English',
                'brand_mark' => 'Brand Mark',
                'tagline_ar' => 'Tagline Arabic',
                'tagline_en' => 'Tagline English',
                'phone' => 'Phone for tel link',
                'display_phone' => 'Display Phone',
                'whatsapp' => 'WhatsApp Number',
                'email' => 'Email',
                'location_ar' => 'Location Arabic',
                'location_en' => 'Location English',
                'map_url' => 'Google Map URL',
                'map_embed' => 'Google Map Embed URL',
                'footer_text_ar' => 'Footer Text Arabic',
                'footer_text_en' => 'Footer Text English',
            ];
        @endphp
        <div class="row g-3">
            @foreach ($fields as $key => $label)
                <div class="{{ in_array($key, ['map_embed', 'footer_text_ar', 'footer_text_en']) ? 'col-12' : 'col-md-6' }}">
                    <label>{{ $label }}</label>
                    @if (in_array($key, ['map_embed', 'footer_text_ar', 'footer_text_en']))
                        <textarea name="{{ $key }}" class="form-control" rows="3">{{ old($key, $settings[$key] ?? '') }}</textarea>
                    @else
                        <input name="{{ $key }}" class="form-control" value="{{ old($key, $settings[$key] ?? '') }}">
                    @endif
                </div>
            @endforeach
            <div class="col-12"><button class="btn btn-success">Save Settings</button></div>
        </div>
    </form>
@endsection
