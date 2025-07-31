<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Destination;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_make_booking()
    {
        $user = User::factory()->create(['role' => 'user']);
        $destination = Destination::factory()->create();

        $response = $this->actingAs($user)->post("/book/{$destination->id}", [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'people_count' => 2,
            'travel_date' => now()->addDays(30)->format('Y-m-d'),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bookings', [
            'destination_id' => $destination->id,
            'user_id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'people_count' => 2,
            'status' => 'pending',
        ]);
    }

    public function test_user_can_view_their_bookings()
    {
        $user = User::factory()->create(['role' => 'user']);
        $destination = Destination::factory()->create(['name' => 'Test Destination']);
        
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'destination_id' => $destination->id,
            'name' => 'John Doe',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->get('/my-bookings');

        $response->assertStatus(200);
        $response->assertSee('Test Destination');
        $response->assertSee('John Doe');
        $response->assertSee('Pending');
    }

    public function test_user_only_sees_their_own_bookings()
    {
        $user1 = User::factory()->create(['role' => 'user']);
        $user2 = User::factory()->create(['role' => 'user']);
        $destination = Destination::factory()->create();
        
        $booking1 = Booking::factory()->create([
            'user_id' => $user1->id,
            'destination_id' => $destination->id,
            'name' => 'User 1 Booking',
        ]);
        
        $booking2 = Booking::factory()->create([
            'user_id' => $user2->id,
            'destination_id' => $destination->id,
            'name' => 'User 2 Booking',
        ]);

        $response = $this->actingAs($user1)->get('/my-bookings');

        $response->assertStatus(200);
        $response->assertSee('User 1 Booking');
        $response->assertDontSee('User 2 Booking');
    }

    public function test_guest_cannot_make_booking()
    {
        $destination = Destination::factory()->create();

        $response = $this->post("/book/{$destination->id}", [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'people_count' => 2,
            'travel_date' => now()->addDays(30)->format('Y-m-d'),
        ]);

        $response->assertRedirect('/login');
    }

    public function test_destination_show_page_loads_correctly()
    {
        $destination = Destination::factory()->create([
            'name' => 'Test Destination',
            'location' => 'Test Location',
            'description' => 'Test Description',
        ]);

        $response = $this->get("/destinations/{$destination->id}");

        $response->assertStatus(200);
        $response->assertSee('Test Destination');
        $response->assertSee('Test Location');
        $response->assertSee('Test Description');
        $response->assertSee('Book Your Adventure');
    }
}