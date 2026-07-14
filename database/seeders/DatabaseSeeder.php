<?php

namespace Database\Seeders;

use App\Models\PageSection;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $settings = [
            'brand_ar' => 'مفروشات الغويري كنب و ستائر',
            'brand_en' => 'Al-Ghuwairy Furniture Trading | Sofas & Curtains in Dammam, Saudi Arabia',
            'brand_mark' => 'غ',
            'tagline_ar' => 'كنب وستائر',
            'tagline_en' => 'Sofas & Curtains in Dammam, Saudi Arabia',
            'phone' => '00966508709877',
            'display_phone' => '+966 50 870 9877',
            'whatsapp' => '966508709877',
            'email' => 'Imdad99441@gmail.com',
            'location_ar' => 'الدمام، المملكة العربية السعودية',
            'location_en' => 'Dammam, Saudi Arabia',
            'map_url' => 'https://www.google.com/maps?q=26.428379,50.066532',
            'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57174.432536996836!2d50.037803859279144!3d26.410499748505504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49fc51151e5ce1%3A0x63d209a321c76a58!2z2YXZgdix2YjYtNin2Kog2KfZhNi62YjZitix2Yog2LfYp9mI2YTYp9iq!5e0!3m2!1sen!2sbd!4v1783089442862!5m2!1sen!2sbd',
            'footer_text_ar' => 'متجر كنب وستائر بتصاميم تناسب المنازل السعودية.',
            'footer_text_en' => 'Sofa and curtain store with designs suitable for Saudi homes.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $sections = [
            ['key' => 'hero', 'title_ar' => 'كنب وستائر فاخرة للمنزل السعودي', 'title_en' => 'Luxury Sofas & Curtains for Saudi Homes', 'subtitle_ar' => 'اكتشف تشكيلة أنيقة من الكنب، المجالس، والستائر بتصاميم تناسب الذوق السعودي العصري.', 'subtitle_en' => 'Discover elegant sofas, majlis furniture, and curtains designed for modern Saudi homes.', 'image_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=1600&q=80', 'button_text_ar' => 'تسوق الآن', 'button_text_en' => 'Shop Now', 'button_url' => '#products', 'sort_order' => 1],
            ['key' => 'new_arrival', 'title_ar' => 'وصل حديثا', 'title_en' => 'New Arrival', 'subtitle_ar' => 'أحدث تشكيلة من الكنب والستائر للمنزل السعودي.', 'subtitle_en' => 'Latest sofas and curtains for Saudi homes.', 'sort_order' => 2],
            ['key' => 'custom_cta', 'title_ar' => 'هل تريد تفصيل كنب أو ستائر حسب المقاس؟', 'title_en' => 'Need custom sofas or curtains?', 'subtitle_ar' => 'راسلنا عبر واتساب وسنساعدك في اختيار التصميم المناسب.', 'subtitle_en' => 'Message us on WhatsApp and we will help you choose the right design.', 'button_text_ar' => 'راسلنا الآن', 'button_text_en' => 'Chat Now', 'sort_order' => 3],
            ['key' => 'products', 'title_ar' => 'كل المنتجات', 'title_en' => 'All Products', 'subtitle_ar' => 'اضغط على أي منتج لإرسال اسمه عبر واتساب.', 'subtitle_en' => 'Click any product to send its name through WhatsApp.', 'sort_order' => 4],
            ['key' => 'about', 'title_ar' => 'من نحن', 'title_en' => 'About Us', 'content_ar' => 'مفروشات الغويري متجر متخصص في الكنب والستائر، نقدم تصاميم تناسب المنازل السعودية والمجالس العائلية مع جودة عالية وخدمة سهلة عبر واتساب.', 'content_en' => 'Al-Ghuwairy Furniture Trading specializes in sofas and curtains, offering designs suitable for Saudi homes and family majlis with high quality and easy WhatsApp service.', 'image_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=1200&q=80', 'sort_order' => 5],
            ['key' => 'testimonials', 'title_ar' => 'آراء العملاء', 'title_en' => 'Customer Testimonials', 'subtitle_ar' => 'ماذا قال عملاؤنا عن تجربة الشراء؟', 'subtitle_en' => 'What our customers say about their buying experience.', 'sort_order' => 6],
            ['key' => 'contact', 'title_ar' => 'تواصل معنا', 'title_en' => 'Contact Us', 'subtitle_ar' => 'أرسل لنا بياناتك وسنتواصل معك، أو راسلنا مباشرة عبر واتساب.', 'subtitle_en' => 'Send us your details and we will contact you, or message us directly on WhatsApp.', 'sort_order' => 7],
        ];

        foreach ($sections as $section) {
            PageSection::updateOrCreate(['key' => $section['key']], $section);
        }

        $products = [
            ['name_ar' => 'كنب زاوية فاخر', 'name_en' => 'Luxury Sectional Sofa', 'description_ar' => 'تصميم واسع ومريح لغرف المعيشة.', 'description_en' => 'Spacious and comfortable design for living rooms.', 'price' => 2499, 'badge_ar' => 'جديد', 'badge_en' => 'New', 'image_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=900&q=80', 'is_new_arrival' => true, 'sort_order' => 1],
            ['name_ar' => 'كنب مجلس عربي', 'name_en' => 'Arabic Majlis Sofa', 'description_ar' => 'مناسب للضيافة والمجالس السعودية.', 'description_en' => 'Perfect for Saudi majlis and guest rooms.', 'price' => 1899, 'badge_ar' => 'جديد', 'badge_en' => 'New', 'image_url' => 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=900&q=80', 'is_new_arrival' => true, 'sort_order' => 2],
            ['name_ar' => 'طقم كنب ملكي لغرفة المعيشة', 'name_en' => 'Royal Living Room Sofa Set', 'description_ar' => 'طقم كنب فاخر بتصميم واسع وخامة مريحة.', 'description_en' => 'A premium sofa set with spacious design and comfortable material.', 'price' => 3499, 'old_price' => 4100, 'badge_ar' => 'الأكثر طلبا', 'badge_en' => 'Best Seller', 'image_url' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80', 'is_featured' => true, 'sort_order' => 3],
            ['name_ar' => 'ستارة غرفة معيشة', 'name_en' => 'Living Room Curtain', 'description_ar' => 'تصميم أنيق وعملي.', 'description_en' => 'Elegant and practical design.', 'price' => 650, 'image_url' => 'https://images.unsplash.com/photo-1618221118493-9cfa1a1c00da?auto=format&fit=crop&w=900&q=80', 'sort_order' => 4],
        ];

        foreach ($products as $product) {
            $savedProduct = Product::updateOrCreate(['name_en' => $product['name_en']], $product + ['category' => 'products', 'is_active' => true]);

            if ($savedProduct->image_url && $savedProduct->images()->doesntExist()) {
                $savedProduct->images()->create([
                    'image_url' => $savedProduct->image_url,
                    'alt_ar' => $savedProduct->name_ar,
                    'alt_en' => $savedProduct->name_en,
                    'sort_order' => 0,
                    'is_primary' => true,
                ]);
            }
        }

        $testimonials = [
            ['name_ar' => 'أبو خالد', 'name_en' => 'Abu Khalid', 'city' => 'Riyadh', 'message_ar' => 'الكنب جميل ومريح، والتعامل كان سريعا عبر واتساب. أنصح بهم.', 'message_en' => 'The sofa is beautiful and comfortable, and the WhatsApp service was fast. I recommend them.', 'sort_order' => 1],
            ['name_ar' => 'أم نورة', 'name_en' => 'Umm Noura', 'city' => 'Jeddah', 'message_ar' => 'اخترت ستائر لغرفة المعيشة وكانت النتيجة رائعة جدا.', 'message_en' => 'I chose curtains for the living room and the result was excellent.', 'sort_order' => 2],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(['name_en' => $testimonial['name_en']], $testimonial + ['is_active' => true]);
        }
    }
}
