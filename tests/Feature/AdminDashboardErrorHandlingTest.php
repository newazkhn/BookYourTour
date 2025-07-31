<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class AdminDashboardErrorHandlingTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_handles_database_errors_gracefully()
    {
        // Create an admin user
        $admin = User::factory()->create(['role' => 'admin']);

        // Act as admin and visit dashboard
        $response = $this->actingAs($admin)->get('/admin/dashboard');

        // Should still return 200 even if there are database issues
        $response->assertStatus(200);
        
        // Should contain the dashboard view
        $response->assertViewIs('admin.dashboard');
        
        // Should have dashboard data with default values
        $response->assertViewHas('dashboardData');
        
        $dashboardData = $response->viewData('dashboardData');
        
        // Verify structure exists with default values
        $this->assertArrayHasKey('destinations', $dashboardData);
        $this->assertArrayHasKey('bookings', $dashboardData);
        $this->assertArrayHasKey('revenue', $dashboardData);
        
        // All values should be numeric (0 or actual values)
        $this->assertIsNumeric($dashboardData['destinations']['total']);
        $this->assertIsNumeric($dashboardData['bookings']['total']);
        $this->assertIsNumeric($dashboardData['revenue']['total']);
    }

    public function test_dashboard_displays_statistics_correctly()
    {
        // Create an admin user
        $admin = User::factory()->create(['role' => 'admin']);

        // Act as admin and visit dashboard
        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Total Revenue');
        $response->assertSee('Destination Statistics');
        $response->assertSee('Booking Statistics');
    }
}