@if ($items->count())
    <section id="{{ $id }}" class="section-padding">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title" data-ar="{{ $section?->title_ar ?? '' }}" data-en="{{ $section?->title_en ?? '' }}">{{ $section?->title_ar ?? '' }}</h2>
                <p class="section-subtitle" data-ar="{{ $section?->subtitle_ar ?? '' }}" data-en="{{ $section?->subtitle_en ?? '' }}">{{ $section?->subtitle_ar ?? '' }}</p>
            </div>
            <div class="row g-4">
                @foreach ($items as $product)
                    @php($productImage = $product->primary_image_url)
                    <div class="col-md-6 col-lg-3">
                        <div class="product-card position-relative">
                            <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-reset">
                                <div class="product-img" style="background-image:url('{{ $productImage }}')">
                                    @if ($product->badge_ar)
                                        <span class="product-badge" data-ar="{{ $product->badge_ar }}" data-en="{{ $product->badge_en }}">{{ $product->badge_ar }}</span>
                                    @endif
                                </div>
                            </a>
                            <div class="p-4">
                                <a href="{{ route('products.show', $product) }}" class="text-decoration-none">
                                    <h5 class="product-title" data-ar="{{ $product->name_ar }}" data-en="{{ $product->name_en }}">{{ $product->name_ar }}</h5>
                                </a>
                                <p class="text-muted" data-ar="{{ $product->description_ar }}" data-en="{{ $product->description_en }}">{{ $product->description_ar }}</p>
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <span class="price">{{ number_format($product->price) }} SAR</span>
                                    <button type="button" class="product-whatsapp-btn js-whatsapp-product" data-product-ar="{{ $product->name_ar }}" data-product-en="{{ $product->name_en }}" aria-label="Order on WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
