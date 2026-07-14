@extends('layouts.master')

@section('title', $product->name_en . ' | ' . ($settings['brand_en'] ?? 'Al-Ghuwairy Furniture Trading'))
@section('description', $product->description_en)

@section('meta')
    <meta property="og:type" content="product">
    <meta property="og:title" content="{{ $product->name_en }}">
    <meta property="og:description" content="{{ $product->description_en }}">
    <meta property="og:image" content="{{ $product->primary_image_url }}">
    <link rel="canonical" href="{{ route('products.show', $product) }}">
@endsection

@section('content')
    @php
        $productWhatsAppUrl = 'https://wa.me/'.($settings['whatsapp'] ?? '966508709877').'?text='.rawurlencode('Hello, I want to ask about this product: '.$product->name_en);
        $galleryImages = $product->images->count()
            ? $product->images
            : collect([(object) ['image_url' => $product->image_url, 'alt_ar' => $product->name_ar, 'alt_en' => $product->name_en]]);
        $primaryImage = $galleryImages->first()?->image_url;
    @endphp

    <main class="product-shell">
        <div class="container">
            <nav class="breadcrumb mb-4">
                <a href="{{ route('home') }}" data-ar="الرئيسية" data-en="Home">الرئيسية</a>
                <span class="mx-2">/</span>
                <a href="{{ route('home') }}#products" data-ar="المنتجات" data-en="Products">المنتجات</a>
                <span class="mx-2">/</span>
                <span data-ar="{{ $product->name_ar }}" data-en="{{ $product->name_en }}">{{ $product->name_ar }}</span>
            </nav>

            <div class="row g-4 align-items-start">
                <div class="col-lg-6">
                    <div class="product-gallery">
                        <div id="productMainImage" class="product-photo" style="background-image:url('{{ $primaryImage }}')" role="img" aria-label="{{ $product->name_en }}"></div>
                    </div>
                    @if ($galleryImages->count() > 1)
                        <div class="row g-2 mt-3">
                            @foreach ($galleryImages as $image)
                                <div class="col-3">
                                    <button type="button" class="gallery-thumb w-100 border-0 p-0 rounded overflow-hidden" data-image="{{ $image->image_url }}" aria-label="{{ $image->alt_en ?: $product->name_en }}">
                                        <img src="{{ $image->image_url }}" alt="{{ $image->alt_en ?: $product->name_en }}" class="img-fluid w-100" style="height:92px;object-fit:cover">
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <article class="details-card">
                        @if ($product->badge_ar)
                            <span class="badge-gold mb-3" data-ar="{{ $product->badge_ar }}" data-en="{{ $product->badge_en }}">{{ $product->badge_ar }}</span>
                        @endif
                        <h1 class="product-detail-title" data-ar="{{ $product->name_ar }}" data-en="{{ $product->name_en }}">{{ $product->name_ar }}</h1>
                        <p class="product-description mt-3" data-ar="{{ $product->description_ar }}" data-en="{{ $product->description_en }}">{{ $product->description_ar }}</p>
                        <div class="my-4">
                            <span class="price fs-2">{{ number_format($product->price) }} SAR</span>
                            @if ($product->old_price)
                                <span class="old-price fs-5">{{ number_format($product->old_price) }} SAR</span>
                            @endif
                        </div>
                        <div class="d-flex flex-wrap gap-3">
                            <a class="btn btn-main js-whatsapp-link" href="{{ $productWhatsAppUrl }}" target="_blank" data-product-ar="{{ $product->name_ar }}" data-product-en="{{ $product->name_en }}">
                                <i class="bi bi-whatsapp"></i>
                                <span data-ar="اطلب عبر واتساب" data-en="Order on WhatsApp">اطلب عبر واتساب</span>
                            </a>
                            <a class="btn btn-gold" href="tel:{{ $settings['phone'] ?? '' }}">
                                <i class="bi bi-telephone-fill"></i>
                                <span data-ar="اتصل الآن" data-en="Call Now">اتصل الآن</span>
                            </a>
                        </div>
                        <div class="info-row">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <strong data-ar="القسم" data-en="Category">القسم</strong>
                                    <div class="text-muted">{{ ucfirst($product->category) }}</div>
                                </div>
                                <div class="col-sm-6">
                                    <strong data-ar="التوفر" data-en="Availability">التوفر</strong>
                                    <div class="text-success fw-bold" data-ar="متوفر" data-en="Available">متوفر</div>
                                </div>
                                <div class="col-sm-6">
                                    <strong data-ar="التواصل" data-en="Contact">التواصل</strong>
                                    <div><a href="tel:{{ $settings['phone'] ?? '' }}" class="text-decoration-none text-dark">{{ $settings['display_phone'] ?? '' }}</a></div>
                                </div>
                                <div class="col-sm-6">
                                    <strong data-ar="الموقع" data-en="Location">الموقع</strong>
                                    <div class="text-muted" data-ar="{{ $settings['location_ar'] ?? '' }}" data-en="{{ $settings['location_en'] ?? '' }}">{{ $settings['location_ar'] ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            @if ($relatedProducts->count())
                <section class="mt-5">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="h3 fw-bold mb-0" data-ar="منتجات مشابهة" data-en="Related Products">منتجات مشابهة</h2>
                        <a href="{{ route('home') }}#products" class="text-decoration-none fw-bold" data-ar="عرض الكل" data-en="View All">عرض الكل</a>
                    </div>
                    <div class="row g-4">
                        @foreach ($relatedProducts as $related)
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('products.show', $related) }}" class="related-card d-block text-decoration-none text-reset">
                                    <div class="related-img" style="background-image:url('{{ $related->primary_image_url }}')"></div>
                                    <div class="p-3">
                                        <h3 class="h6 related-title" data-ar="{{ $related->name_ar }}" data-en="{{ $related->name_en }}">{{ $related->name_ar }}</h3>
                                        <div class="price fs-5">{{ number_format($related->price) }} SAR</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.gallery-thumb').forEach((button) => {
            button.addEventListener('click', () => {
                const mainImage = document.getElementById('productMainImage');

                if (mainImage) {
                    mainImage.style.backgroundImage = "url('" + button.dataset.image + "')";
                }
            });
        });
    </script>
@endpush
