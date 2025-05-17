{{-- Staff Invitation OTP Verification Page --}}
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

                    <h1 class="text-3xl sm:text-4xl font-bold mb-2 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-[#D4B79F]">Verify Staff Invitation</h1>
                    <p class="text-base sm:text-lg opacity-80 font-light">Enter the code sent to your email</p>
                </div>

                {{-- Form Container --}}
                <div class="glass rounded-xl p-6 backdrop-blur-md border border-white/10 shadow-xl">
                    
                    @if (session('message'))
                        <div class="mb-4 p-4 bg-[#D4B79F]/20 backdrop-blur-sm rounded-lg text-white text-sm border border-[#D4B79F]/30 animate-fade-in-up">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    <p class="text-white/80 mb-5 text-sm sm:text-base">
                        We've sent a verification code to <strong class="text-[#D4B79F]">{{ $email }}</strong>. 
                        Please check your inbox and enter the code below to verify your staff invitation.
                    </p>
                    
                    <form wire:submit.prevent="verifyOtp" novalidate class="space-y-5">
                        {{-- OTP Input --}}
                        <div class="space-y-2">
                            <label for="otp" class="block text-sm font-medium opacity-90">Verification Code</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input
                                    type="text" id="otp" wire:model="otp" required
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('otp') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200 text-center text-lg tracking-widest"
                                    placeholder="000000" maxlength="6">
                            </div>
                            @error('otp') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Verify Button --}}
<div>
                            <button type="submit" 
                                class="w-full bg-gradient-to-r from-[#D4B79F] to-[#E5C8B0] text-[#5F0104] font-bold py-3 px-4 rounded-lg hover:from-[#E5C8B0] hover:to-[#F5D8C0] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#9A382F] focus:ring-[#D4B79F] transition-all duration-300 ease-in-out flex items-center justify-center disabled:opacity-70 shadow-lg hover:shadow-xl transform hover:-translate-y-1 active:translate-y-0">
                                Verify Email
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-5 text-center text-white/70 text-sm">
                        <p>Didn't receive the code?</p>
                        <button wire:click="resendOtp" class="text-[#D4B79F] hover:text-white transition-colors duration-200 font-medium mt-1 hover:underline">
                            Resend Code
                        </button>
                    </div>
                </div>

                {{-- Footer Links --}}
                <div class="mt-8 text-sm text-white/70 space-y-2 relative z-10">
                    <p>
                        Already have an account? <a href="{{ route('login') }}" class="text-[#D4B79F] hover:text-white transition-colors duration-200 hover:underline" wire:navigate>Login here</a>
                    </p>
                    <p>
                        Need assistance? <a href="#" class="text-[#D4B79F] hover:text-white transition-colors duration-200 hover:underline">Contact support</a>
                    </p>
                </div>
            </div>

            {{-- Right Column: Image/Illustration for Larger Screens --}}
            <div class="hidden md:block md:w-1/2 relative overflow-hidden">
                {{-- Background Image with Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-br from-black to-[#300C0F] z-0"></div>
                
                {{-- Content Overlay --}}
                <div class="absolute inset-0 flex flex-col items-center justify-center p-8 lg:p-16 text-center z-20">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6 animate-fade-in-up">Join the Blazer SOS Team</h2>
                    <p class="text-white/70 max-w-xl mb-8 animate-fade-in-up animate-delay-300">
                        You've been invited to join the Blazer SOS staff team! We use email verification to ensure account security and protect access to administrative features.
                    </p>
                    
                    {{-- Visual Illustration --}}
                    <div class="relative w-full max-w-md mt-4 animate-fade-in-up animate-delay-300">
                        <div class="relative z-10 glass-dark rounded-lg p-8 border border-white/10 shadow-2xl transform rotate-3 hover:rotate-0 transition-all duration-500">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-[#D4B79F] flex items-center justify-center text-[#5F0104] font-bold">AS</div>
                                    <div class="ml-3">
                                        <div class="font-medium">Admin Staff</div>
                                        <div class="text-xs text-white/50">{{ $invitation->role_name }}</div>
                                    </div>
                                </div>
                                <div class="text-[#D4B79F]">Pending</div>
                            </div>
                            <div class="h-32 bg-gradient-to-r from-[#5F0104] to-[#7A1518] rounded mb-4 flex items-center justify-center">
                                <span class="text-white/80">Administrator Dashboard</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-sm">Invited: {{ now()->format('M d, Y') }}</div>
                                <div class="flex space-x-2">
                                    <div class="w-6 h-6 rounded-full bg-[#D4B79F]/20 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#D4B79F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="w-6 h-6 rounded-full bg-[#D4B79F]/20 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#D4B79F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute top-0 left-0 w-full h-full glass rounded-lg border border-white/5 shadow-xl -rotate-3 -z-0 transform"></div>
                    </div>
                </div>
                
                {{-- Background Pattern --}}
                <div class="absolute inset-0 opacity-10 bg-grid-pattern z-10"></div>
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
        
        @keyframes blob-float {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-40px) scale(1.1);
            }
        }
        
        @keyframes animate-fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: animate-fade-in-up 0.6s ease-out forwards;
        }
        
        .animate-delay-300 {
            animation-delay: 0.3s;
        }
        
        .bg-grid-pattern {
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</div>
