<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Destination;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeInteractiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_with_interactive_features()
    {
        // Create some test destinations
        Destination::factory()->featured()->create([
            'name' => 'Test Destination',
            'location' => 'Test Location',
            'description' => 'Test description',
            'rating' => 4.5,
            'price_from' => 299
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Check that the home page contains basic content
        $response->assertSee('Discover Amazing');
        $response->assertSee('Featured Destinations');
        $response->assertSee('Test Destination');
        
        // Check for JavaScript interactive features
        $response->assertSee('scrollToSection');
        $response->assertSee('backToTop');
    }

    public function test_smooth_scrolling_elements_present()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Check for smooth scrolling functionality
        $response->assertSee('scrollToSection');
        
        // Check for essential sections
        $response->assertSee('Hero Section');
        $response->assertSee('Featured Destinations');
        $response->assertSee('What Our Travelers Say');
    }

    public function test_lazy_loading_attributes_present()
    {
        Destination::factory()->featured()->create([
            'name' => 'Test Destination',
            'image' => 'test-image.jpg'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Check for lazy loading data attributes
        $response->assertSee('data-src');
        $response->assertSee('loading-placeholder');
    }

    public function test_modal_functionality_elements_present()
    {
        Destination::factory()->featured()->create([
            'name' => 'Test Destination',
            'price_from' => 299
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Check for modal elements
        $response->assertSee('bookingModal');
        $response->assertSee('openBookingModal');
        $response->assertSee('closeBookingModal');
    }

    public function test_animation_classes_present()
    {
        Destination::factory()->featured()->create([
            'name' => 'Test Destination'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Check for animation classes
        $response->assertSee('destination-card');
        $response->assertSee('stagger-animation');
        $response->assertSee('hover-lift');
        $response->assertSee('testimonial-card');
    }

    public function test_interactive_javascript_file_included()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Check that the interactive JavaScript is included
        $response->assertSee('home-interactive');
    }
}