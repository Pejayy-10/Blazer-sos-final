{{-- Modern Login Page with Enhanced Design --}}
<div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-[#200000] to-black text-white">
    {{-- Background blobs for animation --}}
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="container mx-auto px-4 flex min-h-screen items-center justify-center">
        <div class="w-full max-w-4xl flex flex-col md:flex-row overflow-hidden rounded-2xl shadow-2xl transform hover:scale-[1.01] transition-all duration-500">
            {{-- Left Column: Form Area --}}
            <div class="w-full md:w-1/2 glass-dark p-8 md:p-12 animate-fade-in-up">
                {{-- Logo & Welcome --}}
                <div class="mb-6 flex flex-col items-center md:items-start">
                    <img src="{{ asset('images/placeholder-logo.png') }}" alt="{{ config('app.name', 'Blazer SOS') }} Logo"
                        class="h-16 sm:h-20 w-auto mb-4 transition-all duration-300 hover:scale-105 animate-pulse">

                    <h1 class="text-3xl sm:text-4xl font-bold mb-2 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-[#D4B79F]">Welcome Back</h1>
                    <p class="text-base sm:text-lg opacity-80 font-light">Sign in to Blazer SOS</p>
                </div>

                {{-- Form Container --}}
                <div class="glass rounded-xl p-6 backdrop-blur-md border border-white/10 shadow-xl">
                    <form wire:submit.prevent="authenticate" novalidate class="space-y-5">
                        {{-- Username Input --}}
                        <div class="space-y-2">
                            <label for="username" class="block text-sm font-medium opacity-90">Username or Email</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input
                                    type="text" id="username" wire:model.lazy="username" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('username') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Enter your username or email" autocomplete="username">
                            </div>
                            @error('username') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Password Input --}}
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium opacity-90">Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input
                                    type="password" id="password" wire:model.lazy="password" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('password') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Enter your password" autocomplete="current-password">
                                <button type="button" onclick="togglePasswordVisibility('password', 'password-eye-icon')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/70 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="password-eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Remember Me Checkbox --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" wire:model="remember" type="checkbox" 
                                    class="h-4 w-4 rounded border-gray-300 text-[#D4B79F] focus:ring-[#D4B79F] bg-white/5 border-white/20">
                                <label for="remember_me" class="ml-2 block text-sm text-white opacity-90">Remember me</label>
                            </div>
                            <a href="{{ route('password.request') }}" wire:navigate class="text-sm text-[#D4B79F] hover:text-white hover:underline transition-colors duration-200">Forgot password?</a>
                        </div>

                        {{-- Login Button --}}
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#D4B79F] to-[#E5C8B0] text-[#5F0104] font-bold py-3 px-4 rounded-lg hover:from-[#E5C8B0] hover:to-[#F5D8C0] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#9A382F] focus:ring-[#D4B79F] transition-all duration-300 ease-in-out flex items-center justify-center disabled:opacity-70 shadow-lg hover:shadow-xl transform hover:-translate-y-1 active:translate-y-0" 
                            wire:loading.attr="disabled" 
                            wire:target="authenticate">
                            <span wire:loading.remove wire:target="authenticate">
                                Sign In 
                                <svg class="ml-2 inline h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                            <span wire:loading wire:target="authenticate" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#5F0104]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> 
                                Signing In...
                            </span>
                        </button>
                    </form>
                </div>

                {{-- Register Link --}}
                <div class="mt-8 text-sm text-white/70 space-y-2 relative z-10">
                    <p>
                        Don't have an account? <a href="{{ route('register') }}" wire:navigate class="text-[#D4B79F] hover:text-white transition-colors duration-200 hover:underline">Create Account</a>
                    </p>
                </div>
            </div>

            {{-- Right Column: Image/Illustration for Larger Screens --}}
            <div class="hidden md:block md:w-1/2 relative overflow-hidden">
                {{-- Background Image with Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-br from-black to-[#300C0F] z-0"></div>
                
                {{-- Content Overlay --}}
                <div class="absolute inset-0 flex flex-col items-center justify-center p-8 lg:p-16 text-center z-20">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6 animate-fade-in-up">Blazer SOS</h2>
                    <p class="text-white/70 max-w-xl mb-8 animate-fade-in-up animate-delay-300">
                        The New Blazer Yearbook Subscription System - Preserve your college memories in a beautiful digital yearbook.
                    </p>
                    
                    {{-- Visual Illustration --}}
                    <div class="relative w-full max-w-md mt-4 animate-fade-in-up animate-delay-300">
                        <div class="relative z-10 glass-dark rounded-lg p-8 border border-white/10 shadow-2xl transform rotate-2 hover:rotate-0 transition-all duration-500">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#D4B79F] to-[#E5C8B0] flex items-center justify-center text-[#5F0104] font-bold text-xl">B</div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-white">Blazer Yearbook</h3>
                                    <p class="text-white/70 text-sm">Creating memories that last</p>
                                </div>
                            </div>
                            <div class="h-32 bg-gradient-to-r from-[#5F0104] to-[#7A1518] rounded-lg mb-4 flex items-center justify-center overflow-hidden relative">
                                <span class="text-white/30 absolute">Yearbook Cover</span>
                                <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-white/70">Class of 2023</div>
                                <div class="flex space-x-2">
                                    <div class="w-6 h-6 rounded-full bg-[#D4B79F]/20 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#D4B79F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                    <div class="w-6 h-6 rounded-full bg-[#D4B79F]/20 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#D4B79F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute top-0 left-0 w-full h-full glass rounded-lg border border-white/5 shadow-xl -rotate-2 -z-0 transform"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Inline styles for the component --}}
    <style>
        /* Glassmorphism and blobs */
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
        
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.5;
            z-index: 0;
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

        .bg-grid-pattern {
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        @keyframes blob-float {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-40px) scale(1.1);
            }
        }
        
        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
            opacity: 0;
        }
        
        .animate-delay-300 {
            animation-delay: 0.3s;
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

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }
    </style>
    
    {{-- JavaScript for Password Visibility Toggle --}}
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</div>
