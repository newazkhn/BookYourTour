<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'BookYourTour') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white flex justify-between">
        <a href="{{ url('/') }}" class="font-bold text-xl">BookYourTour</a>
        <div>
            @auth
                <a href="{{ route('admin.destinations.index') }}" class="mr-3 hover:underline">Admin</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-3 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Page Content -->
    <main class="p-6 max-w-7xl mx-auto">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 text-center p-4">
        &copy; {{ date('Y') }} BookYourTour Project
    </footer>

</body>
</html>
