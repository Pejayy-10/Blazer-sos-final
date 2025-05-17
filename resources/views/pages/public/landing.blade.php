<x-layouts.public>
    <x-slot name="title">Blazer SOS - Digital Yearbook Platform</x-slot>
    
    <!-- Hero Section -->
    <section class="relative pt-28 pb-16 md:pt-36 md:pb-24">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="md:w-1/2 space-y-6 md:space-y-8 text-center md:text-left animate-fade-in-up">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                        Preserve Your <span class="text-accent">College Memories</span> Forever
                    </h1>
                    <p class="text-lg md:text-xl text-white/80 max-w-xl mx-auto md:mx-0">
                        Blazer SOS is a digital yearbook platform that allows you to create, customize, and share your college memories in a beautiful way.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center md:justify-start">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            Get Started
                        </a>
                        <a href="#yearbooks" class="btn btn-secondary btn-lg">
                            Explore Yearbooks
                        </a>
                    </div>
                </div>
                
                <div class="md:w-1/2 animate-fade-in animate-delay-200 mt-8 md:mt-0">
                    <div class="solid-card-dark rounded-xl p-4 md:p-6 max-w-sm mx-auto md:mx-0 transform rotate-3 hover:rotate-0 transition-transform duration-500 relative shadow-xl">
                        <div class="absolute -top-3 -right-3 bg-primary text-white py-1 px-3 md:px-4 rounded-full text-sm font-medium shadow-lg">
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
                                    </h3>
                                    <p class="text-gray-300 text-sm md:text-base">
                                        {{ $activePlatform ? $activePlatform->theme_title : 'Capturing memories that last a lifetime' }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg md:text-xl font-semibold">
                                    {{ $activePlatform ? $activePlatform->name : 'Latest Edition' }}
                                </h3>
                                <p class="text-gray-300 text-sm">
                                    {{ $activePlatform && $activePlatform->theme_title ? $activePlatform->theme_title : 'Our comprehensive yearbook collection' }}
                                </p>
                            </div>
                            <div class="text-accent font-bold">
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
    <section class="py-12 bg-primary-dark/50">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center animate-fade-in-up animate-delay-100">
                    <div class="text-4xl font-bold text-accent mb-2">1000+</div>
                    <div class="text-white/70">Students</div>
                </div>
                
                <div class="text-center animate-fade-in-up animate-delay-200">
                    <div class="text-4xl font-bold text-accent mb-2">20+</div>
                    <div class="text-white/70">Years of Memories</div>
                </div>
                
                <div class="text-center animate-fade-in-up animate-delay-300">
                    <div class="text-4xl font-bold text-accent mb-2">50+</div>
                    <div class="text-white/70">College Courses</div>
                </div>
                
                <div class="text-center animate-fade-in-up animate-delay-400">
                    <div class="text-4xl font-bold text-accent mb-2">5000+</div>
                    <div class="text-white/70">Photos Stored</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features section -->
    <section id="features" class="py-16 md:py-24">
        <div class="container mx-auto px-4 md:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4">Why Choose Blazer SOS?</h2>
                <p class="text-white/70 max-w-2xl mx-auto">Our platform offers everything you need to make your college memories last forever in a digital format.</p>
            </div>
            
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                <!-- Feature 1 -->
                <div class="solid-card p-6 card-hover animate-fade-in-up animate-delay-100">
                    <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Digital Collections</h3>
                    <p class="text-white/70">Store and organize your photos, videos, and documents in one secure place that's accessible from anywhere.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="solid-card p-6 card-hover animate-fade-in-up animate-delay-200">
                    <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Custom Profiles</h3>
                    <p class="text-white/70">Create your personalized profile with photos, quotes, achievements, and more that truly represents your college journey.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="solid-card p-6 card-hover animate-fade-in-up animate-delay-300 sm:col-span-2 md:col-span-1">
                    <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Multiple Yearbooks</h3>
                    <p class="text-white/70">Subscribe to both current and previous yearbooks to complete your collection and preserve your entire college history.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Yearbooks showcase -->
    <section id="yearbooks" class="py-20 bg-primary-dark/50">
        <div class="container mx-auto px-4 md:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Yearbook Collection</h2>
                <p class="text-white/70 max-w-2xl mx-auto">Browse our collection of current and past yearbooks to complete your college memories.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Current Yearbook -->
                @if($activePlatform)
                <div class="solid-card-dark rounded-xl overflow-hidden card-hover animate-fade-in-up animate-delay-100">
                    <div class="relative">
                        @if($activePlatform->image_path)
                            <img src="{{ asset($activePlatform->image_path) }}" alt="{{ $activePlatform->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient flex items-center justify-center">
                                <span class="text-2xl font-bold text-accent">{{ $activePlatform->year }}</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-primary text-white py-1 px-3 rounded-full text-sm">
                            Current
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-accent">{{ $activePlatform->name }}</h3>
                        <p class="text-sm text-white/70 mb-4">{{ $activePlatform->theme_title ?? 'Latest Edition' }}</p>
                        <div class="flex justify-between items-center">
                            <div class="text-accent font-bold">
                                ₱{{ number_format($activePlatform->stock->price ?? 2300, 2) }}
                            </div>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                Subscribe Now
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Past Yearbooks -->
                @foreach($pastYearbooks as $yearbook)
                <div class="solid-card-dark rounded-xl overflow-hidden card-hover animate-fade-in-up animate-delay-{{ 200 + $loop->index * 100 }}">
                    <div class="relative">
                        @if($yearbook->image_path)
                            <img src="{{ asset($yearbook->image_path) }}" alt="{{ $yearbook->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient flex items-center justify-center">
                                <span class="text-2xl font-bold">{{ $yearbook->year }}</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-black text-white py-1 px-3 rounded-full text-sm">
                            {{ $yearbook->year }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-accent">{{ $yearbook->name }}</h3>
                        <p class="text-sm text-white/70 mb-4">{{ $yearbook->theme_title ?? 'Archived Edition' }}</p>
                        <div class="flex justify-between items-center">
                            <div class="text-accent font-bold">
                                ₱{{ number_format($yearbook->stock->price ?? 2300, 2) }}
                            </div>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                Get This Yearbook
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- If no past yearbooks, fill with default -->
                @if(count($pastYearbooks) === 0 && !$activePlatform)
                    @for($i = 0; $i < 3; $i++)
                    <div class="solid-card-dark rounded-xl overflow-hidden card-hover animate-fade-in-up animate-delay-{{ 100 + $i * 100 }}">
                        <div class="relative">
                            <div class="w-full h-48 bg-gradient flex items-center justify-center">
                                <span class="text-2xl font-bold">{{ 2025 - $i }}</span>
                            </div>
                            <div class="absolute top-3 right-3 bg-black text-white py-1 px-3 rounded-full text-sm">
                                {{ $i === 0 ? 'Current' : 'Archived' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 text-accent">Blazer Yearbook {{ 2025 - $i }}</h3>
                            <p class="text-sm text-white/70 mb-4">{{ $i === 0 ? 'Latest Edition' : 'Archived Edition' }}</p>
                            <div class="flex justify-between items-center">
                                <div class="text-accent font-bold">
                                    ₱2,300.00
                                </div>
                                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
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
        <div class="container mx-auto px-4 md:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">What Students Say</h2>
                <p class="text-white/70 max-w-2xl mx-auto">Hear from students who have used our platform to preserve their memories.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="solid-card p-6 card-hover animate-fade-in-up animate-delay-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold mr-4">
                            JD
                        </div>
                        <div>
                            <h4 class="font-bold">John Doe</h4>
                            <p class="text-sm text-white/50">Computer Science, 2024</p>
                        </div>
                    </div>
                    <p class="text-white/70">"Blazer SOS made it so easy to preserve my college memories. I was able to subscribe to all four years of my yearbooks with just a few clicks!"</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="solid-card p-6 card-hover animate-fade-in-up animate-delay-200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold mr-4">
                            JS
                        </div>
                        <div>
                            <h4 class="font-bold">Jane Smith</h4>
                            <p class="text-sm text-white/50">Business Administration, 2023</p>
                        </div>
                    </div>
                    <p class="text-white/70">"I love how I can access all my yearbooks in one place. The platform is super intuitive and the profiles look amazing. Highly recommend!"</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="solid-card p-6 card-hover animate-fade-in-up animate-delay-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold mr-4">
                            MJ
                        </div>
                        <div>
                            <h4 class="font-bold">Mike Johnson</h4>
                            <p class="text-sm text-white/50">Engineering, 2025</p>
                        </div>
                    </div>
                    <p class="text-white/70">"The fact that I can browse yearbooks from previous years and subscribe to them is amazing. Great way to complete my collection!"</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Call to action -->
    <section class="py-16 md:py-24 bg-gradient">
        <div class="container mx-auto px-4 md:px-8 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 animate-fade-in-up">Ready to Preserve Your College Memories?</h2>
                <p class="text-xl text-white/80 mb-8 animate-fade-in-up animate-delay-100">Join Blazer SOS today and start creating your digital yearbook profile.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up animate-delay-200">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public> 