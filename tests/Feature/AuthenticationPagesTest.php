<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AuthenticationPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_loads_correctly()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Welcome Back');
        $response->assertSee('Sign in to continue your journey');
        $response->assertSee('Email Address');
        $response->assertSee('Password');
        $response->assertSee('Sign In');
        $response->assertSee('Create one now');
    }

    public function test_register_page_loads_correctly()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Create Account');
        $response->assertSee('Join thousands of travelers worldwide');
        $response->assertSee('Full Name');
        $response->assertSee('Email Address');
        $response->assertSee('Password');
        $response->assertSee('Confirm Password');
        $response->assertSee('Create Account');
        $response->assertSee('Sign in here');
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_login_and_access_admin_panel()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin/destinations');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_user_cannot_login_with_incorrect_credentials()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function test_user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/');
        
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'user',
        ]);
        
        $this->assertAuthenticated();
    }

    public function test_user_cannot_register_with_invalid_data()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '123',
            'password_confirmation' => '456',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
    }

    public function test_destinations_page_loads_with_modern_design()
    {
        $response = $this->get('/destinations');

        $response->assertStatus(200);
        $response->assertSee('Explore Amazing');
        $response->assertSee('Destinations');
        $response->assertSee('Discover breathtaking places');
        $response->assertSee('destination-card');
    }

    public function test_guest_layout_has_modern_styling()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('BookYourTour');
        $response->assertSee('bg-gradient-to-br');
        $response->assertSee('backdrop-blur-sm');
    }

    public function test_regular_user_cannot_access_admin_panel()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/destinations');

        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Access denied. Admin privileges required.');
    }

    public function test_admin_can_access_admin_panel()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/destinations');

        $response->assertStatus(200);
    }

    public function test_user_bookings_page_requires_authentication()
    {
        $response = $this->get('/my-bookings');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_bookings_page()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/my-bookings');

        $response->assertStatus(200);
        $response->assertSee('My Bookings');
    }
}