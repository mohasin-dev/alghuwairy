<!doctype html>
<html lang="{{ $pageLang ?? 'ar' }}" dir="{{ $pageDir ?? 'rtl' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $settings['brand_en'] ?? 'Al-Ghuwairy Furniture Trading | Sofas & Curtains in Dammam, Saudi Arabia')</title>
    <meta name="description" content="@yield('description', 'Al-Ghuwairy Furniture Trading offers premium sofas, curtains, Arabic majlis furniture, living room sofas, custom curtain design, delivery, and WhatsApp ordering in Dammam, Saudi Arabia, 00966508709877.')">
    @yield('meta')

    <meta name="keywords"
        content="Al-Ghuwairy Furniture, مفروشات الغويري, sofas Dammam, Saudi Arabia, sofas in Riyadh, curtains Dammam, Saudi Arabia, sofa and curtain shop, Arabic majlis sofa, living room furniture Dammam, Saudi Arabia, custom curtains, luxury sofa, 00966508709877, كنب السعودية, ستائر السعودية, كنب وستائر, مجالس عربية">
    <meta name="author" content="Al-Ghuwairy Furniture Trading">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="language" content="Arabic, English">
    <meta name="theme-color" content="#0b5d3b">
    <meta name="format-detection" content="telephone=yes">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0b5d3b;
            --primary-dark: #063b24;
            --gold: #c9a227;
            --cream: #fffaf0;
            --sand: #f5ead8;
            --text: #1f2933;
            --muted: #6b7280;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--cream);
            color: var(--text);
            overflow-x: hidden;
        }

        .navbar {
            background: rgba(255, 250, 240, .97);
            box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--gold));
            color: #fff;
            font-size: 26px;
            font-weight: 900;
            flex: 0 0 auto;
        }

        .brand-ar {
            color: var(--primary);
            font-weight: 900;
        }

        .brand-en {
            color: #6f4e37;
            font-weight: 800;
        }

        .brand-subtitle {
            color: #8a6f3d;
            font-size: 13px;
            font-weight: 700;
        }

        .nav-link {
            color: var(--primary-dark) !important;
            font-weight: 800;
        }

        .language-switch {
            display: inline-flex;
            gap: 4px;
            padding: 4px;
            border-radius: 50px;
            background: #fff;
            border: 1px solid rgba(11, 93, 59, .16);
        }

        .language-btn {
            border: 0;
            border-radius: 50px;
            background: transparent;
            color: var(--primary-dark);
            padding: 7px 14px;
            font-weight: 900;
        }

        .language-btn.active {
            background: var(--primary);
            color: #fff;
        }

        .hero-slide {
            min-height: 650px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            color: #fff;
        }

        .hero-slide:before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(6, 59, 36, .72);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 760px;
        }

        .hero-content h1 {
            font-size: clamp(36px, 5vw, 68px);
            font-weight: 900;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 20px;
            line-height: 1.8;
        }

        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            color: var(--primary-dark);
            font-weight: 900;
            margin-bottom: 12px;
        }

        .section-subtitle {
            color: var(--muted);
            max-width: 760px;
            margin: 0 auto 40px;
            line-height: 1.8;
        }

        .bg-soft {
            background: var(--sand);
        }

        .btn-main,
        .btn-gold {
            border: 0;
            border-radius: 50px;
            padding: 10px 24px;
            font-weight: 800;
            color: #fff;
        }

        .btn-main {
            background: var(--primary);
        }

        .btn-gold {
            background: var(--gold);
        }

        .feature-card,
        .product-card,
        .testimonial-card,
        .contact-card,
        .map-card,
        .product-gallery,
        .details-card,
        .related-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 14px 35px rgba(0, 0, 0, .07);
            border: 1px solid rgba(11, 93, 59, .08);
        }

        .feature-card {
            padding: 28px;
            height: 100%;
        }

        .feature-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: var(--primary);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 18px;
        }

        .product-card {
            overflow: hidden;
            height: 100%;
            cursor: pointer;
            transition: .25s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 48px rgba(11, 93, 59, .16);
        }

        .product-img {
            height: 240px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .product-badge,
        .badge-gold {
            background: var(--gold);
            color: #fff;
            border-radius: 50px;
            font-weight: 900;
        }

        .product-badge {
            position: absolute;
            top: 14px;
            inset-inline-start: 14px;
            padding: 5px 12px;
            font-size: 13px;
        }

        .badge-gold {
            padding: 7px 14px;
            display: inline-block;
        }

        .product-title,
        .related-title {
            color: var(--primary-dark);
            font-weight: 900;
        }

        .price {
            color: var(--primary);
            font-weight: 900;
        }

        .old-price {
            color: #999;
            text-decoration: line-through;
            margin-inline-start: 8px;
        }

        .product-whatsapp-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 0;
            background: #25d366;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .about-image {
            min-height: 440px;
            border-radius: 24px;
            background-size: cover;
            background-position: center;
        }

        .testimonial-card {
            padding: 32px;
            max-width: 800px;
            margin: auto;
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--sand);
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .testimonial-name-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .testimonial-name-row h5 {
            direction: auto;
        }

        .testimonial-stars {
            display: inline-flex;
            gap: 2px;
            direction: ltr;
            color: var(--gold);
            font-size: 14px;
            line-height: 1;
            white-space: nowrap;
        }

        .contact-card {
            padding: 34px;
        }

        .map-card {
            overflow: hidden;
        }

        .map-frame {
            width: 100%;
            height: 420px;
            border: 0;
            display: block;
        }

        .product-shell {
            padding: 70px 0;
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 800;
        }

        .product-gallery {
            overflow: hidden;
        }

        .product-photo {
            width: 100%;
            min-height: 520px;
            background-size: cover;
            background-position: center;
        }

        .details-card {
            padding: 34px;
        }

        .product-detail-title {
            color: var(--primary-dark);
            font-weight: 900;
            font-size: clamp(32px, 4vw, 52px);
            line-height: 1.2;
        }

        .product-description {
            color: var(--muted);
            font-size: 18px;
            line-height: 1.9;
        }

        .info-row {
            border-top: 1px solid #eef2f0;
            padding-top: 16px;
            margin-top: 16px;
        }

        .related-card {
            overflow: hidden;
        }

        .related-img {
            height: 180px;
            background-size: cover;
            background-position: center;
        }

        footer {
            background: var(--primary-dark);
            color: rgba(255, 255, 255, .8);
            padding: 60px 0 24px;
        }

        footer h5,
        footer h6 {
            color: #fff;
            font-weight: 900;
        }

        footer a {
            color: rgba(255, 255, 255, .8);
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
        }

        .call-float,
        .whatsapp-float {
            position: fixed;
            right: 22px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            z-index: 9999;
            text-decoration: none;
        }

        .call-float {
            bottom: 105px;
            background: var(--primary);
        }

        .whatsapp-float {
            bottom: 22px;
            background: #25d366;
        }

        @media (max-width:576px) {
            .hero-slide {
                min-height: 520px
            }

            .section-padding {
                padding: 60px 0
            }

            .product-img {
                height: 210px
            }

            .map-frame {
                height: 320px
            }

            .product-shell {
                padding: 42px 0
            }

            .product-photo {
                min-height: 330px
            }

            .details-card {
                padding: 24px
            }

            .brand-text {
                font-size: 15px;
            }
        }
    </style>
    
    @stack('styles')
