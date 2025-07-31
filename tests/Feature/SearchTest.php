<?php

namespace Tests\Feature;

use App\Models\Destination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_suggestions_returns_json()
    {
        $response = $this->get('/api/search/suggestions?q=test');
        
        $response->assertStatus(200)
                 ->assertJson(['suggestions' => []]);
    }

    public function test_search_suggestions_finds_destinations()
    {
        // Create test destinations
        Destination::create([
            'name' => 'Beautiful Beach',
            'location' => 'Hawaii',
            'description' => 'A stunning beach destination',
            'price_from' => 299.99
        ]);

        Destination::create([
            'name' => 'Mountain Adventure',
            'location' => 'Colorado',
            'description' => 'Great for hiking and skiing',
            'price_from' => 199.99
        ]);

        // Test search by name
        $response = $this->get('/api/search/suggestions?q=beach');
        $response->assertStatus(200);
        
        $data = $response->json();
        $this->assertCount(1, $data['suggestions']);
        $this->assertEquals('Beautiful Beach', $data['suggestions'][0]['name']);

        // Test search by location
        $response = $this->get('/api/search/suggestions?q=hawaii');
        $response->assertStatus(200);
        
        $data = $response->json();
        $this->assertCount(1, $data['suggestions']);
        $this->assertEquals('Hawaii', $data['suggestions'][0]['location']);
    }

    public function test_search_suggestions_limits_results()
    {
        // Create more than 8 destinations
        for ($i = 1; $i <= 10; $i++) {
            Destination::create([
                'name' => "Test Destination {$i}",
                'location' => "Location {$i}",
                'description' => "Description for test destination {$i}",
                'price_from' => 100 + $i
            ]);
        }

        $response = $this->get('/api/search/suggestions?q=test');
        $response->assertStatus(200);
        
        $data = $response->json();
        $this->assertLessThanOrEqual(8, count($data['suggestions']));
    }

    public function test_destinations_index_handles_search_parameter()
    {
        Destination::create([
            'name' => 'Searchable Destination',
            'location' => 'Test Location',
            'description' => 'This is a test destination',
            'price_from' => 150.00
        ]);

        $response = $this->get('/destinations?search=searchable');
        
        $response->assertStatus(200)
                 ->assertSee('Searchable Destination')
                 ->assertSee('Search Results');
    }

    public function test_destinations_index_shows_no_results_message()
    {
        $response = $this->get('/destinations?search=nonexistent');
        
        $response->assertStatus(200)
                 ->assertSee('No destinations found')
                 ->assertSee('nonexistent');
    }
}