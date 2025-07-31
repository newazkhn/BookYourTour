<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    protected $model = Destination::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city() . ' Adventure',
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
            'description' => $this->faker->paragraph(3),
            'image' => $this->faker->randomElement([
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&h=600&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&h=600&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&h=600&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=800&h=600&fit=crop&crop=center'
            ]),
            'price_from' => $this->faker->numberBetween(199, 999),
            'rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'category' => $this->faker->randomElement(['beach', 'mountain', 'city', 'adventure', 'cultural']),
            'featured' => $this->faker->boolean(30), // 30% chance of being featured
            'duration' => $this->faker->randomElement(['3 days', '5 days', '7 days', '10 days', '2 weeks']),
            'gallery' => json_encode([
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&h=600&fit=crop&crop=center',
                'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&h=600&fit=crop&crop=center',
            ]),
            'amenities' => json_encode([
                'Free WiFi',
                'Airport Transfer',
                'Professional Guide',
                'Meals Included',
                'Insurance Coverage'
            ]),
        ];
    }

    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'featured' => true,
            ];
        });
    }

    public function popular()
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => $this->faker->randomFloat(1, 4.5, 5.0),
            ];
        });
    }
}