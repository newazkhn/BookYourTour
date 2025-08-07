@extends('layouts.app')

@section('title', 'Discover Amazing Destinations - Your Travel Adventure Starts Here')

@push('scripts')
@vite(['resources/js/home-interactive.js'])
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Loading Overlay -->
    <div id="page-loading" class="fixed inset-0 bg-white z-50 flex items-center justify-center transition-opacity duration-500">
        <div class="text-center">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Loading amazing destinations...</p>
        </div>
    </div>

    <!-- Hero Section -->
    <div id="hero" class="relative">
        @include('components.hero-section')
    </div>

    <!-- Main Content Container -->
    <main class="relative z-10">
        <!-- Featured Destinations Section -->
        <div id="featured" class="scroll-mt-20">
            @if($featuredDestinations->count() > 0)
                @include('components.featured-destinations', ['destinations' => $featuredDestinations])
            @else
                <!-- Featured Destinations Loading/Error State -->
                <section class="py-16 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Destinations</h2>
                            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Discover our handpicked selection of extraordinary destinations</p>
                        </div>
                        
                        <!-- Skeleton Loading Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="featured-skeleton">
                            @for($i = 0; $i < 6; $i++)
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-pulse">
                                    <div class="h-64 bg-gray-300"></div>
                                    <div class="p-6">
                                        <div class="h-4 bg-gray-300 rounded mb-2"></div>
                                        <div class="h-3 bg-gray-300 rounded w-3/4 mb-4"></div>
                                        <div class="h-3 bg-gray-300 rounded mb-4"></div>
                                        <div class="flex justify-between items-center">
                                            <div class="h-6 bg-gray-300 rounded w-20"></div>
                                            <div class="h-8 bg-gray-300 rounded w-24"></div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </section>
            @endif
        </div>



        <!-- Popular Destinations Section -->
        @if($popularDestinations->count() > 0)
            <section class="py-20 bg-white" id="popular">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            Popular Destinations
                        </h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Explore the most loved destinations by our travelers worldwide
                        </p>
                    </div>

                    <!-- Popular Destinations Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($popularDestinations as $destination)
                            <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                                <!-- Image Container -->
                                <div class="relative h-48 overflow-hidden">
                                    @if($destination->image)
                                        <img src="{{ asset('storage/' . $destination->image) }}" 
                                             alt="{{ $destination->name }}" 
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                             loading="lazy"
                                             onerror="this.src='https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop&crop=center'">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <span class="text-white text-4xl">🏞️</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Rating Badge -->
                                    @if($destination->rating)
                                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full px-2 py-1 flex items-center">
                                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-800">{{ number_format($destination->rating, 1) }}</span>
                                        </div>
                                    @endif


                                </div>

                                <!-- Card Content -->
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-1 text-gray-900 group-hover:text-blue-600 transition-colors duration-200 line-clamp-1">
                                        {{ $destination->name }}
                                    </h3>
                                    
                                    <div class="flex items-center text-gray-600 mb-2">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="text-sm line-clamp-1">{{ $destination->location }}</span>
                                    </div>

                                    <!-- Price and Duration -->
                                    <div class="flex justify-between items-center mt-3">
                                        @if($destination->price_from)
                                            <div class="text-blue-600 font-bold">
                                                <span class="text-sm text-gray-500">From</span>
                                                <span class="text-lg">${{ number_format($destination->price_from) }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($destination->duration)
                                            <div class="text-gray-500 text-sm flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $destination->duration }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Action Button -->
                                    <div class="mt-4">
                                        <a href="{{ route('destinations.show', $destination) }}" 
                                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- View All Popular Link -->
                    <div class="text-center mt-12">
                        <a href="{{ route('destinations.index') }}?sort=rating" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            View All Popular Destinations
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- Testimonials Section -->
        <div id="testimonials" class="scroll-mt-20">
            @include('components.testimonials')
        </div>

        <!-- Fallback Content Section -->
        @if($featuredDestinations->count() == 0 && $popularDestinations->count() == 0 && $recentDestinations->count() > 0)
            <section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-100" id="recent">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            Latest Destinations
                        </h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Discover our newest additions to the collection of amazing travel experiences
                        </p>
                    </div>

                    <!-- Recent Destinations Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($recentDestinations as $destination)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                <!-- Image Container -->
                                <div class="relative h-56 overflow-hidden">
                                    @if($destination->image)
                                        <img src="{{ asset('storage/' . $destination->image) }}" 
                                             alt="{{ $destination->name }}" 
                                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                             loading="lazy"
                                             onerror="this.src='https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=400&h=300&fit=crop&crop=center'">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <span class="text-white text-5xl">🏞️</span>
                                        </div>
                                    @endif
                                    
                                    <!-- New Badge -->
                                    <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        NEW
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2 text-gray-900 hover:text-blue-600 transition-colors duration-200">
                                        {{ $destination->name }}
                                    </h3>
                                    
                                    <div class="flex items-center text-gray-600 mb-3">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $destination->location }}
                                    </div>
                                    
                                    <p class="text-gray-700 mb-6 line-clamp-3">
                                        {{ $destination->description }}
                                    </p>
                                    
                                    <div class="flex justify-between items-center">
                                        @if($destination->price_from)
                                            <div class="text-blue-600 font-bold text-lg">
                                                From ${{ number_format($destination->price_from) }}
                                            </div>
                                        @endif
                                        
                                        <a href="{{ route('destinations.show', $destination) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Empty State Section -->
        @if($featuredDestinations->count() == 0 && $popularDestinations->count() == 0 && $recentDestinations->count() == 0)
            <section class="py-20 bg-white" id="empty-state">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <!-- Empty State Illustration -->
                    <div class="mb-8">
                        <svg class="w-32 h-32 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>

                    <!-- Empty State Content -->
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        No Destinations Available Yet
                    </h2>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                        We're working hard to bring you amazing travel destinations. Check back soon for incredible adventures and unforgettable experiences!
                    </p>

                    <!-- Call to Action -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('destinations.index') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Refresh Page
                        </a>
                        
                        <button onclick="subscribeToUpdates()" 
                                class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM4 15h8v-2H4v2zM4 11h10V9H4v2z"/>
                            </svg>
                            Get Notified
                        </button>
                    </div>

                    <!-- Additional Information -->
                    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Amazing Destinations</h3>
                            <p class="text-gray-600">Curated travel experiences from around the world</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Best Prices</h3>
                            <p class="text-gray-600">Competitive pricing with no hidden fees</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">24/7 Support</h3>
                            <p class="text-gray-600">Round-the-clock customer assistance</p>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>

    <!-- Back to Top Button -->
    <button id="backToTop" 
            onclick="scrollToTop()" 
            class="fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg opacity-0 pointer-events-none transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 z-40">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
