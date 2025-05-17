<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blazer SOS - Digital Yearbook Platform</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind and Custom CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        },
                        burgundy: {
                            100: '#F4D0CC',
                            200: '#E9A199',
                            300: '#D67366',
                            400: '#C34433',
                            500: '#9A382F',
                            600: '#7A1518',
                            700: '#5F0104',
                            800: '#450000',
                            900: '#2B0000',
                        },
                        accent: {
                            100: '#F0E6DF',
                            200: '#E5D3C5',
                            300: '#D4B79F',
                            400: '#C09A78',
                            500: '#A67C52',
                        }
                    },
                },
            },
        }
    </script>
    <style>
        /* Custom CSS for animations and glassmorphism */
        .glass {
            background: rgba(95, 1, 4, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(154, 56, 47, 0.18);
            box-shadow: 0 8px 32px 0 rgba(95, 1, 4, 0.15);
        }
        
        .glass-dark {
            background: rgba(42, 0, 0, 0.75);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(154, 56, 47, 0.08);
            box-shadow: 0 8px 32px 0 rgba(95, 1, 4, 0.25);
        }
        
        .bg-gradient {
            background: linear-gradient(135deg, #7A1518, #5F0104);
        }
        
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.5;
            z-index: -1;
            animation: blob-float 15s infinite ease-in-out;
        }
        
        .blob-1 {
            top: 10%;
            left: 10%;
            width: 500px;
            height: 500px;
            background: rgba(154, 56, 47, 0.5);
            animation-delay: 0s;
        }
        
        .blob-2 {
            bottom: 10%;
            right: 10%;
            width: 600px;
            height: 600px;
            background: rgba(95, 1, 4, 0.4);
            animation-delay: -5s;
        }
        
        .blob-3 {
            top: 40%;
            right: 20%;
            width: 350px;
            height: 350px;
            background: rgba(212, 183, 159, 0.3);
            animation-delay: -10s;
        }
        
        @keyframes blob-float {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-40px) scale(1.1);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
            opacity: 0;
        }
        
        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
            opacity: 0;
        }
        
        .animate-delay-100 {
            animation-delay: 0.1s;
        }
        
        .animate-delay-200 {
            animation-delay: 0.2s;
        }
        
        .animate-delay-300 {
            animation-delay: 0.3s;
        }
        
        .animate-delay-400 {
            animation-delay: 0.4s;
        }
        
        .animate-delay-500 {
            animation-delay: 0.5s;
        }
        
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        /* Loading animation */
        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #FFF;
            border-bottom-color: #7A1518;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-[#200000] to-black text-white min-h-screen overflow-x-hidden">
    <!-- Background blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
      <!-- Loading screen -->
    <div id="loader" class="fixed inset-0 z-50 flex items-center justify-center bg-black" x-data="{show: true}" x-show="show" x-transition.duration.500ms>
        <div class="text-center">
            <span class="loader"></span>
            <p class="mt-4 text-primary-300 font-medium">Loading amazing experience...</p>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="glass fixed w-full z-30 py-4" x-data="{scrolled: false}" :class="scrolled ? 'shadow-lg' : ''" @scroll.window="scrolled = window.scrollY > 10">
        <div class="container mx-auto px-6 md:px-12 flex items-center justify-between">
            <div class="flex items-center">
                <div class="text-3xl font-bold text-white">
                    Blazer<span class="text-primary-400">SOS</span>
                </div>
            </div>
            <div class="hidden md:flex space-x-8 items-center">                <a href="#features" class="text-white hover:text-primary-300 transition-colors">Features</a>
                <a href="#yearbooks" class="text-white hover:text-primary-300 transition-colors">Yearbooks</a>
                <a href="{{ route('about') }}" class="text-white hover:text-primary-300 transition-colors">About</a>
                <a href="#testimonials" class="text-white hover:text-primary-300 transition-colors">Testimonials</a>
                <div class="flex space-x-2">
                    <a href="{{ route('login') }}" onclick="window.location.href='{{ route('login') }}'; return false;" class="px-5 py-2 rounded-lg glass-dark hover:bg-primary-700 transition-colors">Login</a>
                    <a href="{{ route('register') }}" onclick="window.location.href='{{ route('register') }}'; return false;" class="px-5 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 transition-colors">Register</a>
                </div>
            </div>            <div class="md:hidden" x-data="{mobileMenuOpen: false}">
                <button class="text-white focus:outline-none" @click="mobileMenuOpen = !mobileMenuOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                  <!-- Mobile Menu Dropdown -->
                <div 
                    class="absolute top-full left-0 right-0 bg-burgundy-900/95 backdrop-blur-md shadow-lg mt-2 p-4 rounded-b-lg"
                    x-show="mobileMenuOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    @click.away="mobileMenuOpen = false"
                    style="display: none;">
                    <div class="flex flex-col space-y-4 items-center">
                        <a href="#features" class="text-white hover:text-accent-300 transition-colors w-full text-center py-2" @click="mobileMenuOpen = false">Features</a>
                        <a href="#yearbooks" class="text-white hover:text-accent-300 transition-colors w-full text-center py-2" @click="mobileMenuOpen = false">Yearbooks</a>
                        <a href="{{ route('about') }}" class="text-white hover:text-accent-300 transition-colors w-full text-center py-2" @click="mobileMenuOpen = false">About</a>
                        <a href="#testimonials" class="text-white hover:text-accent-300 transition-colors w-full text-center py-2" @click="mobileMenuOpen = false">Testimonials</a>
                        <div class="flex flex-col w-full space-y-2 pt-2 border-t border-white/10">
                            <a href="{{ route('login') }}" onclick="window.location.href='{{ route('login') }}'; return false;" class="px-5 py-2 rounded-lg glass-dark hover:bg-burgundy-700 transition-colors text-center">Login</a>
                            <a href="{{ route('register') }}" onclick="window.location.href='{{ route('register') }}'; return false;" class="px-5 py-2 rounded-lg bg-burgundy-600 hover:bg-burgundy-700 transition-colors text-center">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
      <!-- Hero Section -->
    <section class="relative pt-24 pb-16 md:pt-36 md:pb-24">
        <div class="container mx-auto px-5 md:px-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="md:w-1/2 space-y-5 md:space-y-8 text-center md:text-left animate-fade-in-up">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                        Preserve Your <span class="text-primary-400">College Memories</span> Forever
                    </h1>                    <p class="text-lg md:text-xl text-gray-300 max-w-xl mx-auto md:mx-0">
                        Blazer SOS is a digital yearbook platform that allows you to create, customize, and share your college memories in a beautiful way.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center md:justify-start">
                        <a href="{{ route('register') }}" class="py-3 px-6 md:px-8 rounded-lg bg-primary-600 hover:bg-primary-700 transition-colors text-white font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                            Get Started
                        </a>
                        <a href="#yearbooks" class="py-3 px-6 md:px-8 rounded-lg glass hover:bg-white/10 transition-colors text-white font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                            Explore Yearbooks
                        </a>
                    </div>
                </div>                <div class="md:w-1/2 animate-fade-in animate-delay-200 mt-8 md:mt-0">
                    <div class="glass-dark rounded-2xl p-4 md:p-6 max-w-sm mx-auto md:mx-0 transform rotate-3 hover:rotate-0 transition-transform duration-500 relative shadow-xl">
                        <div class="absolute -top-3 -right-3 bg-primary-500 text-white py-1 px-3 md:px-4 rounded-full text-sm font-medium shadow-lg">
                            {{ $activePlatform ? $activePlatform->year : 'Featured' }}
                        </div>
                        @if($activePlatform && $activePlatform->image_path)
                            <img src="{{ asset($activePlatform->image_path) }}" alt="Yearbook Preview" class="rounded-lg w-full h-auto">
                        @else
                            <!-- Fallback image -->
                            <div class="bg-gradient h-64 sm:h-72 md:h-80 rounded-lg flex items-center justify-center text-center p-6 md:p-8">
                                <div>
                                    <h3 class="text-xl md:text-2xl font-bold mb-2">
                                        {{ $activePlatform ? $activePlatform->name : 'Latest Yearbook' }}
                                    </h3>                                    <p class="text-gray-300 text-sm md:text-base">
                                        {{ $activePlatform ? $activePlatform->theme_title : 'Capturing memories that last a lifetime' }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg md:text-xl font-semibold">
                                    {{ $activePlatform ? $activePlatform->name : 'Latest Edition' }}
                                </h3>                                <p class="text-gray-300 text-sm">
                                    {{ $activePlatform && $activePlatform->theme_title ? $activePlatform->theme_title : 'Our comprehensive yearbook collection' }}
                                </p>
                            </div>
                            <div class="text-primary-300 font-bold">
                                @if($activePlatform && $activePlatform->stock)
                                    ₱{{ number_format($activePlatform->stock->price, 2) }}
                                @else
                                    ₱2,300.00
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <!-- Stats section -->
    <section class="py-12 bg-gray-900/50">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center animate-fade-in-up animate-delay-100">
                    <div class="text-4xl font-bold text-accent-300 mb-2">1000+</div>
                    <div class="text-gray-300">Students</div>
                </div>                <div class="text-center animate-fade-in-up animate-delay-200">
                    <div class="text-4xl font-bold text-accent-300 mb-2">20+</div>
                    <div class="text-gray-300">Years of Memories</div>
                </div>
                <div class="text-center animate-fade-in-up animate-delay-300">
                    <div class="text-4xl font-bold text-accent-300 mb-2">50+</div>
                    <div class="text-gray-300">College Courses</div>
                </div>
                <div class="text-center animate-fade-in-up animate-delay-400">
                    <div class="text-4xl font-bold text-accent-300 mb-2">5000+</div>
                    <div class="text-gray-300">Photos Stored</div>
                </div>
            </div>
        </div>
    </section>
      <!-- Features section -->
    <section id="features" class="py-16 md:py-20">
        <div class="container mx-auto px-5 md:px-12">
            <div class="text-center mb-12 md:mb-16 animate-fade-in-up">                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 md:mb-4">Why Choose Blazer SOS?</h2>
                <p class="text-gray-300 max-w-2xl mx-auto px-2">Our platform offers everything you need to make your college memories last forever in a digital format.</p>
            </div>
            
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-5 md:gap-8">
                <!-- Feature 1 -->
                <div class="glass rounded-xl p-5 md:p-6 card-hover animate-fade-in-up animate-delay-100 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-burgundy-600 flex items-center justify-center mb-4 md:mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>                    <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3">Digital Collections</h3>
                    <p class="text-gray-300 text-sm md:text-base">Store and organize your photos, videos, and documents in one secure place that's accessible from anywhere.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="glass rounded-xl p-5 md:p-6 card-hover animate-fade-in-up animate-delay-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-burgundy-600 flex items-center justify-center mb-4 md:mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>                    <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3">Custom Profiles</h3>
                    <p class="text-gray-300 text-sm md:text-base">Create your personalized profile with photos, quotes, achievements, and more that truly represents your college journey.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="glass rounded-xl p-5 md:p-6 card-hover animate-fade-in-up animate-delay-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 sm:col-span-2 md:col-span-1">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-burgundy-600 flex items-center justify-center mb-4 md:mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>                    <h3 class="text-xl font-bold mb-3">Multiple Yearbooks</h3>
                    <p class="text-gray-300">Subscribe to both current and previous yearbooks to complete your collection and preserve your entire college history.</p>
                </div>
            </div>
        </div>
    </section>
      <!-- Yearbooks showcase -->
    <section id="yearbooks" class="py-20 bg-gray-900/50">
        <div class="container mx-auto px-6 md:px-12">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Yearbook Collection</h2>
                <p class="text-gray-300 max-w-2xl mx-auto">Browse our collection of current and past yearbooks to complete your college memories.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Current Yearbook -->
                @if($activePlatform)
                <div class="glass-dark rounded-xl overflow-hidden card-hover animate-fade-in-up animate-delay-100">                        <div class="relative">
                        @if($activePlatform->image_path)
                            <img src="{{ asset($activePlatform->image_path) }}" alt="{{ $activePlatform->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient flex items-center justify-center">
                                <span class="text-2xl font-bold text-yellow-400">{{ $activePlatform->year }}</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-primary-500 text-white py-1 px-3 rounded-full text-sm">
                            Current
                        </div>
                    </div>
                    <div class="p-6">                        <h3 class="text-xl font-bold mb-2 text-yellow-500">{{ $activePlatform->name }}</h3>
                        <p class="text-sm text-gray-300 mb-4">{{ $activePlatform->theme_title ?? 'Latest Edition' }}</p>
                        <div class="flex justify-between items-center">
                            <div class="text-primary-300 font-bold">
                                ₱{{ number_format($activePlatform->stock->price ?? 2300, 2) }}
                            </div>                            <a href="{{ route('register') }}" class="py-2 px-4 rounded-lg bg-primary-600 hover:bg-primary-700 transition-colors text-sm subscribe-btn">
                                Subscribe Now
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Past Yearbooks -->
                @foreach($pastYearbooks as $yearbook)
                <div class="glass-dark rounded-xl overflow-hidden card-hover animate-fade-in-up animate-delay-{{ 200 + $loop->index * 100 }}">
                    <div class="relative">
                        @if($yearbook->image_path)
                            <img src="{{ asset($yearbook->image_path) }}" alt="{{ $yearbook->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient flex items-center justify-center">
                                <span class="text-2xl font-bold">{{ $yearbook->year }}</span>
                            </div>
                        @endif                        <div class="absolute top-3 right-3 bg-black text-white py-1 px-3 rounded-full text-sm">
                            {{ $yearbook->year }}
                        </div>
                    </div>
                    <div class="p-6">                        <h3 class="text-xl font-bold mb-2 text-yellow-500">{{ $yearbook->name }}</h3>
                        <p class="text-sm text-gray-300 mb-4">{{ $yearbook->theme_title ?? 'Archived Edition' }}</p>
                        <div class="flex justify-between items-center">
                            <div class="text-primary-300 font-bold">
                                ₱{{ number_format($yearbook->stock->price ?? 2300, 2) }}
                            </div>                            <a href="{{ route('register') }}" class="py-2 px-4 rounded-lg bg-primary-600 hover:bg-primary-700 transition-colors text-sm subscribe-btn">
                                Get This Yearbook
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- If no past yearbooks, fill with default -->
                @if(count($pastYearbooks) === 0 && !$activePlatform)
                    @for($i = 0; $i < 3; $i++)
                    <div class="glass-dark rounded-xl overflow-hidden card-hover animate-fade-in-up animate-delay-{{ 100 + $i * 100 }}">
                        <div class="relative">
                            <div class="w-full h-48 bg-gradient flex items-center justify-center">
                                <span class="text-2xl font-bold">{{ 2025 - $i }}</span>
                            </div>                            <div class="absolute top-3 right-3 bg-black text-white py-1 px-3 rounded-full text-sm">
                                {{ $i === 0 ? 'Current' : 'Archived' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Blazer Yearbook {{ 2025 - $i }}</h3>
                            <p class="text-sm text-gray-300 mb-4">{{ $i === 0 ? 'Latest Edition' : 'Archived Edition' }}</p>
                            <div class="flex justify-between items-center">
                                <div class="text-primary-300 font-bold">
                                    ₱2,300.00
                                </div>
                                <a href="{{ route('register') }}" class="py-2 px-4 rounded-lg bg-primary-600 hover:bg-primary-700 transition-colors text-sm">
                                    {{ $i === 0 ? 'Subscribe Now' : 'Get This Yearbook' }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
    
    <!-- Testimonial section -->
    <section id="testimonials" class="py-20">
        <div class="container mx-auto px-6 md:px-12">
            <div class="text-center mb-16 animate-fade-in-up">                <h2 class="text-3xl md:text-4xl font-bold mb-4">What Students Say</h2>
                <p class="text-gray-300 max-w-2xl mx-auto">Hear from students who have used our platform to preserve their memories.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="glass rounded-xl p-6 card-hover animate-fade-in-up animate-delay-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold mr-4">
                            JD
                        </div>
                        <div>
                            <h4 class="font-bold">John Doe</h4>
                            <p class="text-sm text-gray-400">Computer Science, 2024</p>
                        </div>
                    </div>
                    <p class="text-gray-300">"Blazer SOS made it so easy to preserve my college memories. I was able to subscribe to all four years of my yearbooks with just a few clicks!"</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="glass rounded-xl p-6 card-hover animate-fade-in-up animate-delay-200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold mr-4">
                            JS
                        </div>
                        <div>
                            <h4 class="font-bold">Jane Smith</h4>
                            <p class="text-sm text-gray-400">Business Administration, 2023</p>
                        </div>
                    </div>
                    <p class="text-gray-300">"I love how I can access all my yearbooks in one place. The platform is super intuitive and the profiles look amazing. Highly recommend!"</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="glass rounded-xl p-6 card-hover animate-fade-in-up animate-delay-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold mr-4">
                            MJ
                        </div>
                        <div>
                            <h4 class="font-bold">Mike Johnson</h4>
                            <p class="text-sm text-gray-400">Engineering, 2025</p>
                        </div>
                    </div>
                    <p class="text-gray-300">"The fact that I can browse yearbooks from previous years and subscribe to them is amazing. Great way to complete my collection!"</p>
                </div>
            </div>
        </div>
    </section>
      <!-- Call to action -->
    <section class="py-16 md:py-20 bg-gradient">
        <div class="container mx-auto px-5 md:px-12 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 md:mb-6 animate-fade-in-up">Ready to Preserve Your College Memories?</h2>
                <p class="text-base sm:text-lg md:text-xl text-white/80 mb-6 md:mb-8 animate-fade-in-up animate-delay-100 px-2">Join Blazer SOS today and start creating your digital yearbook profile.</p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center animate-fade-in-up animate-delay-200">
                    <a href="{{ route('register') }}" onclick="window.location.href='{{ route('register') }}'; return false;" class="py-3 px-6 md:px-8 rounded-lg bg-burgundy-600 hover:bg-burgundy-700 transition-colors text-white font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" onclick="window.location.href='{{ route('login') }}'; return false;" class="py-3 px-6 md:px-8 rounded-lg bg-white text-primary-600 hover:bg-gray-100 transition-colors font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </section>
      <!-- Footer -->
    <footer class="bg-black py-12">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="text-lg font-bold mb-4">Blazer SOS</h4>
                    <p class="text-gray-400 mb-4">A digital yearbook platform for preserving your college memories forever.</p>
                </div>                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#features" class="hover:text-primary-300 transition-colors">Features</a></li>
                        <li><a href="#yearbooks" class="hover:text-primary-300 transition-colors">Yearbooks</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-primary-300 transition-colors">About</a></li>
                        <li><a href="#testimonials" class="hover:text-primary-300 transition-colors">Testimonials</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Account</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('login') }}" class="hover:text-primary-300 transition-colors">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-primary-300 transition-colors">Register</a></li>
                        <li><a href="{{ route('password.request') }}" class="hover:text-primary-300 transition-colors">Reset Password</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: support@blazersos.com</li>
                        <li>Phone: +1 (123) 456-7890</li>
                        <li>Address: University Campus, City</li>
                    </ul>
                </div>
            </div>            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">© {{ date('Y') }} Blazer SOS. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">                    <a href="#" class="text-gray-400 hover:text-primary-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>                    <a href="#" class="text-gray-400 hover:text-primary-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>                    <a href="#" class="text-gray-400 hover:text-primary-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
      <!-- Alpine.js & custom JS -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Loading screen
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('loader').style.opacity = '0';
                setTimeout(function() {
                    document.getElementById('loader').style.display = 'none';
                }, 500);
            }, 1000); // reduced from 1500 to make page load faster
            
            // Make sure all auth links work properly by enforcing direct navigation
            document.querySelectorAll('a[href*="login"], a[href*="register"]').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = this.getAttribute('href');
                });
            });
        });
    </script>
</body>
</html>
