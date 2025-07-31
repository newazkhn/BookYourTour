<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'BookYourTour') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
    <script>
        // Enhanced navbar scroll effect with better performance
        let ticking = false;
        
        function updateNavbar() {
            const navbar = document.getElementById('navbar');
            const navLinks = navbar.querySelectorAll('.nav-link');
            const navButtons = navbar.querySelectorAll('.nav-button');
            const logo = navbar.querySelector('.nav-logo');
            
            if (window.scrollY > 50) {
                navbar.classList.remove('bg-white/10', 'backdrop-blur-sm');
                navbar.classList.add('bg-white/98', 'backdrop-blur-lg', 'shadow-xl', 'border-gray-200/50');
                
                // Update logo
                logo.classList.remove('text-white', 'hover:text-yellow-400');
                logo.classList.add('text-gray-900', 'hover:text-blue-600');
                
                // Update navigation links
                navLinks.forEach(el => {
                    el.classList.remove('text-white', 'hover:text-yellow-400');
                    el.classList.add('text-gray-700', 'hover:text-blue-600');
                });
                
                // Update buttons (except register button)
                navButtons.forEach(el => {
                    if (!el.classList.contains('register-btn')) {
                        el.classList.remove('text-white', 'hover:text-yellow-400');
                        el.classList.add('text-gray-700', 'hover:text-blue-600');
                    }
                });
            } else {
                navbar.classList.remove('bg-white/98', 'backdrop-blur-lg', 'shadow-xl', 'border-gray-200/50');
                navbar.classList.add('bg-white/10', 'backdrop-blur-sm');
                
                // Revert logo
                logo.classList.remove('text-gray-900', 'hover:text-blue-600');
                logo.classList.add('text-white', 'hover:text-yellow-400');
                
                // Revert navigation links
                navLinks.forEach(el => {
                    el.classList.remove('text-gray-700', 'hover:text-blue-600');
                    el.classList.add('text-white', 'hover:text-yellow-400');
                });
                
                // Revert buttons (except register button)
                navButtons.forEach(el => {
                    if (!el.classList.contains('register-btn')) {
                        el.classList.remove('text-gray-700', 'hover:text-blue-600');
                        el.classList.add('text-white', 'hover:text-yellow-400');
                    }
                });
            }
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick);

        // Enhanced back to top functionality
        function updateBackToTop() {
            const backToTopBtn = document.getElementById('backToTop');
            if (backToTopBtn) {
                if (window.scrollY > 400) {
                    backToTopBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-2');
                    backToTopBtn.classList.add('opacity-100', 'translate-y-0');
                } else {
                    backToTopBtn.classList.remove('opacity-100', 'translate-y-0');
                    backToTopBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                }
            }
        }

        window.addEventListener('scroll', updateBackToTop);

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Mobile menu toggle functionality
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const hamburger = document.getElementById('hamburger');
            const body = document.body;
            
            if (mobileMenu.classList.contains('translate-x-full')) {
                // Open menu
                mobileMenu.classList.remove('translate-x-full');
                mobileMenu.classList.add('translate-x-0');
                mobileOverlay.classList.remove('opacity-0', 'pointer-events-none');
                mobileOverlay.classList.add('opacity-100');
                hamburger.classList.add('open');
                body.classList.add('overflow-hidden');
            } else {
                // Close menu
                mobileMenu.classList.remove('translate-x-0');
                mobileMenu.classList.add('translate-x-full');
                mobileOverlay.classList.remove('opacity-100');
                mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
                hamburger.classList.remove('open');
                body.classList.remove('overflow-hidden');
            }
        }

        // Close mobile menu when clicking outside or on overlay
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const hamburger = document.getElementById('hamburger');
            const navbar = document.getElementById('navbar');
            
            // Close if clicking on overlay or outside navbar when menu is open
            if ((event.target === mobileOverlay || (!navbar.contains(event.target) && !mobileMenu.contains(event.target))) && !mobileMenu.classList.contains('translate-x-full')) {
                toggleMobileMenu();
            }
        });

        // Close mobile menu on window resize to desktop size
        window.addEventListener('resize', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const hamburger = document.getElementById('hamburger');
            const body = document.body;
            
            if (window.innerWidth >= 768 && !mobileMenu.classList.contains('translate-x-full')) {
                mobileMenu.classList.remove('translate-x-0');
                mobileMenu.classList.add('translate-x-full');
                mobileOverlay.classList.remove('opacity-100');
                mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
                hamburger.classList.remove('open');
                body.classList.remove('overflow-hidden');
            }
        });

        // Smooth scrolling for anchor links
        document.addEventListener('DOMContentLoaded', function() {
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        const offsetTop = targetElement.offsetTop - 80; // Account for fixed header
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
    <style>
        /* Enhanced hamburger animation */
        .hamburger {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            width: 24px;
            height: 24px;
            cursor: pointer;
        }
        
        .hamburger span {
            display: block;
            height: 2px;
            width: 100%;
            background-color: currentColor;
            border-radius: 1px;
            transition: all 0.3s ease;
            transform-origin: center;
        }
        
        .hamburger.open span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .hamburger.open span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.open span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #3b82f6, #1d4ed8);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #2563eb, #1e40af);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Enhanced Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/10 backdrop-blur-sm border-b border-white/20 transition-all duration-500 ease-in-out" id="navbar">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="flex justify-between items-center py-4 lg:py-5">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="nav-logo font-bold text-2xl lg:text-3xl text-white hover:text-yellow-400 transition-all duration-300 tracking-tight">
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">BookYourTour</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8 lg:space-x-10">
                    <a href="{{ url('/') }}" class="nav-link text-white hover:text-yellow-400 transition-all duration-300 font-medium text-lg relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('destinations.index') }}" class="nav-link text-white hover:text-yellow-400 transition-all duration-300 font-medium text-lg relative group">
                        Destinations
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white hover:text-yellow-400 transition-all duration-300 font-medium text-lg relative group">
                                Admin Panel
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                        @else
                            <a href="{{ route('user.bookings') }}" class="nav-link text-white hover:text-yellow-400 transition-all duration-300 font-medium text-lg relative group">
                                My Bookings
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                        @endif
                        
                        <!-- User Dropdown -->
                        <div class="relative group">
                            <button class="nav-button text-white hover:text-yellow-400 transition-all duration-300 font-medium text-lg px-4 py-2 rounded-lg hover:bg-white/10 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ Auth::user()->name }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <div class="px-4 py-2 text-sm text-gray-500 border-b">
                                        {{ Auth::user()->email }}
                                        <span class="block text-xs text-blue-600 font-medium">{{ ucfirst(Auth::user()->role) }}</span>
                                    </div>
                                    @if(Auth::user()->isUser())
                                        <a href="{{ route('user.bookings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            My Bookings
                                        </a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-button text-white hover:text-yellow-400 transition-all duration-300 font-medium text-lg px-4 py-2 rounded-lg hover:bg-white/10">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="register-btn px-6 py-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-xl hover:from-yellow-500 hover:to-orange-600 transition-all duration-300 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                            Get Started
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden hamburger text-white hover:text-yellow-400 transition-colors duration-300 p-2" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

       <!-- Mobile Navigation Menu -->
<div id="mobileMenu" class="fixed top-0 right-0 h-full w-80 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out md:hidden z-50">
    <div class="flex flex-col h-full">
        <!-- Mobile Menu Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-white">
            <span class="font-bold text-2xl bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">BookYourTour</span>
            <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-gray-800 transition-colors p-2 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Links -->
        <div class="flex-1 py-6 bg-white">
            <div class="space-y-3 px-6">
                <a href="{{ url('/') }}" class="block py-4 px-4 text-gray-800 hover:text-blue-600 transition-all duration-200 font-medium text-lg rounded-xl hover:bg-blue-50 hover:shadow-sm border border-transparent hover:border-blue-100">
                    Home
                </a>
                <a href="{{ route('destinations.index') }}" class="block py-4 px-4 text-gray-800 hover:text-blue-600 transition-all duration-200 font-medium text-lg rounded-xl hover:bg-blue-50 hover:shadow-sm border border-transparent hover:border-blue-100">
                    Destinations
                </a>
                
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-4 px-4 text-gray-800 hover:text-orange-600 transition-all duration-200 font-medium text-lg rounded-xl hover:bg-orange-50 hover:shadow-sm border border-transparent hover:border-orange-100">
                            Admin Panel
                        </a>
                    @else
                        <a href="{{ route('user.bookings') }}" class="block py-4 px-4 text-gray-800 hover:text-green-600 transition-all duration-200 font-medium text-lg rounded-xl hover:bg-green-50 hover:shadow-sm border border-transparent hover:border-green-100">
                            My Bookings
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Mobile Menu Footer -->
        <div class="p-6 border-t border-gray-200 space-y-4 bg-gray-50">
            @auth
                <!-- User Info -->
                <div class="text-center py-4 bg-white rounded-xl shadow-sm border border-gray-100">
                    <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ Auth::user()->email }}</p>
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full mt-2 font-medium">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full py-3 px-4 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 hover:text-red-800 transition-all duration-200 font-medium text-lg border border-red-200 hover:border-red-300">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block w-full py-3 px-4 bg-white text-gray-800 rounded-xl hover:bg-gray-100 transition-all duration-200 font-medium text-lg text-center border border-gray-200 hover:border-gray-300 shadow-sm">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block w-full py-3 px-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-xl hover:from-yellow-500 hover:to-orange-600 transition-all duration-300 font-semibold text-lg text-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Get Started
                </a>
            @endauth
        </div>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div id="mobileOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 md:hidden z-40"></div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Enhanced Back to Top Button -->
    <button id="backToTop" 
            onclick="scrollToTop()" 
            class="fixed bottom-8 right-8 z-40 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white p-4 rounded-full shadow-2xl transition-all duration-500 opacity-0 pointer-events-none transform translate-y-2 hover:scale-110 hover:shadow-blue-500/25 group"
            title="Back to Top">
        <svg class="w-6 h-6 transition-transform duration-300 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
        
        <!-- Pulse animation ring -->
        <div class="absolute inset-0 rounded-full bg-blue-600 animate-ping opacity-20"></div>
    </button>

    <!-- Enhanced Footer -->
    <footer class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-gray-300">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Section -->
                <div class="md:col-span-2">
                    <h3 class="font-bold text-2xl mb-4 bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                        BookYourTour
                    </h3>
                    <p class="text-gray-400 mb-4 leading-relaxed">
                        Discover amazing destinations and create unforgettable memories with our curated travel experiences.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-lg mb-4 text-white">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Home</a></li>
                        <li><a href="{{ route('destinations.index') }}" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Destinations</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-semibold text-lg mb-4 text-white">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-yellow-400 transition-colors duration-300">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; {{ date('Y') }} BookYourTour Project. All rights reserved. Made with 
                    <span class="text-red-500">♥</span> for travelers worldwide.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>
