<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Authentication') - {{ config('app.name', 'BookYourTour') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 font-sans antialiased">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    
    <!-- Navigation -->
    <nav class="relative z-10 bg-white/80 backdrop-blur-sm border-b border-gray-200/50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="font-bold text-2xl text-gray-900 hover:text-blue-600 transition-colors duration-300">
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">BookYourTour</span>
                </a>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 font-medium">
                        Home
                    </a>
                    <a href="{{ route('destinations.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 font-medium">
                        Destinations
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo/Brand -->
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-block">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                        BookYourTour
                    </h1>
                </a>
                <p class="mt-2 text-gray-600">@yield('subtitle', 'Welcome back to your travel adventure')</p>
            </div>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white/80 backdrop-blur-sm py-8 px-4 shadow-2xl sm:rounded-2xl sm:px-10 border border-gray-200/50">
                @yield('content')
            </div>
        </div>

        <!-- Footer Links -->
        <div class="mt-8 text-center">
            <div class="flex justify-center space-x-6 text-sm text-gray-500">
                <a href="#" class="hover:text-gray-700 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-gray-700 transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-gray-700 transition-colors">Help</a>
            </div>
            <p class="mt-2 text-xs text-gray-400">
                &copy; {{ date('Y') }} BookYourTour. All rights reserved.
            </p>
        </div>
    </div>

    <!-- Floating Elements for Visual Interest -->
    <div class="fixed top-20 left-10 w-20 h-20 bg-yellow-400/10 rounded-full blur-xl animate-pulse"></div>
    <div class="fixed bottom-20 right-10 w-32 h-32 bg-blue-400/10 rounded-full blur-xl animate-pulse delay-1000"></div>
    <div class="fixed top-1/2 right-20 w-16 h-16 bg-purple-400/10 rounded-full blur-xl animate-pulse delay-500"></div>

    <style>
        .bg-grid-pattern {
            background-image: 
                linear-gradient(rgba(0,0,0,0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</body>
</html>