</head>

<body>
    @php
        $whatsapp = $settings['whatsapp'] ?? '966508709877';
        $whatsappUrl = 'https://wa.me/' . $whatsapp;
    @endphp

    @include('partials.site-header')

    @yield('content')

    @include('partials.site-footer')

    <a href="tel:{{ $settings['phone'] ?? '' }}" class="call-float" aria-label="Call"><i
            class="bi bi-telephone-fill"></i></a>
    <a href="{{ $whatsappUrl }}" target="_blank" class="whatsapp-float" aria-label="WhatsApp"><i
            class="bi bi-whatsapp"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const phoneNumber = @json($whatsapp);
        const languageStorageKey = 'site_language';
        let currentLang = localStorage.getItem(languageStorageKey) || 'ar';

        function changeLanguage(lang) {
            if (!['ar', 'en'].includes(lang)) {
                lang = 'ar';
            }

            currentLang = lang;
            localStorage.setItem(languageStorageKey, lang);
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            document.querySelectorAll('[data-ar][data-en]').forEach((element) => element.textContent = element.getAttribute(
                'data-' + lang));
            document.querySelectorAll('.language-btn').forEach((button) => button.classList.toggle('active', button
                .getAttribute('data-lang') === lang));
            document.querySelectorAll('.js-whatsapp-link').forEach((link) => {
                const productName = link.getAttribute('data-product-' + lang);

                if (productName) {
                    const message = lang === 'ar' ?
                        'مرحبا، أريد الاستفسار عن المنتج: ' + productName :
                        'Hello, I want to ask about this product: ' + productName;

                    link.href = 'https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent(message);
                }
            });
        }

        function openWhatsApp(productName) {
            const message = currentLang === 'ar' ?
                'مرحبا، أريد الاستفسار عن المنتج: ' + productName :
                'Hello, I want to ask about this product: ' + productName;

            window.open('https://wa.me/' + phoneNumber + '?text=' + encodeURIComponent(message), '_blank');
        }

        document.querySelectorAll('.js-whatsapp-product').forEach((product) => {
            product.addEventListener('click', (event) => {
                event.preventDefault();
                event.stopPropagation();
                openWhatsApp(product.getAttribute('data-product-' + currentLang));
            });
        });
        document.querySelectorAll('.language-btn').forEach((button) => button.addEventListener('click', () =>
            changeLanguage(button.getAttribute('data-lang'))));

        const currentYear = document.getElementById('currentYear');
        if (currentYear) {
            currentYear.textContent = new Date().getFullYear();
        }

        changeLanguage(currentLang);
    </script>
    @stack('scripts')
</body>

</html>
