@extends('layouts.app')

@section('title', 'Destinations - Discover Amazing Places')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-purple-700 text-white">
        <div class="container mx-auto px-4 py-28">
            <div class="text-center max-w-4xl mx-auto">
                @if(!empty($searchQuery) || !empty($selectedCategory))
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Search Results
                    </h1>
                    @if(isset($totalResults))
                        <p class="text-xl text-blue-100 mb-6">
                            {{ $totalResults }} {{ Str::plural('destination', $totalResults) }} found
                        </p>
                    @endif
                    
                    <div class="flex flex-wrap justify-center gap-3 mb-6">
                        @if(!empty($searchQuery))
                            <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                "{{ $searchQuery }}"
                            </span>
                        @endif
                        @if(!empty($selectedCategory))
                            <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                {{ ucfirst($selectedCategory) }}
                            </span>
                        @endif
                    </div>
                    
                    <a href="{{ route('destinations.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-medium rounded-lg transition-all duration-200 border border-white/30">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Clear Filters
                    </a>
                @else
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Explore Amazing
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">
                            Destinations
                        </span>
                    </h1>
                    <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                        Discover breathtaking places around the world and create unforgettable memories
                    </p>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-2xl mx-auto">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-400">{{ $destinations->total() ?? 0 }}+</div>
                            <div class="text-blue-100">Destinations</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-400">50+</div>
                            <div class="text-blue-100">Countries</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-400">10k+</div>
                            <div class="text-blue-100">Happy Travelers</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">

        <!-- Results Grid -->
        @if($destinations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                @foreach($destinations as $index => $destination)
                    <div class="destination-card bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl group stagger-animation" style="animation-delay: {{ $index * 0.1 }}s">
                        <!-- Destination Image -->
                        <div class="relative h-56 overflow-hidden">
                            @if($destination->image)
                                <img data-src="{{ asset('storage/' . $destination->image) }}" 
                                     src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMjAiIGZpbGw9IiNmM2Y0ZjYiLz4KPHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEwIDEwTDEwIDEwWiIgc3Ryb2tlPSIjOWNhM2FmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8L3N2Zz4KPC9zdmc+"
                                     alt="{{ $destination->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 loading-placeholder"
                                     onerror="this.src='https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'">
                            @else
                                <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                     alt="Default destination image" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @endif
                            
                            <!-- Price Badge -->
                            @if(isset($destination->price_from) && $destination->price_from > 0)
                                <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full shadow-lg">
                                    <span class="text-sm font-bold text-gray-900">From ${{ number_format($destination->price_from) }}</span>
                                </div>
                            @endif
                            
                            <!-- Category Badge -->
                            @if(isset($destination->category))
                                <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-blue-700 px-3 py-1 rounded-full shadow-lg">
                                    <span class="text-xs font-medium text-white">{{ ucfirst($destination->category) }}</span>
                                </div>
                            @endif

                            <!-- Rating Badge -->
                            @if(isset($destination->rating) && $destination->rating > 0)
                                <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-sm px-2 py-1 rounded-full shadow-lg flex items-center">
                                    <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-800">{{ number_format($destination->rating, 1) }}</span>
                                </div>
                            @endif

                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Destination Info -->
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $destination->name }}
                            </h2>
                            
                            <div class="flex items-center text-gray-600 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm">{{ $destination->location }}</span>
                            </div>
                            
                            <p class="text-gray-700 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($destination->description, 120) }}
                            </p>
                            
                            <!-- Duration -->
                            @if(isset($destination->duration))
                                <div class="flex items-center text-gray-500 text-sm mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $destination->duration }}</span>
                                </div>
                            @endif
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('destinations.show', $destination->id) }}" 
                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View Details
                                </a>
                                
                                <button onclick="openDestinationPreview('{{ $destination->id }}', '{{ $destination->name }}')"
                                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200"
                                        title="Quick Preview">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            @if($destinations->hasPages())
                <div class="flex justify-center">
                    <div class="bg-white rounded-2xl shadow-lg p-4">
                        {{ $destinations->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        @else
            <!-- Enhanced No Results -->
            <div class="text-center py-16">
                <div class="max-w-lg mx-auto">
                    <!-- Animated Icon -->
                    <div class="mb-8">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">No Destinations Found</h3>
                    
                    @if(!empty($searchQuery))
                        <p class="text-lg text-gray-600 mb-8">
                            We couldn't find any destinations matching "<strong class="text-blue-600">{{ $searchQuery }}</strong>".
                        </p>
                    @else
                        <p class="text-lg text-gray-600 mb-8">
                            No destinations are currently available in this category.
                        </p>
                    @endif
                    
                    <!-- Enhanced Suggestions -->
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Popular Searches</h4>
                        <div class="flex flex-wrap gap-3 justify-center">
                            @foreach(['Beach', 'Mountain', 'City', 'Adventure', 'Cultural'] as $suggestion)
                                <a href="{{ route('destinations.index', ['search' => $suggestion]) }}" 
                                   class="px-4 py-2 bg-white hover:bg-blue-50 text-blue-700 rounded-full text-sm font-medium shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                    {{ $suggestion }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('destinations.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            View All Destinations
                        </a>
                        
                        <a href="{{ url('/') }}" 
                           class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-lg border border-gray-300 transition-all duration-200 transform hover:scale-105 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
@vite(['resources/js/home-interactive.js'])
@endpush

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .stagger-animation {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.6s ease-out forwards;
    }
    
    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .destination-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .destination-card:hover {
        transform: translateY(-12px) scale(1.03);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }
    
    .loading-placeholder {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
</style>
@endsection
