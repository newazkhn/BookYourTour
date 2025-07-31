<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminNavigationHighlightingTest extends TestCase
{
    use RefreshDatabase;

    private function createAdminUser()
    {
        return User::factory()->create([
            'role' => 'admin'
        ]);
    }

    public function test_dashboard_navigation_works()
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_destinations_navigation_works()
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get(route('admin.destinations.index'));

        $response->assertStatus(200);
    }

    public function test_routes_are_different()
    {
        // Verify that dashboard and destinations have different routes
        $this->assertNotEquals(
            route('admin.dashboard'),
            route('admin.destinations.index')
        );
        
        $this->assertEquals('/admin/dashboard', route('admin.dashboard', [], false));
        $this->assertEquals('/admin/destinations', route('admin.destinations.index', [], false));
    }
}