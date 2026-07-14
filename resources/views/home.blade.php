@extends('layouts.master')

@section('title', $settings['brand_en'] ?? 'Al-Ghuwairy Furniture Trading')
@section('description', $sliders->first()?->subtitle_en ?? $sections['hero']->subtitle_en ?? 'Sofas and curtains in Dammam, Saudi Arabia.')

@section('content')
    @php
        $whatsappUrl = 'https://wa.me/'.($settings['whatsapp'] ?? '966508709877');
        $hero = $sections['hero'] ?? null;
        $heroSlides = $sliders->isNotEmpty()
            ? $sliders
            : collect([(object) [
                'title_ar' => $hero->title_ar ?? '', 'title_en' => $hero->title_en ?? '',
                'subtitle_ar' => $hero->subtitle_ar ?? '', 'subtitle_en' => $hero->subtitle_en ?? '',
                'image_url' => $hero->image_url ?? 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=1600&q=80',
                'button_text_ar' => $hero->button_text_ar ?? 'تسوق الآن', 'button_text_en' => $hero->button_text_en ?? 'Shop Now',
                'button_url' => $hero->button_url ?? '#products',
            ]]);
    @endphp
    <header id="home">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
            @if ($heroSlides->count() > 1)
                <div class="carousel-indicators">
                    @foreach ($heroSlides as $slide)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $loop->index }}" class="@if($loop->first) active @endif" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $loop->iteration }}"></button>
                    @endforeach
                </div>
            @endif
            <div class="carousel-inner">
                @foreach ($heroSlides as $slide)
                    <div class="carousel-item @if($loop->first) active @endif">
                        <div class="hero-slide" style="background-image:url('{{ $slide->image_url }}')">
                            <div class="container">
                                <div class="hero-content">
                                    <h1 data-ar="{{ $slide->title_ar }}" data-en="{{ $slide->title_en }}">{{ $slide->title_ar }}</h1>
                                    @if ($slide->subtitle_ar || $slide->subtitle_en)<p data-ar="{{ $slide->subtitle_ar }}" data-en="{{ $slide->subtitle_en }}">{{ $slide->subtitle_ar }}</p>@endif
                                    @if ($slide->button_text_ar || $slide->button_text_en)<a href="{{ $slide->button_url ?: '#products' }}" class="btn btn-gold" data-ar="{{ $slide->button_text_ar }}" data-en="{{ $slide->button_text_en }}">{{ $slide->button_text_ar }}</a>@endif
                                    <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-outline-light rounded-pill px-4 fw-bold ms-2" data-ar="تواصل معنا" data-en="Contact Us">تواصل معنا</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($heroSlides->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
            @endif
        </div>
    </header>

    <section class="py-5 bg-soft">
        <div class="container">
            <div class="row g-4 text-center">
                @foreach ([['bi-whatsapp','طلب سريع عبر واتساب','Quick WhatsApp Order','اضغط على أي منتج لإرسال الطلب مباشرة.','Click any product to send the order directly.'],['bi-rulers','مقاسات وألوان متعددة','Multiple Sizes & Colors','اختر المقاس واللون المناسب لمنزلك.','Choose the right size and color for your home.'],['bi-truck','توصيل وتركيب','Delivery & Installation','خدمة توصيل وتركيب داخل الدمام والمملكة.','Delivery and installation service in Dammam, Saudi Arabia.']] as $feature)
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="bi {{ $feature[0] }}"></i></div>
                            <h5 data-ar="{{ $feature[1] }}" data-en="{{ $feature[2] }}">{{ $feature[1] }}</h5>
                            <p class="text-muted mb-0" data-ar="{{ $feature[3] }}" data-en="{{ $feature[4] }}">{{ $feature[3] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.product-section', ['id' => 'new-arrival', 'section' => $sections['new_arrival'] ?? null, 'items' => $newArrivals])

    @php($cta = $sections['custom_cta'] ?? null)
    <section class="py-5" style="background:linear-gradient(135deg,var(--primary),var(--primary-dark)); color:#fff;">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h2 class="fw-bold" data-ar="{{ $cta->title_ar ?? '' }}" data-en="{{ $cta->title_en ?? '' }}">{{ $cta->title_ar ?? '' }}</h2>
                    <p class="mb-0" data-ar="{{ $cta->subtitle_ar ?? '' }}" data-en="{{ $cta->subtitle_en ?? '' }}">{{ $cta->subtitle_ar ?? '' }}</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ ($cta->button_url ?? null) ?: $whatsappUrl }}" target="_blank" class="btn btn-gold" data-ar="{{ $cta->button_text_ar ?? 'راسلنا الآن' }}" data-en="{{ $cta->button_text_en ?? 'Chat Now' }}">{{ $cta->button_text_ar ?? 'راسلنا الآن' }}</a>
                </div>
            </div>
        </div>
    </section>

    @if ($featuredProduct)
        <section id="featured" class="section-padding bg-soft">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <a class="product-card d-block text-decoration-none text-reset" href="{{ route('products.show', $featuredProduct) }}">
                            <div class="product-img" style="height:430px;background-image:url('{{ $featuredProduct->primary_image_url }}')">
                                @if ($featuredProduct->badge_ar)
                                    <span class="product-badge" data-ar="{{ $featuredProduct->badge_ar }}" data-en="{{ $featuredProduct->badge_en }}">{{ $featuredProduct->badge_ar }}</span>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="section-title" data-ar="{{ $featuredProduct->name_ar }}" data-en="{{ $featuredProduct->name_en }}">{{ $featuredProduct->name_ar }}</h2>
                        <p class="text-muted lh-lg" data-ar="{{ $featuredProduct->description_ar }}" data-en="{{ $featuredProduct->description_en }}">{{ $featuredProduct->description_ar }}</p>
                        <h3 class="price mb-4 fs-3">{{ number_format($featuredProduct->price) }} SAR @if ($featuredProduct->old_price)<span class="old-price fs-6">{{ number_format($featuredProduct->old_price) }} SAR</span>@endif</h3>
                        <button class="btn btn-main js-whatsapp-product" data-product-ar="{{ $featuredProduct->name_ar }}" data-product-en="{{ $featuredProduct->name_en }}">
                            <i class="bi bi-whatsapp"></i>
                            <span data-ar="اطلب عبر واتساب" data-en="Order on WhatsApp">اطلب عبر واتساب</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('partials.product-section', ['id' => 'products', 'section' => $sections['products'] ?? null, 'items' => $products])

    @php($about = $sections['about'] ?? null)
    <section id="about" class="section-padding bg-soft">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6"><div class="about-image" style="background-image:url('{{ $about->image_url ?? '' }}')"></div></div>
                <div class="col-lg-6">
                    <h2 class="section-title" data-ar="{{ $about->title_ar ?? '' }}" data-en="{{ $about->title_en ?? '' }}">{{ $about->title_ar ?? '' }}</h2>
                    <p class="text-muted lh-lg" data-ar="{{ $about->content_ar ?? '' }}" data-en="{{ $about->content_en ?? '' }}">{{ $about->content_ar ?? '' }}</p>
                </div>
            </div>
        </div>
    </section>

    @php($testimonialSection = $sections['testimonials'] ?? null)
    <section class="section-padding">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title" data-ar="{{ $testimonialSection->title_ar ?? '' }}" data-en="{{ $testimonialSection->title_en ?? '' }}">{{ $testimonialSection->title_ar ?? '' }}</h2>
                <p class="section-subtitle" data-ar="{{ $testimonialSection->subtitle_ar ?? '' }}" data-en="{{ $testimonialSection->subtitle_en ?? '' }}">{{ $testimonialSection->subtitle_ar ?? '' }}</p>
            </div>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($testimonials as $testimonial)
                        <div class="carousel-item @if($loop->first) active @endif">
                            <div class="testimonial-card">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="testimonial-avatar"><i class="bi bi-person"></i></div>
                                    <div>
                                        <h5 class="mb-0" data-ar="{{ $testimonial->name_ar }}" data-en="{{ $testimonial->name_en }}">{{ $testimonial->name_ar }}</h5>
                                        <small class="text-muted">{{ $testimonial->city }}</small>
                                    </div>
                                </div>
                                <p class="mb-0 lh-lg" data-ar="{{ $testimonial->message_ar }}" data-en="{{ $testimonial->message_en }}">{{ $testimonial->message_ar }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @php($contact = $sections['contact'] ?? null)
    <section id="contact" class="section-padding bg-soft">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title" data-ar="{{ $contact->title_ar ?? '' }}" data-en="{{ $contact->title_en ?? '' }}">{{ $contact->title_ar ?? '' }}</h2>
                <p class="section-subtitle" data-ar="{{ $contact->subtitle_ar ?? '' }}" data-en="{{ $contact->subtitle_en ?? '' }}">{{ $contact->subtitle_ar ?? '' }}</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="contact-card h-100">
                        <h4 class="fw-bold mb-4" data-ar="معلومات التواصل" data-en="Contact Information">معلومات التواصل</h4>
                        <p><i class="bi bi-geo-alt-fill text-success"></i> <span data-ar="{{ $settings['location_ar'] ?? '' }}" data-en="{{ $settings['location_en'] ?? '' }}">{{ $settings['location_ar'] ?? '' }}</span></p>
                        <p><i class="bi bi-telephone-fill text-success"></i> <a class="text-decoration-none text-dark" href="tel:{{ $settings['phone'] ?? '' }}">{{ $settings['display_phone'] ?? '' }}</a></p>
                        <p><i class="bi bi-whatsapp text-success"></i> <a class="text-decoration-none text-dark" href="{{ $whatsappUrl }}" target="_blank">{{ $settings['display_phone'] ?? '' }}</a></p>
                        <p><i class="bi bi-envelope-fill text-success"></i> <a class="text-decoration-none text-dark" href="mailto:{{ $settings['email'] ?? '' }}">{{ $settings['email'] ?? '' }}</a></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-card h-100">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <span data-ar="تم إرسال رسالتك بنجاح. سنتواصل معك قريباً." data-en="Your message was sent successfully. We will contact you soon.">تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="post" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="mb-3"><input name="name" type="text" class="form-control" placeholder="الاسم / Name"></div>
                            <div class="mb-3"><input name="mobile" type="tel" class="form-control" placeholder="رقم الجوال / Mobile Number"></div>
                            <div class="mb-3"><select name="product_type" class="form-select"><option>كنب / Sofa</option><option>ستائر / Curtain</option><option>كنب وستائر / Sofa & Curtain</option></select></div>
                            <div class="mb-3"><textarea name="message" class="form-control" rows="4" placeholder="رسالتك / Your Message"></textarea></div>
                            <button type="submit" class="btn btn-main w-100" data-ar="إرسال" data-en="Send">إرسال</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="map-card mt-4">
                <div class="p-4"><a class="btn btn-main" href="{{ $settings['map_url'] ?? '#' }}" target="_blank" data-ar="افتح الاتجاهات" data-en="Open Directions">افتح الاتجاهات</a></div>
                <iframe class="map-frame" src="{{ $settings['map_embed'] ?? '' }}" title="Location" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endsection
