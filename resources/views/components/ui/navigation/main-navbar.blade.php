<nav class="fixed w-full z-30 transition-all duration-300" 
     x-data="{
        mobileMenuOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 10;
            });
        }
     }" 
     :class="scrolled ? 'py-2 shadow-lg bg-primary-dark' : 'py-4 bg-transparent'">
    <div class="container mx-auto px-4 md:px-8">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('landing') }}" class="flex items-center">
                    <span class="text-2xl font-bold text-text-light">
                        Blazer<span class="text-accent">SOS</span>
                    </span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="nav-link">Features</a>
                <a href="#yearbooks" class="nav-link">Yearbooks</a>
                <a href="{{ route('about') }}" class="nav-link">About</a>
                <a href="#testimonials" class="nav-link">Testimonials</a>
                
                <!-- Auth Links -->
                <div class="flex space-x-3">
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                </div>
            </div>
            
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white focus:outline-none" @click="mobileMenuOpen = !mobileMenuOpen">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div 
        class="md:hidden absolute top-full left-0 right-0 bg-primary-dark shadow-lg mt-0 p-4 transform transition-all duration-300 ease-in-out overflow-hidden"
        :class="mobileMenuOpen ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'"
        @click.away="mobileMenuOpen = false">
        <div class="flex flex-col space-y-4">
            <a href="#features" class="nav-link block py-2 text-center" @click="mobileMenuOpen = false">Features</a>
            <a href="#yearbooks" class="nav-link block py-2 text-center" @click="mobileMenuOpen = false">Yearbooks</a>
            <a href="{{ route('about') }}" class="nav-link block py-2 text-center" @click="mobileMenuOpen = false">About</a>
            <a href="#testimonials" class="nav-link block py-2 text-center" @click="mobileMenuOpen = false">Testimonials</a>
            
            <div class="flex flex-col space-y-2 pt-2 border-t border-primary-light/30">
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm w-full">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm w-full">Register</a>
            </div>
        </div>
    </div>
</nav> 