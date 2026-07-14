<?php

namespace Tests\Feature\Admin;

use App\Models\PageSection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PageSectionImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_an_admin_can_replace_a_section_image_with_an_upload(): void
    {
        Storage::fake('public');
        $section = PageSection::create([
            'key' => 'about',
            'title_en' => 'About',
            'image_url' => 'https://example.com/old.jpg',
            'is_active' => true,
        ]);

        $response = $this->put(route('admin.sections.update', $section), [
            'title_en' => 'About',
            'image' => UploadedFile::fake()->image('about.webp'),
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('admin.sections.index'));
        $section->refresh();
        $this->assertStringStartsWith('/storage/sections/', $section->image_url);
        Storage::disk('public')->assertExists(str_replace('/storage/', '', $section->image_url));
    }
}
