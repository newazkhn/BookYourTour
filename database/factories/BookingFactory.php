<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'destination_id' => Destination::factory(),
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'people_count' => $this->faker->numberBetween(1, 8),
            'travel_date' => $this->faker->dateTimeBetween('+1 week', '+6 months'),
            'status' => $this->faker->randomElement(['pending', 'approved', 'cancelled']),
        ];
    }

    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
            ];
        });
    }

    public function approved()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'approved',
            ];
        });
    }

    public function cancelled()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'cancelled',
            ];
        });
    }
}