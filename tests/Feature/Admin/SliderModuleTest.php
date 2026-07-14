<?php

namespace Tests\Feature\Admin;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SliderModuleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_an_admin_can_create_a_slide_with_an_uploaded_image(): void
    {
        Storage::fake('public');

        $response = $this->post(route('admin.sliders.store'), [
            'title_ar' => 'عنوان الشريحة',
            'title_en' => 'Slide title',
            'subtitle_ar' => 'وصف',
            'subtitle_en' => 'Description',
            'image' => UploadedFile::fake()->image('hero.jpg', 1600, 700),
            'button_text_ar' => 'تسوق الآن',
            'button_text_en' => 'Shop Now',
            'button_url' => '#products',
            'sort_order' => 2,
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('admin.sliders.index'));
        $slider = Slider::firstOrFail();
        $this->assertTrue($slider->is_active);
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $slider->image_url));
    }

    public function test_homepage_displays_only_active_slides_in_sort_order(): void
    {
        Slider::create($this->slideData(['title_en' => 'Second slide', 'sort_order' => 20]));
        Slider::create($this->slideData(['title_en' => 'First slide', 'sort_order' => 10]));
        Slider::create($this->slideData(['title_en' => 'Hidden slide', 'sort_order' => 0, 'is_active' => false]));

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSeeInOrder(['First slide', 'Second slide'])
            ->assertDontSee('Hidden slide')
            ->assertSee('id="heroCarousel"', false);
    }

    private function slideData(array $overrides = []): array
    {
        return array_merge([
            'title_ar' => 'شريحة',
            'title_en' => 'Slide',
            'image_url' => 'https://example.com/hero.jpg',
            'is_active' => true,
            'sort_order' => 0,
        ], $overrides);
    }
}
