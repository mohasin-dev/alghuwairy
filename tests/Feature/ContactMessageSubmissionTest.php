<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactMessageSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_submission_redirects_to_a_visible_success_message(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Customer',
            'mobile' => '0500000000',
            'product_type' => 'Sofa',
            'message' => 'Please contact me.',
        ]);

        $response->assertRedirect(route('home').'#contact')
            ->assertSessionHas('success');

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Your message was sent successfully. We will contact you soon.');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Customer',
            'mobile' => '0500000000',
        ]);
    }
}
