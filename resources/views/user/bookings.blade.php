@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-purple-700 text-white">
        <div class="container mx-auto px-4 py-16">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    My Bookings
                </h1>
                <p class="text-xl text-blue-100 mb-6">
                    Track your travel adventures and booking status
                </p>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">{{ $bookings->count() }}</div>
                        <div class="text-blue-100">Total Bookings</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">{{ $bookings->where('status', 'approved')->count() }}</div>
                        <div class="text-blue-100">Approved</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">{{ $bookings->where('status', 'pending')->count() }}</div>
                        <div class="text-blue-100">Pending</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        @if($bookings->count() > 0)
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="md:flex">
                            <!-- Destination Image -->
                            <div class="md:w-1/3">
                                <div class="h-48 md:h-full relative overflow-hidden">
                                    @if($booking->destination && $booking->destination->image)
                                        <img src="{{ asset('storage/' . $booking->destination->image) }}" 
                                             alt="{{ $booking->destination->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Status Badge -->
                                    <div class="absolute top-4 right-4">
                                        @if($booking->status === 'approved')
                                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                ✓ Approved
                                            </span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                ✗ Cancelled
                                            </span>
                                        @else
                                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                ⏳ Pending
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Booking Details -->
                            <div class="md:w-2/3 p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                            {{ $booking->destination ? $booking->destination->name : 'Destination Not Found' }}
                                        </h3>
                                        @if($booking->destination)
                                            <div class="flex items-center text-gray-600 mb-2">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                <span>{{ $booking->destination->location }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500">Booking ID</p>
                                        <p class="font-mono text-sm text-gray-800">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                                
                                <!-- Booking Info Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <span class="font-medium text-gray-700">Traveler</span>
                                        </div>
                                        <p class="text-gray-900">{{ $booking->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $booking->email }}</p>
                                    </div>
                                    
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z"/>
                                            </svg>
                                            <span class="font-medium text-gray-700">Travel Date</span>
                                        </div>
                                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($booking->travel_date)->format('F j, Y') }}</p>
                                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($booking->travel_date)->diffForHumans() }}</p>
                                    </div>
                                    
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                            </svg>
                                            <span class="font-medium text-gray-700">Group Size</span>
                                        </div>
                                        <p class="text-gray-900">{{ $booking->people_count }} {{ Str::plural('person', $booking->people_count) }}</p>
                                    </div>
                                    
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="font-medium text-gray-700">Booked On</span>
                                        </div>
                                        <p class="text-gray-900">{{ $booking->created_at->format('F j, Y') }}</p>
                                        <p class="text-sm text-gray-600">{{ $booking->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                
                                <!-- Actions -->
                                <div class="flex flex-col sm:flex-row gap-3">
                                    @if($booking->destination)
                                        <a href="{{ route('destinations.show', $booking->destination) }}" 
                                           class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            View Destination
                                        </a>
                                    @endif
                                    
                                    @if($booking->status === 'pending')
                                        <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Cancel Booking
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-lg mx-auto">
                    <div class="mb-8">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">No Bookings Yet</h3>
                    <p class="text-lg text-gray-600 mb-8">
                        Start your travel adventure by booking your first destination!
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('destinations.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Browse Destinations
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
@endsection