{{-- Modern Registration Page with Enhanced Design --}}
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

                    <h1 class="text-3xl sm:text-4xl font-bold mb-2 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-[#D4B79F]">Create Account</h1>
                    <p class="text-base sm:text-lg opacity-80 font-light">Join Blazer SOS today</p>
                </div>

                {{-- Form Container --}}
                <div class="glass rounded-xl p-6 backdrop-blur-md border border-white/10 shadow-xl">
                    <form wire:submit="register" class="space-y-5">
                        {{-- First Name Input --}}
                        <div class="space-y-2">
                            <label for="firstName" class="block text-sm font-medium opacity-90">First Name</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" id="firstName" wire:model="firstName" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('firstName') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Enter your first name">
                            </div>
                            @error('firstName') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Middle Name Input (Optional) --}}
                        <div class="space-y-2">
                            <label for="middleName" class="block text-sm font-medium opacity-90">Middle Name <span class="text-xs opacity-70">(Optional)</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" id="middleName" wire:model="middleName"
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('middleName') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Enter your middle name or initial">
                            </div>
                            @error('middleName') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Last Name Input --}}
                        <div class="space-y-2">
                            <label for="lastName" class="block text-sm font-medium opacity-90">Last Name</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" id="lastName" wire:model="lastName" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('lastName') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Enter your last name">
                            </div>
                            @error('lastName') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Username Input --}}
                        <div class="space-y-2">
                            <label for="username" class="block text-sm font-medium opacity-90">Username</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" id="username" wire:model="username" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('username') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Choose a username">
                            </div>
                            @error('username') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email Input --}}
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium opacity-90">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email" id="email" wire:model="email" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('email') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="you@example.com">
                            </div>
                            @error('email') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
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
                                <input type="password" id="password" wire:model="password" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('password') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Create a password">
                                <button type="button" onclick="togglePasswordVisibility('password', 'password-eye-icon')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/50 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="password-eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Confirm Password Input --}}
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium opacity-90">Confirm Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input type="password" id="password_confirmation" wire:model="password_confirmation" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('password_confirmation') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Confirm your password">
                                <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'confirm-password-eye-icon')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/50 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="confirm-password-eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Register Button --}}
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#D4B79F] to-[#E5C8B0] text-[#5F0104] font-bold py-3 px-4 rounded-lg hover:from-[#E5C8B0] hover:to-[#F5D8C0] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#9A382F] focus:ring-[#D4B79F] transition-all duration-300 ease-in-out flex items-center justify-center disabled:opacity-70 shadow-lg hover:shadow-xl transform hover:-translate-y-1 active:translate-y-0" 
                            wire:loading.attr="disabled" 
                            wire:target="register">
                            <span wire:loading.remove wire:target="register">
                                Create Account
                                <svg class="ml-2 inline h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                            <span wire:loading wire:target="register" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#5F0104]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> 
                                Creating Account...
                            </span>
                        </button>
                    </form>
                </div>

                {{-- Login Link --}}
                <div class="mt-8 text-sm text-white/70 space-y-2 relative z-10">
                    <p>
                        Already have an account? 
                        <a href="{{ route('login') }}" wire:navigate class="text-[#D4B79F] hover:text-white transition-colors duration-200 hover:underline">Sign In</a>
                    </p>
                </div>
            </div>

            {{-- Right Column: Image/Illustration for Larger Screens --}}
            <div class="hidden md:block md:w-1/2 relative overflow-hidden">
                {{-- Background Image with Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-br from-black to-[#300C0F] z-0"></div>
                
                {{-- Content Overlay --}}
                <div class="absolute inset-0 flex flex-col items-center justify-center p-8 lg:p-16 text-center z-20">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6 animate-fade-in-up">Join Blazer SOS</h2>
                    <p class="text-white/70 max-w-xl mb-8 animate-fade-in-up animate-delay-300">
                        Create your account to access the new Blazer Yearbook Subscription System and preserve your college memories in a beautiful digital yearbook.
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        .bg-grid-pattern {
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 20px 20px;
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
