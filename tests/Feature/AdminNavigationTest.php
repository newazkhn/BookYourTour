<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminNavigationTest extends TestCase
{
    use RefreshDatabase;

    private function createAdminUser()
    {
        return User::factory()->create([
            'role' => 'admin'
        ]);
    }

    /** @test */
    public function admin_can_access_dashboard()
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    /** @test */
    public function admin_can_access_destinations_page()
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get(route('admin.destinations.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function dashboard_and_destinations_have_separate_routes()
    {
        $admin = $this->createAdminUser();

        // Test dashboard route
        $dashboardResponse = $this->actingAs($admin)->get(route('admin.dashboard'));
        $dashboardResponse->assertStatus(200);

        // Test destinations route
        $destinationsResponse = $this->actingAs($admin)->get(route('admin.destinations.index'));
        $destinationsResponse->assertStatus(200);

        // Ensure they are different routes
        $this->assertNotEquals(
            route('admin.dashboard'),
            route('admin.destinations.index')
        );
    }

    /** @test */
    public function non_admin_cannot_access_admin_routes()
    {
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $dashboardResponse = $this->actingAs($user)->get(route('admin.dashboard'));
        $dashboardResponse->assertStatus(403);

        $destinationsResponse = $this->actingAs($user)->get(route('admin.destinations.index'));
        $destinationsResponse->assertStatus(403);
    }
}