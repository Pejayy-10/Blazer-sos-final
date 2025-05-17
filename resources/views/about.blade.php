<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Blazer SOS - Digital Yearbook Platform</title>
    
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
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-[#200000] to-black text-white min-h-screen overflow-x-hidden">
    <!-- Background blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    
    <!-- Navigation -->
    <nav class="glass fixed w-full z-30 py-4" x-data="{scrolled: false}" :class="scrolled ? 'shadow-lg' : ''" @scroll.window="scrolled = window.scrollY > 10">
        <div class="container mx-auto px-6 md:px-12 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center">
                <div class="text-3xl font-bold text-white">
                    Blazer<span class="text-accent-300">SOS</span>
                </div>
            </a>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('landing') }}#features" class="text-white hover:text-accent-300 transition-colors">Features</a>
                <a href="{{ route('landing') }}#yearbooks" class="text-white hover:text-accent-300 transition-colors">Yearbooks</a>
                <a href="{{ route('about') }}" class="text-white hover:text-accent-300 transition-colors border-b-2 border-accent-300 pb-1">About</a>
                <a href="{{ route('landing') }}#testimonials" class="text-white hover:text-accent-300 transition-colors">Testimonials</a>
                <div class="flex space-x-2">
                    <a href="{{ route('login') }}" onclick="window.location.href='{{ route('login') }}'; return false;" class="px-5 py-2 rounded-lg glass-dark hover:bg-burgundy-700 transition-colors">Login</a>
                    <a href="{{ route('register') }}" onclick="window.location.href='{{ route('register') }}'; return false;" class="px-5 py-2 rounded-lg bg-burgundy-600 hover:bg-burgundy-700 transition-colors">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pt-32 pb-16">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-5xl font-bold mb-8 text-center animate-fade-in-up">About <span class="text-accent-300">Blazer SOS</span></h1>
            
            <div class="glass-dark shadow-lg rounded-xl p-6 md:p-8 mb-12 animate-fade-in-up animate-delay-100">
                <h2 class="text-2xl font-bold mb-4 text-accent-300">Our Mission</h2>
            <p class="text-gray-300 mb-6">
                At Blazer SOS, our mission is to preserve and celebrate the college experiences of students through innovative digital yearbooks. We believe that every moment, achievement, and connection made during these formative years deserves to be remembered and cherished for a lifetime.
            </p>
            <p class="text-gray-300 mb-6">
                Our digital yearbook platform serves as a bridge between traditional yearbooks and modern digital experiences, offering students a way to capture their college memories in a format that will never fade, tear, or be lost.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="glass shadow-lg rounded-xl p-6 animate-fade-in-up animate-delay-200 card-hover">
                    <h2 class="text-xl font-bold mb-4 text-accent-300">Our Story</h2>
                <p class="text-gray-300">
                    Blazer SOS was founded in 2020 by a group of college alumni who recognized the need for a better way to preserve college memories. After noticing that traditional yearbooks were becoming less relevant in the digital age, they set out to create a platform that would combine the sentimental value of yearbooks with the accessibility and features of modern technology.
                </p>
            </div>
                <div class="glass shadow-lg rounded-xl p-6 animate-fade-in-up animate-delay-300 card-hover">
                    <h2 class="text-xl font-bold mb-4 text-accent-300">Our Values</h2>
                <ul class="text-gray-300 space-y-2">
                        <li><span class="text-burgundy-400 font-semibold">Preservation:</span> We believe in the importance of preserving memories for future reflection.</li>
                        <li><span class="text-burgundy-400 font-semibold">Innovation:</span> We constantly seek new ways to enhance the digital yearbook experience.</li>
                        <li><span class="text-burgundy-400 font-semibold">Accessibility:</span> We ensure our platform is accessible to all students regardless of technical ability.</li>
                        <li><span class="text-burgundy-400 font-semibold">Community:</span> We foster connections among students and alumni through shared experiences.</li>
                </ul>
            </div>
        </div>

            <div class="glass-dark shadow-lg rounded-xl p-6 md:p-8 mb-12 animate-fade-in-up animate-delay-400">
                <h2 class="text-2xl font-bold mb-6 text-accent-300">Our Team</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <div class="text-center">
                        <div class="w-24 h-24 rounded-full bg-burgundy-600 mx-auto flex items-center justify-center text-white text-2xl font-bold shadow-lg">FP</div>
                    <h3 class="mt-3 font-bold">Fran Peruso</h3>
                    <p class="text-gray-400 text-sm">Founder | Developer</p>
                </div>
                <div class="text-center">
                        <div class="w-24 h-24 rounded-full bg-burgundy-600 mx-auto flex items-center justify-center text-white text-2xl font-bold shadow-lg">SJ</div>
                    <h3 class="mt-3 font-bold">Saad Jandul</h3>
                    <p class="text-gray-400 text-sm">Creative Director</p>
                </div>
                <div class="text-center">
                        <div class="w-24 h-24 rounded-full bg-burgundy-600 mx-auto flex items-center justify-center text-white text-2xl font-bold shadow-lg">MJ</div>
                    <h3 class="mt-3 font-bold">Mashud Jumli</h3>
                    <p class="text-gray-400 text-sm">Finance Officer</p>
                </div>
            </div>
        </div>

            <div class="glass shadow-lg rounded-xl p-6 md:p-8 animate-fade-in-up animate-delay-500">
                <h2 class="text-2xl font-bold mb-4 text-accent-300">Contact Us</h2>
            <p class="text-gray-300 mb-6">
                We'd love to hear from you! Whether you have questions about our platform, need technical support, or want to provide feedback, our team is here to help.
            </p>
            <div class="grid md:grid-cols-2 gap-4">
                    <div class="glass-dark p-4 rounded-lg transition-all duration-300 hover:bg-burgundy-800/40">
                        <h3 class="font-bold text-accent-300 mb-2">Email</h3>
                    <p class="text-gray-300">wmsublazersos@gmail.com</p>
                </div>
                    <div class="glass-dark p-4 rounded-lg transition-all duration-300 hover:bg-burgundy-800/40">
                        <h3 class="font-bold text-accent-300 mb-2">Phone</h3>
                    <p class="text-gray-300">09534561284</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-10 border-t border-gray-800">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="text-lg font-bold mb-4">Blazer<span class="text-accent-300">SOS</span></h4>
                    <p class="text-gray-400 mb-4">A digital yearbook platform for preserving your college memories forever.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('landing') }}#features" class="hover:text-accent-300 transition-colors">Features</a></li>
                        <li><a href="{{ route('landing') }}#yearbooks" class="hover:text-accent-300 transition-colors">Yearbooks</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-accent-300 transition-colors">About</a></li>
                        <li><a href="{{ route('landing') }}#testimonials" class="hover:text-accent-300 transition-colors">Testimonials</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Account</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('login') }}" class="hover:text-accent-300 transition-colors">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-accent-300 transition-colors">Register</a></li>
                        <li><a href="{{ route('password.request') }}" class="hover:text-accent-300 transition-colors">Reset Password</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-accent-300 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent-300 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent-300 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="pt-6 border-t border-gray-800 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Blazer SOS. All rights reserved.
    </div>
</div>
    </footer>

    <!-- Alpine.js & custom JS -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
