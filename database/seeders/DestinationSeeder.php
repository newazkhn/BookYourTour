<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Bali Paradise Resort',
                'location' => 'Bali, Indonesia',
                'description' => 'Experience the ultimate tropical getaway with pristine beaches, lush rice terraces, and vibrant culture. Perfect for relaxation and adventure.',
                'image' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=800&h=600&fit=crop&crop=center',
                'price_from' => 899.00,
                'rating' => 4.8,
                'category' => 'beach',
                'featured' => true,
                'gallery' => [
                    'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1555400082-6e5b3e6b7b7b?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center'
                ],
                'amenities' => [
                    'Private Beach Access',
                    'Spa & Wellness Center',
                    'Infinity Pool',
                    'Cultural Tours',
                    'Water Sports',
                    'Fine Dining'
                ],
                'duration' => '7 days / 6 nights'
            ],
            [
                'name' => 'Swiss Alps Adventure',
                'location' => 'Zermatt, Switzerland',
                'description' => 'Breathtaking mountain views, world-class skiing, and charming alpine villages. An unforgettable mountain experience.',
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                'price_from' => 1299.00,
                'rating' => 4.9,
                'category' => 'mountain',
                'featured' => true,
                'gallery' => [
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1551524164-6cf2ac531400?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1464822759844-d150baec4e84?w=800&h=600&fit=crop&crop=center'
                ],
                'amenities' => [
                    'Ski Equipment Rental',
                    'Mountain Guides',
                    'Cable Car Access',
                    'Alpine Spa',
                    'Hiking Trails',
                    'Traditional Cuisine'
                ],
                'duration' => '5 days / 4 nights'
            ],
            [
                'name' => 'Tokyo City Explorer',
                'location' => 'Tokyo, Japan',
                'description' => 'Immerse yourself in the vibrant culture of Japan\'s capital. From ancient temples to modern skyscrapers, experience it all.',
                'image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&h=600&fit=crop&crop=center',
                'price_from' => 1099.00,
                'rating' => 4.7,
                'category' => 'city',
                'featured' => true,
                'gallery' => [
                    'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1513407030348-c983a97b98d8?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1478436127897-769e1b3f0f36?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&h=600&fit=crop&crop=center'
                ],
                'amenities' => [
                    'City Tours',
                    'Cultural Experiences',
                    'Food Tours',
                    'Shopping Districts',
                    'Public Transport Pass',
                    'English Guide'
                ],
                'duration' => '6 days / 5 nights'
            ],
            [
                'name' => 'Amazon Rainforest Expedition',
                'location' => 'Manaus, Brazil',
                'description' => 'Explore the world\'s largest rainforest with expert guides. Wildlife spotting, river cruises, and indigenous culture.',
                'image' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&h=600&fit=crop&crop=center',
                'price_from' => 1599.00,
                'rating' => 4.6,
                'category' => 'adventure',
                'featured' => false,
                'gallery' => [
                    'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&h=600&fit=crop&crop=center'
                ],
                'amenities' => [
                    'Expert Naturalist Guides',
                    'River Boat Cruises',
                    'Wildlife Spotting',
                    'Indigenous Village Visits',
                    'Canopy Walks',
                    'All Meals Included'
                ],
                'duration' => '8 days / 7 nights'
            ],
            [
                'name' => 'Santorini Sunset Villa',
                'location' => 'Santorini, Greece',
                'description' => 'Romantic getaway with stunning sunsets, white-washed buildings, and crystal-clear waters. Perfect for couples.',
                'image' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=800&h=600&fit=crop&crop=center',
                'price_from' => 799.00,
                'rating' => 4.8,
                'category' => 'beach',
                'featured' => true,
                'gallery' => [
                    'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1613395877344-13d4a8e0d49e?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1613395877344-13d4a8e0d49e?w=800&h=600&fit=crop&crop=center'
                ],
                'amenities' => [
                    'Private Terrace',
                    'Wine Tasting Tours',
                    'Sunset Views',
                    'Beach Access',
                    'Romantic Dining',
                    'Spa Services'
                ],
                'duration' => '5 days / 4 nights'
            ],
            [
                'name' => 'Machu Picchu Trek',
                'location' => 'Cusco, Peru',
                'description' => 'Journey through ancient Inca trails to reach the magnificent Machu Picchu. A once-in-a-lifetime adventure.',
                'image' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?w=800&h=600&fit=crop&crop=center',
                'price_from' => 1199.00,
                'rating' => 4.9,
                'category' => 'adventure',
                'featured' => false,
                'gallery' => [
                    'https://images.unsplash.com/photo-1587595431973-160d0d94add1?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1526392060635-9d6019884377?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1583212292454-1fe6229603b7?w=800&h=600&fit=crop&crop=center'
                ],
                'amenities' => [
                    'Professional Guides',
                    'Camping Equipment',
                    'All Meals',
                    'Porter Service',
                    'Cultural Sites',
                    'Train Transportation'
                ],
                'duration' => '4 days / 3 nights'
            ],
            [
                'name' => 'Dubai Luxury Experience',
                'location' => 'Dubai, UAE',
                'description' => 'Experience luxury at its finest with world-class shopping, dining, and entertainment in this modern metropolis.',
                'image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800&h=600&fit=crop&crop=center',
                'price_from' => 1399.00,
                'rating' => 4.7,
                'category' => 'city',
                'featured' => false,
                'gallery' => [
                    'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1518684079-3c830dcef090?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1580674684081-7617fbf3d745?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1451337516015-6b6e9a44a8a3?w=800&h=600&fit=crop&crop=center'
                ],
                'amenities' => [
                    'Luxury Accommodations',
                    'Desert Safari',
                    'Shopping Tours',
                    'Fine Dining',
                    'Spa & Wellness',
                    'Private Transfers'
                ],
                'duration' => '4 days / 3 nights'
            ],
            [
                'name' => 'Iceland Northern Lights',
                'location' => 'Reykjavik, Iceland',
                'description' => 'Witness the magical Northern Lights while exploring glaciers, geysers, and volcanic landscapes.',
                'image' => 'https://images.unsplash.com/photo-1483347756197-71ef80e95f73?w=800&h=600&fit=crop&crop=center',
                'price_from' => 1499.00,
                'rating' => 4.8,
                'category' => 'adventure',
                'featured' => true,
                'gallery' => [
                    'https://images.unsplash.com/photo-1483347756197-71ef80e95f73?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1464822759844-d150baec4e84?w=800&h=600&fit=crop&crop=center',
                    'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&h=600&fit=crop&crop=center'
                ],
                'amenities' => [
                    'Northern Lights Tours',
                    'Glacier Hiking',
                    'Hot Springs Access',
                    'Photography Guides',
                    'Thermal Clothing',
                    'Local Cuisine'
                ],
                'duration' => '6 days / 5 nights'
            ]
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}
