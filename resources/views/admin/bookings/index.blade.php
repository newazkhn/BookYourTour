@extends('layouts.admin')

@section('page-title', 'Bookings')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-purple-600 rounded-xl shadow-sm p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Bookings</h1>
                <p class="mt-1 text-blue-100">Manage customer bookings and reservations</p>
            </div>
            <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2">
                    <span class="text-white text-sm font-medium">Total Revenue: </span>
                    <span class="text-yellow-300 text-lg font-bold">${{ number_format($bookings->sum(function($booking) { return ($booking->destination->price_from ?? 0) * $booking->people_count; }), 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-xs font-medium text-gray-600">Total Bookings</p>
                    <p class="text-xl font-bold text-gray-900">{{ $bookings->count() }}</p>
                    <p class="text-xs text-blue-600">All time</p>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-xs font-medium text-gray-600">Pending</p>
                    <p class="text-xl font-bold text-gray-900">{{ $bookings->where('status', 'pending')->count() }}</p>
                    <p class="text-xs text-yellow-600">Needs attention</p>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-xs font-medium text-gray-600">Approved</p>
                    <p class="text-xl font-bold text-gray-900">{{ $bookings->where('status', 'approved')->count() }}</p>
                    <p class="text-xs text-green-600">Approved</p>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-xs font-medium text-gray-600">Avg. Booking</p>
                    <p class="text-xl font-bold text-gray-900">${{ number_format($bookings->count() > 0 ? $bookings->sum(function($booking) { return ($booking->destination->price_from ?? 0) * $booking->people_count; }) / $bookings->count() : 0, 0) }}</p>
                    <p class="text-xs text-purple-600">Per reservation</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings List -->
    @if($bookings->count() > 0)
        <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Recent Bookings</h3>
                        <p class="text-sm text-gray-600 mt-1">Manage customer reservations and their status</p>
                    </div>
                </div>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($bookings as $booking)
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Customer Avatar -->
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">{{ substr($booking->name, 0, 1) }}</span>
                                </div>
                                
                                <!-- Booking Details -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900">{{ $booking->name }}</h4>
                                    <p class="text-xs text-gray-600">{{ $booking->email }}</p>
                                    <div class="flex items-center mt-1 space-x-3 text-xs text-gray-500">
                                        <span>{{ $booking->destination->name ?? 'N/A' }}</span>
                                        <span>•</span>
                                        <span>{{ $booking->people_count ?? 1 }} guests</span>
                                        @if($booking->destination && $booking->destination->duration)
                                            <span>•</span>
                                            <span>{{ $booking->destination->duration }}</span>
                                        @endif
                                        <span>•</span>
                                        <span>{{ $booking->travel_date ? $booking->travel_date->format('M d, Y') : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <!-- Amount -->
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900">${{ number_format(($booking->destination->price_from ?? 0) * $booking->people_count, 2) }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->created_at->diffForHumans() }}</p>
                                </div>
                                
                                <!-- Status -->
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($booking->status === 'approved') bg-green-100 text-green-800
                                        @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                    
                                    <!-- Actions -->
                                    @if($booking->status === 'pending')
                                        <div class="flex space-x-1">
                                            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="inline-flex items-center px-2 py-1 bg-green-50 border border-green-200 text-green-700 text-xs font-medium rounded hover:bg-green-100 transition-colors">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-50 border border-red-200 text-red-700 text-xs font-medium rounded hover:bg-red-100 transition-colors" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                    Cancel
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white shadow-sm rounded-xl border border-gray-200">
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No bookings yet</h3>
                <p class="text-gray-600 mb-6">Bookings will appear here when customers make reservations.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Manage Destinations
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection