@extends('layouts.app')

@section('title', $destination->name . ' - BookYourTour')

@push('styles')
<style>
:root {
    --nav-height: 80px;
    --breadcrumb-spacing: 120px;
    --content-spacing: 100px;
}

.destination-page {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%);
}

.booking-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid rgba(59, 130, 246, 0.1);
}

.gallery-item:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.form-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Ensure proper spacing for fixed navigation */
.destination-page {
    scroll-margin-top: 120px;
}

/* Additional spacing for content below fixed navigation */
.breadcrumb-section {
    padding-top: 120px !important;
    margin-top: 0 !important;
}

.main-content-section {
    margin-top: 100px !important;
}

/* Force spacing for navigation overlap issues */
.force-nav-spacing {
    padding-top: var(--breadcrumb-spacing) !important;
    margin-top: 0 !important;
}

.force-content-spacing {
    margin-top: var(--content-spacing) !important;
}

@media (max-width: 768px) {
    .destination-page {
        scroll-margin-top: 100px;
    }
    
    .breadcrumb-section, .force-nav-spacing {
        padding-top: 100px !important;
    }
    
    .main-content-section, .force-content-spacing {
        margin-top: 80px !important;
    }
}

/* Quill Content Styles */
.quill-content h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    margin-top: 1.5rem;
    color: #1f2937;
    line-height: 1.2;
}

.quill-content h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    margin-top: 1.25rem;
    color: #374151;
    line-height: 1.3;
}

.quill-content h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    margin-top: 1rem;
    color: #4b5563;
    line-height: 1.4;
}

.quill-content p {
    margin-bottom: 1rem;
    line-height: 1.7;
}

.quill-content strong {
    font-weight: 600;
    color: #1f2937;
}

.quill-content em {
    font-style: italic;
}

.quill-content u {
    text-decoration: underline;
}

.quill-content s {
    text-decoration: line-through;
}

.quill-content ol {
    list-style-type: decimal;
    margin-left: 1.5rem;
    margin-bottom: 1rem;
    padding-left: 0.5rem;
}

.quill-content ul {
    list-style-type: disc;
    margin-left: 1.5rem;
    margin-bottom: 1rem;
    padding-left: 0.5rem;
}

.quill-content li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.quill-content ol li {
    list-style-type: decimal;
}

.quill-content ul li {
    list-style-type: disc;
}

.quill-content a {
    color: #3b82f6;
    text-decoration: underline;
    transition: color 0.2s;
}

.quill-content a:hover {
    color: #1d4ed8;
}

.quill-content .ql-align-center {
    text-align: center;
}

.quill-content .ql-align-right {
    text-align: right;
}

.quill-content .ql-align-justify {
    text-align: justify;
}

.quill-content .ql-indent-1 {
    padding-left: 3rem;
}

.quill-content .ql-indent-2 {
    padding-left: 6rem;
}

.quill-content .ql-indent-3 {
    padding-left: 9rem;
}

.quill-content .ql-indent-4 {
    padding-left: 12rem;
}

.quill-content .ql-indent-5 {
    padding-left: 15rem;
}

.quill-content .ql-indent-6 {
    padding-left: 18rem;
}

.quill-content .ql-indent-7 {
    padding-left: 21rem;
}

.quill-content .ql-indent-8 {
    padding-left: 24rem;
}

/* Color classes that Quill might generate */
.quill-content .ql-color-red {
    color: #ef4444;
}

.quill-content .ql-color-orange {
    color: #f97316;
}

.quill-content .ql-color-yellow {
    color: #eab308;
}

.quill-content .ql-color-green {
    color: #22c55e;
}

.quill-content .ql-color-blue {
    color: #3b82f6;
}

.quill-content .ql-color-purple {
    color: #a855f7;
}

.quill-content .ql-bg-red {
    background-color: #fef2f2;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
}

.quill-content .ql-bg-orange {
    background-color: #fff7ed;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
}

.quill-content .ql-bg-yellow {
    background-color: #fefce8;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
}

.quill-content .ql-bg-green {
    background-color: #f0fdf4;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
}

.quill-content .ql-bg-blue {
    background-color: #eff6ff;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
}

.quill-content .ql-bg-purple {
    background-color: #faf5ff;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .quill-content h1 {
        font-size: 1.75rem;
    }
    
    .quill-content h2 {
        font-size: 1.375rem;
    }
    
    .quill-content h3 {
        font-size: 1.125rem;
    }
    
    .quill-content .ql-indent-1 {
        padding-left: 1.5rem;
    }
    
    .quill-content .ql-indent-2 {
        padding-left: 3rem;
    }
    
    .quill-content .ql-indent-3 {
        padding-left: 4.5rem;
    }
    
    .quill-content .ql-indent-4,
    .quill-content .ql-indent-5,
    .quill-content .ql-indent-6,
    .quill-content .ql-indent-7,
    .quill-content .ql-indent-8 {
        padding-left: 6rem;
    }
}
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 destination-page">

    <!-- Main Content -->
    <div id="content" class="container mx-auto px-4 py-8 md:py-12 force-content-spacing" style="margin-top: 100px;">
        <!-- Destination Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    @if($destination->category)
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-2">
                            {{ ucfirst($destination->category) }}
                        </span>
                    @endif
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                        {{ $destination->name }}
                    </h1>
                    <div class="flex items-center text-gray-600 text-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $destination->location }}
                    </div>
                </div>
                
                <!-- Quick Info -->
                <div class="flex flex-wrap gap-4 text-sm">
                    @if($destination->rating)
                        <div class="flex items-center bg-yellow-50 px-3 py-2 rounded-lg">
                            <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="font-medium text-gray-900">{{ number_format($destination->rating, 1) }}</span>
                        </div>
                    @endif
                    
                    @if($destination->duration)
                        <div class="flex items-center bg-blue-50 px-3 py-2 rounded-lg">
                            <svg class="w-4 h-4 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-gray-900">{{ $destination->duration }}</span>
                        </div>
                    @endif
                    
                    @if($destination->price_from)
                        <div class="flex items-center bg-green-50 px-3 py-2 rounded-lg">
                            <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            <span class="text-gray-900">From ${{ number_format($destination->price_from) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6 md:space-y-8">
                <!-- Description -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 md:mb-6">About This Destination</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        <div class="quill-content text-base md:text-lg leading-relaxed">{!! $destination->description !!}</div>
                    </div>
                </div>

                <!-- Features/Amenities -->
                @if($destination->amenities)
                    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 md:mb-6">What's Included</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @php
                                $amenities = is_array($destination->amenities) ? $destination->amenities : (json_decode($destination->amenities, true) ?? []);
                            @endphp
                            @foreach($amenities as $amenity)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-700">{{ $amenity }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Gallery -->
                @if($destination->gallery)
                    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 md:mb-6">Gallery</h2>
                        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                            @php
                                $gallery = is_array($destination->gallery) ? $destination->gallery : (json_decode($destination->gallery, true) ?? []);
                            @endphp
                            @foreach($gallery as $image)
                                <div class="relative h-32 md:h-48 rounded-lg overflow-hidden cursor-pointer gallery-item transition-all duration-300">
                                    <img src="{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}" 
                                         alt="Gallery image" 
                                         class="w-full h-full object-cover"
                                         onerror="this.src='https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=400&h=300&fit=crop&crop=center'"
                                         onclick="openImageGallery('{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}', 'Gallery Image')">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Booking Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-32 md:top-36">
                    <div id="booking" class="booking-card rounded-2xl shadow-2xl p-6 md:p-8">
                        <div class="text-center mb-4 md:mb-6">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Book Your Adventure</h3>
                            @if($destination->price_from)
                                <div class="text-2xl md:text-3xl font-bold text-blue-600">
                                    From ${{ number_format($destination->price_from) }}
                                    <span class="text-sm text-gray-500 font-normal">per person</span>
                                </div>
                            @endif
                        </div>

                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        @auth
                            <form action="{{ route('booking.store', $destination->id) }}" method="POST" class="space-y-6">
                                @csrf
                                
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <input type="text" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', auth()->user()->name) }}" 
                                               required 
                                               class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror"
                                               placeholder="Enter your full name">
                                    </div>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                            </svg>
                                        </div>
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', auth()->user()->email) }}" 
                                               required 
                                               class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 @enderror"
                                               placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- People Count -->
                                <div>
                                    <label for="people_count" class="block text-sm font-medium text-gray-700 mb-2">Number of Travelers</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                            </svg>
                                        </div>
                                        <input type="number" 
                                               id="people_count" 
                                               name="people_count" 
                                               value="{{ old('people_count', 1) }}" 
                                               min="1" 
                                               max="20"
                                               required 
                                               class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('people_count') border-red-300 @enderror"
                                               placeholder="Number of people">
                                    </div>
                                    @error('people_count')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Travel Date -->
                                <div>
                                    <label for="travel_date" class="block text-sm font-medium text-gray-700 mb-2">Preferred Travel Date</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z"/>
                                            </svg>
                                        </div>
                                        <input type="date" 
                                               id="travel_date" 
                                               name="travel_date" 
                                               value="{{ old('travel_date') }}" 
                                               min="{{ date('Y-m-d') }}"
                                               required 
                                               class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('travel_date') border-red-300 @enderror">
                                    </div>
                                    @error('travel_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z"/>
                                    </svg>
                                    Book Now
                                </button>
                            </form>
                        @else
                            <!-- Login Required -->
                            <div class="text-center py-8">
                                <div class="mb-4">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Login Required</h3>
                                <p class="text-gray-600 mb-6">Please login to book this destination</p>
                                <div class="space-y-3">
                                    <a href="{{ route('login') }}" 
                                       class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        Login
                                    </a>
                                    <a href="{{ route('register') }}" 
                                       class="w-full inline-flex items-center justify-center px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-lg border border-gray-300 transition-all duration-200 transform hover:scale-105">
                                        Create Account
                                    </a>
                                </div>
                            </div>
                        @endauth

                       
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex justify-center space-x-8 text-center">
                              <div>
                                <svg class="w-8 h-8 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-xs text-gray-600">Instant Confirmation</p>
                              </div>
                              <div>
                                <svg class="w-8 h-8 text-blue-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <p class="text-xs text-gray-600">Secure Payment</p>
                              </div>
                              <div>
                                <svg class="w-8 h-8 text-purple-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z"/>
                                </svg>
                                <p class="text-xs text-gray-600">24/7 Support</p>
                              </div>
                            </div>
                          </div>
                          
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@vite(['resources/js/home-interactive.js'])
<script>
// Removed scroll to content function since hero section is removed

// Image gallery functionality
function openImageGallery(imageSrc, imageAlt) {
    // Create modal if it doesn't exist
    if (!document.getElementById('imageModal')) {
        const modal = document.createElement('div');
        modal.id = 'imageModal';
        modal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden';
        modal.innerHTML = `
            <div class="relative max-w-4xl max-h-full p-4">
                <button onclick="closeImageGallery()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            </div>
        `;
        document.body.appendChild(modal);
        
        // Close on click outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeImageGallery();
        });
        
        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeImageGallery();
        });
    }
    
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageSrc;
    modalImage.alt = imageAlt;
    modal.classList.remove('hidden');
}

function closeImageGallery() {
    const modal = document.getElementById('imageModal');
    if (modal) modal.classList.add('hidden');
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action*="booking"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            const travelDate = document.getElementById('travel_date');
            const peopleCount = document.getElementById('people_count');
            
            if (travelDate && new Date(travelDate.value) < new Date()) {
                e.preventDefault();
                alert('Please select a future date for your travel.');
                travelDate.focus();
                return false;
            }
            
            if (peopleCount && (peopleCount.value < 1 || peopleCount.value > 20)) {
                e.preventDefault();
                alert('Number of travelers must be between 1 and 20.');
                peopleCount.focus();
                return false;
            }
        });
    }
});
</script>
@endpush
@endsection