</div>

<!-- Error Handling and Loading States -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide loading overlay after page loads
    setTimeout(function() {
        const loadingOverlay = document.getElementById('page-loading');
        if (loadingOverlay) {
            loadingOverlay.style.opacity = '0';
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
            }, 500);
        }
    }, 1000);

    // Handle image loading errors
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            if (!this.dataset.fallbackApplied) {
                this.src = 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=400&h=300&fit=crop&crop=center';
                this.dataset.fallbackApplied = 'true';
            }
        });
    });

    // Lazy loading for better performance
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        observer.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Handle skeleton loading replacement
    setTimeout(() => {
        const skeleton = document.getElementById('featured-skeleton');
        if (skeleton && skeleton.children.length > 0) {
            // If we still have skeleton after 3 seconds, show error state
            skeleton.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <div class="max-w-md mx-auto">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Unable to Load Destinations</h3>
                        <p class="text-gray-500 mb-4">There was an issue loading the featured destinations.</p>
                        <button onclick="window.location.reload()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Try Again
                        </button>
                    </div>
                </div>
            `;
        }
    }, 3000);
});

// Subscribe to updates function for empty state
function subscribeToUpdates() {
    // This would typically open a modal or redirect to a subscription form
    alert('Thank you for your interest! We\'ll notify you when new destinations are available.');
}

// Utility classes for line clamping
const style = document.createElement('style');
style.textContent = `
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
`;
document.head.appendChild(style);
</script>
@endsection