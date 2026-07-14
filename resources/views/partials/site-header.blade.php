@php
    $navItems = [
        ['target' => 'home', 'ar' => 'الرئيسية', 'en' => 'Home'],
        ['target' => 'new-arrival', 'ar' => 'وصل حديثا', 'en' => 'New Arrival'],
        ['target' => 'featured', 'ar' => 'المميز', 'en' => 'Featured'],
        ['target' => 'products', 'ar' => 'المنتجات', 'en' => 'Products'],
        ['target' => 'about', 'ar' => 'من نحن', 'en' => 'About'],
        ['target' => 'contact', 'ar' => 'تواصل معنا', 'en' => 'Contact'],
    ];
@endphp

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('home') }}">
            <span class="brand-mark">{{ $settings['brand_mark'] ?? 'غ' }}</span>
            <span>
                <span class="d-block brand-ar">{{ $settings['brand_ar'] ?? '' }}</span>
                <span class="d-block brand-en">{{ $settings['brand_en'] ?? '' }}</span>
                <small class="brand-subtitle" data-ar="{{ $settings['tagline_ar'] ?? '' }}" data-en="{{ $settings['tagline_en'] ?? '' }}">{{ $settings['tagline_ar'] ?? '' }}</small>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                @foreach ($navItems as $item)
                    @php($href = request()->routeIs('home') ? '#'.$item['target'] : route('home').'#'.$item['target'])
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $href }}" data-ar="{{ $item['ar'] }}" data-en="{{ $item['en'] }}">{{ $item['ar'] }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="language-switch">
                <button type="button" class="language-btn active" data-lang="ar">العربية</button>
                <button type="button" class="language-btn" data-lang="en">English</button>
            </div>
        </div>
    </div>
</nav>
