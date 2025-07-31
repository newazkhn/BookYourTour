<!-- Testimonials Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                What Our Travelers Say
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Don't just take our word for it. Here's what our happy customers have to say about their amazing travel experiences.
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $testimonials = [
                    [
                        'name' => 'Sarah Johnson',
                        'location' => 'New York, USA',
                        'rating' => 5,
                        'review' => 'Absolutely incredible experience! The destination was breathtaking and the service was top-notch. Every detail was perfectly planned and executed.',
                        'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b9e0e4d4?w=150&h=150&fit=crop&crop=face',
                        'destination' => 'Bali, Indonesia'
                    ],
                    [
                        'name' => 'Michael Chen',
                        'location' => 'Toronto, Canada',
                        'rating' => 5,
                        'review' => 'This was the trip of a lifetime! The accommodations were luxurious and the local guides were incredibly knowledgeable. Highly recommend!',
                        'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
                        'destination' => 'Tokyo, Japan'
                    ],
                    [
                        'name' => 'Emma Rodriguez',
                        'location' => 'Madrid, Spain',
                        'rating' => 4,
                        'review' => 'Amazing adventure with stunning views and great company. The itinerary was well-balanced between adventure and relaxation.',
                        'photo' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
                        'destination' => 'Swiss Alps'
                    ],
                    [
                        'name' => 'David Thompson',
                        'location' => 'London, UK',
                        'rating' => 5,
                        'review' => 'Exceptional service from start to finish. The booking process was smooth and the destination exceeded all expectations. Will definitely book again!',
                        'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',
                        'destination' => 'Santorini, Greece'
                    ],
                    [
                        'name' => 'Lisa Park',
                        'location' => 'Seoul, South Korea',
                        'rating' => 5,
                        'review' => 'Perfect family vacation! The kids loved every moment and we created memories that will last a lifetime. Great value for money.',
                        'photo' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&h=150&fit=crop&crop=face',
                        'destination' => 'Orlando, Florida'
                    ],
                    [
                        'name' => 'James Wilson',
                        'location' => 'Sydney, Australia',
                        'rating' => 4,
                        'review' => 'Fantastic cultural experience with authentic local interactions. The food tours were incredible and the historical sites were fascinating.',
                        'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face',
                        'destination' => 'Rome, Italy'
                    ]
                ];
            @endphp

            @foreach($testimonials as $testimonial)
                <div class="testimonial-card bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 stagger-animation hover-lift">
                    <!-- Customer Info -->
                    <div class="flex items-center mb-4">
                        <img 
                            src="{{ $testimonial['photo'] }}" 
                            alt="{{ $testimonial['name'] }}"
                            class="w-12 h-12 rounded-full object-cover mr-4"
                            loading="lazy"
                        >
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $testimonial['name'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $testimonial['location'] }}</p>
                        </div>
                    </div>

                    <!-- Star Rating -->
                    <div class="flex items-center mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial['rating'])
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-gray-600">({{ $testimonial['rating'] }}/5)</span>
                    </div>

                    <!-- Review Text -->
                    <blockquote class="text-gray-700 mb-4 italic">
                        "{{ $testimonial['review'] }}"
                    </blockquote>

                    <!-- Destination -->
                    <div class="text-sm text-blue-600 font-medium">
                        Traveled to: {{ $testimonial['destination'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Trust Indicators -->
        <div class="mt-16 text-center">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">10,000+</div>
                    <div class="text-sm text-gray-600 mt-1">Happy Travelers</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">500+</div>
                    <div class="text-sm text-gray-600 mt-1">Destinations</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">4.8</div>
                    <div class="text-sm text-gray-600 mt-1">Average Rating</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">24/7</div>
                    <div class="text-sm text-gray-600 mt-1">Customer Support</div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-12 text-center">
            <p class="text-lg text-gray-600 mb-6">
                Ready to create your own amazing travel story?
            </p>
            <a href="{{ route('destinations.index') }}" 
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                Start Your Journey
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </div>
</section>