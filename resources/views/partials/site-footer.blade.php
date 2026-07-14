@php
    $footerLinks = [
        ['href' => route('home'), 'ar' => 'الرئيسية', 'en' => 'Home'],
        ['href' => route('home').'#products', 'ar' => 'المنتجات', 'en' => 'Products'],
        ['href' => route('home').'#about', 'ar' => 'من نحن', 'en' => 'About'],
        ['href' => route('home').'#contact', 'ar' => 'تواصل معنا', 'en' => 'Contact'],
    ];
@endphp

<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <h5>{{ $settings['brand_ar'] ?? '' }} | {{ $settings['brand_en'] ?? '' }}</h5>
                <p data-ar="{{ $settings['footer_text_ar'] ?? '' }}" data-en="{{ $settings['footer_text_en'] ?? '' }}">{{ $settings['footer_text_ar'] ?? '' }}</p>
            </div>
            <div class="col-lg-3">
                <h6 data-ar="روابط" data-en="Links">روابط</h6>
                @foreach ($footerLinks as $item)
                    <a href="{{ $item['href'] }}" data-ar="{{ $item['ar'] }}" data-en="{{ $item['en'] }}">{{ $item['ar'] }}</a>
                @endforeach
            </div>
            <div class="col-lg-4">
                <h6 data-ar="تواصل" data-en="Contact">تواصل</h6>
                <p class="mb-1"><a href="tel:{{ $settings['phone'] ?? '' }}">{{ $settings['display_phone'] ?? '' }}</a></p>
                <p class="mb-1"><a href="mailto:{{ $settings['email'] ?? '' }}">{{ $settings['email'] ?? '' }}</a></p>
                <p class="mb-0" data-ar="{{ $settings['location_ar'] ?? '' }}" data-en="{{ $settings['location_en'] ?? '' }}">{{ $settings['location_ar'] ?? '' }}</p>
            </div>
        </div>
        <hr class="border-light opacity-25 my-4">
        <div class="text-center small">&copy; <span id="currentYear"></span> {{ $settings['brand_en'] ?? '' }}. All Rights Reserved.</div>
    </div>
</footer>
