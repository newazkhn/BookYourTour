@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8">
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

     <!-- Quick Actions -->
     <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.destinations.create') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-900">Add Destination</h4>
                    <p class="text-xs text-gray-500">Create new travel package</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.bookings.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-900">Manage Bookings</h4>
                    <p class="text-xs text-gray-500">Review reservations</p>
                </div>
            </div>
        </a>

        <a href="{{ route('home') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-900">View Website</h4>
                    <p class="text-xs text-gray-500">See public site</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Revenue Overview Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Total Revenue</h2>
                <p class="text-sm text-gray-500">All time earnings from confirmed bookings</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
            </div>
        </div>
        
        <div class="flex items-baseline space-x-2 mb-4">
            <span class="text-4xl font-bold text-gray-900">${{ number_format($dashboardData['revenue']['total'] ?? 0, 2) }}</span>
            @if(($dashboardData['revenue']['growth'] ?? 0) != 0)
                <div class="flex items-center space-x-1 ml-4">
                    <svg class="w-4 h-4 {{ ($dashboardData['revenue']['growth'] ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }}" fill="currentColor" viewBox="0 0 20 20">
                        @if(($dashboardData['revenue']['growth'] ?? 0) >= 0)
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        @else
                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        @endif
                    </svg>
                    <span class="text-sm font-medium {{ ($dashboardData['revenue']['growth'] ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ ($dashboardData['revenue']['growth'] ?? 0) >= 0 ? '+' : '' }}{{ $dashboardData['revenue']['growth'] ?? 0 }}%
                    </span>
                </div>
            @endif
        </div>
        
        <p class="text-sm text-gray-600">
            This month: <span class="font-medium">${{ number_format($dashboardData['revenue']['thisMonth'] ?? 0, 2) }}</span>
        </p>
    </div>

    <!-- Destination Statistics -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Destination Statistics</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Destinations -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Destinations</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dashboardData['destinations']['total'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Listings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Listings</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dashboardData['destinations']['active'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Featured Destinations -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Featured Destinations</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dashboardData['destinations']['featured'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Highlighted Destinations -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Highlighted Destinations</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dashboardData['destinations']['highlighted'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Categories Count -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Categories</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dashboardData['destinations']['categories'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Average Price -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Average Price</p>
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($dashboardData['destinations']['averagePrice'] ?? 0, 2) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Statistics -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Booking Statistics</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Total Bookings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dashboardData['bookings']['total'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Bookings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending Bookings</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dashboardData['bookings']['pending'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Confirmed Bookings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Confirmed Bookings</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dashboardData['bookings']['confirmed'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Dashboard Sections -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Booking Status Overview -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Booking Status Overview</h3>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.bookings.index') }}" class="text-sm text-blue-600 hover:text-blue-700">View all</a>
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>

            <!-- Donut Chart Placeholder -->
            <div class="flex items-center justify-center mb-8">
                <div class="relative w-32 h-32">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-r from-green-400 via-yellow-400 to-red-400 flex items-center justify-center">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $dashboardData['bookings']['total'] ?? 0 }}</div>
                                <div class="text-xs text-gray-500">Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Legend -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-gray-700">Confirmed</span>
                    </div>
                    <span class="text-sm font-medium text-gray-900">{{ $dashboardData['bookings']['confirmed'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span class="text-sm text-gray-700">Pending</span>
                    </div>
                    <span class="text-sm font-medium text-gray-900">{{ $dashboardData['bookings']['pending'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span class="text-sm text-gray-700">Cancelled</span>
                    </div>
                    <span class="text-sm font-medium text-gray-900">{{ $dashboardData['bookings']['cancelled'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Stats Summary -->
        {{-- <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Summary</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Active Destinations</p>
                            <p class="text-xs text-gray-500">Available for booking</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-blue-600">{{ $dashboardData['destinations']['active'] ?? 0 }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Confirmed Bookings</p>
                            <p class="text-xs text-gray-500">Ready to travel</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-green-600">{{ $dashboardData['bookings']['confirmed'] ?? 0 }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Pending Reviews</p>
                            <p class="text-xs text-gray-500">Awaiting approval</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-yellow-600">{{ $dashboardData['bookings']['pending'] ?? 0 }}</span>
                </div>
            </div>
        </div> --}}


         <!-- Recent Activities -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Recent Activities</h3>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.bookings.index') }}" class="text-sm text-blue-600 hover:text-blue-700">View all</a>
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </div>

        <div class="space-y-4">
            @php
                // Get recent bookings for display
                $recentBookings = \App\Models\Booking::with('destination')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            @endphp

            @if($recentBookings->count() > 0)
                @foreach($recentBookings as $booking)
                    <div class="flex items-center space-x-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="flex-shrink-0">
                            <div class="w-2 h-2 {{ $booking->status === 'confirmed' ? 'bg-green-500' : ($booking->status === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }} rounded-full"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $booking->customer_name }}</p>
                            <p class="text-sm text-gray-500">Booked {{ $booking->destination->name ?? 'N/A' }}</p>
                        </div>
                        <div class="flex-shrink-0 text-right">
                            <p class="text-sm font-medium text-gray-900">${{ number_format($booking->destination->price_from ?? 0, 2) }}</p>
                            <p class="text-xs text-gray-500">{{ $booking->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-gray-500">No recent activities</p>
                </div>
            @endif
        </div>
    </div>

    </div>


   
</div>
@endsection