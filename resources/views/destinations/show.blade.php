@extends('layouts.app')

@section('title', $destination->name . ' - BookYourTour')

@push('styles')
<style>
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --accent-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --glass-bg: rgba(255, 255, 255, 0.25);
    --glass-border: rgba(255, 255, 255, 0.18);
    --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.37);
    --shadow-hover: 0 15px 35px rgba(31, 38, 135, 0.4);
}

.destination-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.destination-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.glass-card {
    background: var(--glass-bg);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid var(--glass-border);
    box-shadow: var(--shadow-soft);
}

.booking-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 1rem;
    aspect-ratio: 4/3;
    cursor: pointer;
}

.feature-badge {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-primary {
    background: var(--primary-gradient);
    border: none;
}

.btn-book-now {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 25%, #ff9ff3 50%, #54a0ff 75%, #5f27cd 100%);
    border: none;
}

.floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
}

.floating-elements::before,
.floating-elements::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s ease-in-out infinite;
}

.floating-elements::before {
    width: 60px;
    height: 60px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-elements::after {
    width: 80px;
    height: 80px;
    top: 60%;
    right: 15%;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.content-section {
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.form-input {
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.form-input:focus {
    background: rgba(255, 255, 255, 1);
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Quill Content Styles - Modernized */
.quill-content {
    line-height: 1.8;
    color: #374151;
}

.quill-content h1, .quill-content h2, .quill-content h3 {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
}

.quill-content h1 { font-size: 2rem; margin: 1.5rem 0 1rem; }
.quill-content h2 { font-size: 1.5rem; margin: 1.25rem 0 0.75rem; }
.quill-content h3 { font-size: 1.25rem; margin: 1rem 0 0.5rem; }

.quill-content p { margin-bottom: 1rem; }
.quill-content strong { font-weight: 600; color: #1f2937; }
.quill-content a { color: #667eea; text-decoration: none; border-bottom: 1px solid #667eea; }

.quill-content ul, .quill-content ol {
    margin: 1rem 0;
    padding-left: 1.5rem;
}

.quill-content li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .quill-content h1 { font-size: 1.75rem; }
    .quill-content h2 { font-size: 1.375rem; }
    .quill-content h3 { font-size: 1.125rem; }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="relative mt-20">
    <div class="floating-elements"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-gray-800">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <div class="flex items-center justify-center space-x-2 text-sm opacity-90">
                    <a href="{{ route('home') }}">Home</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('destinations.index') }}">Destinations</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-800 font-medium">{{ $destination->name }}</span>
                </div>
            </nav>

            <!-- Main Title -->
            <h1 class="text-3xl text-gray-800 md:text-5xl font-bold mb-3 leading-tight">
                {{ $destination->name }}
            </h1>
            
            <!-- Location -->
            <div class="flex items-center justify-center text-lg mb-6 opacity-90">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $destination->location }}
            </div>

            <!-- Stats -->
            <div class="flex flex-wrap items-center justify-center gap-4 mb-8">
                @if($destination->rating)
                    <div class="px-4 py-2 rounded-full flex items-center bg-white shadow">
                        <svg class="w-4 h-4 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="font-semibold text-gray-800">{{ number_format($destination->rating, 1) }} Rating</span>
                    </div>
                @endif
                
                @if($destination->duration)
                    <div class="px-4 py-2 rounded-full flex items-center bg-white shadow">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold text-gray-800">{{ $destination->duration }}</span>
                    </div>
                @endif
                
                @if($destination->price_from)
                    <div class="px-4 py-2 rounded-full flex items-center bg-white shadow">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        <span class="font-semibold text-gray-800">From ${{ number_format($destination->price_from) }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Main Content -->
<div class="content-section py-12">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description -->
                <div class="rounded-3xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">About This Destination</h2>
                    </div>
                    <div class="prose prose-lg max-w-none">
                        <div class="quill-content text-lg leading-relaxed">{!! $destination->description !!}</div>
                    </div>
                </div>
                

                <!-- Features/Amenities -->
                @if($destination->amenities)
                    <div class="glass-card rounded-3xl p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900">What's Included</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @php
                                $amenities = is_array($destination->amenities) ? $destination->amenities : (json_decode($destination->amenities, true) ?? []);
                            @endphp
                            @foreach($amenities as $amenity)
                                <div class="flex items-center p-3 bg-white/50 rounded-xl backdrop-blur-sm">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-medium">{{ $amenity }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Gallery -->
                @if($destination->gallery)
                <div class="rounded-3xl p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Gallery</h2>
                    </div>
                
                    <div class="gallery-grid">
                        @php
                            $gallery = is_array($destination->gallery) ? $destination->gallery : (json_decode($destination->gallery, true) ?? []);
                        @endphp
                        @foreach($gallery as $image)
                            <div class="gallery-item">
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
                <div class="sticky top-24">
                    <div id="booking" class="booking-card rounded-3xl p-8">
                        <!-- Header -->
                        <div class="text-center mb-8">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Book Your Adventure</h3>
                            @if($destination->price_from)
                                <div class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    From ${{ number_format($destination->price_from) }}
                                    <span class="text-sm text-gray-500 font-normal block">per person</span>
                                </div>
                            @endif
                        </div>

                        @if(session('success'))
                            <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        @auth
                            <form action="{{ route('booking.store', $destination->id) }}" method="POST" class="space-y-6">
                                @csrf
                                
                                <!-- Name -->
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <input type="text" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', auth()->user()->name) }}" 
                                               required 
                                               class="form-input block w-full pl-12 pr-4 py-4 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none @error('name') border-red-300 @enderror"
                                               placeholder="Enter your full name">
                                    </div>
                                    @error('name')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                            </svg>
                                        </div>
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', auth()->user()->email) }}" 
                                               required 
                                               class="form-input block w-full pl-12 pr-4 py-4 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none @error('email') border-red-300 @enderror"
                                               placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- People Count -->
                                <div class="space-y-2">
                                    <label for="people_count" class="block text-sm font-semibold text-gray-700">Number of Travelers</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
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
                                               class="form-input block w-full pl-12 pr-4 py-4 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none @error('people_count') border-red-300 @enderror"
                                               placeholder="Number of people">
                                    </div>
                                    @error('people_count')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Travel Date -->
                                <div class="space-y-2">
                                    <label for="travel_date" class="block text-sm font-semibold text-gray-700">Preferred Travel Date</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
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
                                               class="form-input block w-full pl-12 pr-4 py-4 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none @error('travel_date') border-red-300 @enderror">
                                    </div>
                                    @error('travel_date')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" 
    class="w-full text-white font-bold py-4 px-6 rounded-2xl text-lg bg-gradient-to-r from-blue-500 to-indigo-600">
    <span class="flex items-center justify-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z"/>
        </svg>
        Book Now
    </span>
</button>

                            </form>
                        @else
                            <!-- Login Required -->
                            <div class="text-center py-8">
                                <div class="w-20 h-20 bg-gradient-to-r from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Login Required</h3>
                                <p class="text-gray-600 mb-8">Join us to book this amazing destination</p>
                                <div class="space-y-4">
                                    <a href="{{ route('login') }}" 
                                       class="w-full btn-primary text-white font-bold py-4 px-6 rounded-2xl text-lg inline-block">
                                        <span>Login to Book</span>
                                    </a>
                                    <a href="{{ route('register') }}" 
                                       class="w-full inline-flex items-center justify-center px-6 py-4 bg-white text-gray-700 font-semibold rounded-2xl border-2 border-gray-200">
                                        Create New Account
                                    </a>
                                </div>
                            </div>
                        @endauth

                        <!-- Trust Indicators -->
                        <div class="mt-8 pt-8 border-t border-gray-100">
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div class="space-y-2">
                                    <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs font-medium text-gray-700">Instant Confirmation</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs font-medium text-gray-700">Secure Payment</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs font-medium text-gray-700">24/7 Support</p>
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
// Smooth scroll to booking section
function scrollToBooking() {
    document.getElementById('booking').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Enhanced image gallery with modern modal
function openImageGallery(imageSrc, imageAlt) {
    if (!document.getElementById('imageModal')) {
        const modal = document.createElement('div');
        modal.id = 'imageModal';
        modal.className = 'fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 hidden';
        modal.innerHTML = `
            <div class="relative max-w-6xl max-h-[90vh] p-4 w-full">
                <button onclick="closeImageGallery()" class="absolute -top-12 right-0 text-white z-10 bg-white/10 backdrop-blur-sm rounded-full p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <div class="bg-white rounded-3xl overflow-hidden shadow-2xl">
                    <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[80vh] object-contain">
                </div>
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
    if (modal) {
        modal.classList.add('hidden');
    }
}

// Enhanced form validation with better UX
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action*="booking"]');
    if (form) {
        // Real-time validation
        const inputs = form.querySelectorAll('input[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', validateField);
            input.addEventListener('input', clearError);
        });
        
        form.addEventListener('submit', function(e) {
            const travelDate = document.getElementById('travel_date');
            const peopleCount = document.getElementById('people_count');
            let isValid = true;
            
            if (travelDate && new Date(travelDate.value) < new Date()) {
                e.preventDefault();
                showFieldError(travelDate, 'Please select a future date for your travel.');
                isValid = false;
            }
            
            if (peopleCount && (peopleCount.value < 1 || peopleCount.value > 20)) {
                e.preventDefault();
                showFieldError(peopleCount, 'Number of travelers must be between 1 and 20.');
                isValid = false;
            }
            
            if (!isValid) {
                // Scroll to first error
                const firstError = form.querySelector('.border-red-300');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    }
    

});

function validateField(e) {
    const field = e.target;
    if (!field.value.trim() && field.required) {
        showFieldError(field, `${field.labels[0]?.textContent || 'This field'} is required.`);
    }
}

function clearError(e) {
    const field = e.target;
    field.classList.remove('border-red-300');
    const errorMsg = field.parentNode.parentNode.querySelector('.text-red-600');
    if (errorMsg) errorMsg.remove();
}

function showFieldError(field, message) {
    field.classList.add('border-red-300');
    clearError({ target: field });
    
    const errorDiv = document.createElement('p');
    errorDiv.className = 'text-sm text-red-600 mt-1';
    errorDiv.textContent = message;
    field.parentNode.parentNode.appendChild(errorDiv);
}

// Add loading state to booking button
const bookingForm = document.querySelector('form[action*="booking"]');
if (bookingForm) {
    bookingForm.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;
        
        // Reset after 10 seconds if no response
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 10000);
    });
}
</script>
@endpush
@endsection
