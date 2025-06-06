<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

{{-- Forgot Password Page with Modern Design --}}
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

                    <h1 class="text-3xl sm:text-4xl font-bold mb-2 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-[#D4B79F]">Forgot Password</h1>
                    <p class="text-base sm:text-lg opacity-80 font-light">Enter your email to reset your password</p>
                </div>

                {{-- Form Container --}}
                <div class="glass rounded-xl p-6 backdrop-blur-md border border-white/10 shadow-xl">
                    @if($emailSentSuccessfully)
                        <div class="bg-[#D4B79F]/20 backdrop-blur-sm rounded-lg p-4 text-white text-sm border border-[#D4B79F]/30 animate-fade-in-up">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#D4B79F]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p>Password reset link has been sent to your email. Please check your inbox and follow the instructions to reset your password.</p>
                            </div>
                        </div>
                    @else
                        <p class="text-white/80 mb-5 text-sm sm:text-base">
                            Enter your email address below and we'll send you a link to reset your password.
                        </p>
                        
                        <form wire:submit.prevent="sendResetLinkEmail" novalidate class="space-y-5">
                            {{-- Email Input --}}
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium opacity-90">Email Address</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input
                                        type="email" id="email" wire:model="email" required autofocus
                                        class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('email') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                        placeholder="Enter your email address">
                                </div>
                                @error('email') <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            {{-- Reset Button --}}
                            <button type="submit" 
                                class="w-full bg-gradient-to-r from-[#D4B79F] to-[#E5C8B0] text-[#5F0104] font-bold py-3 px-4 rounded-lg hover:from-[#E5C8B0] hover:to-[#F5D8C0] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#9A382F] focus:ring-[#D4B79F] transition-all duration-300 ease-in-out flex items-center justify-center disabled:opacity-70 shadow-lg hover:shadow-xl transform hover:-translate-y-1 active:translate-y-0"
                                wire:loading.attr="disabled" 
                                wire:target="sendResetLinkEmail">
                                <span wire:loading.remove wire:target="sendResetLinkEmail">
                                    Send Reset Link
                                    <svg class="ml-2 inline h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span wire:loading wire:target="sendResetLinkEmail" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#5F0104]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg> 
                                    Sending...
                                </span>
                            </button>
                        </form>
                    @endif
                </div>

                {{-- Login Link --}}
                <div class="mt-8 text-sm text-white/70 space-y-2 relative z-10">
                    <p>
                        Remember your password? <a href="{{ route('login') }}" class="text-[#D4B79F] hover:text-white transition-colors duration-200 hover:underline" wire:navigate>Login here</a>
                    </p>
                </div>
            </div>

            {{-- Right Column: Image/Illustration for Larger Screens --}}
            <div class="hidden md:block md:w-1/2 relative overflow-hidden">
                {{-- Background Image with Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-br from-black to-[#300C0F] z-0"></div>
                
                {{-- Content Overlay --}}
                <div class="absolute inset-0 flex flex-col items-center justify-center p-8 lg:p-16 text-center z-20">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6 animate-fade-in-up">Password Recovery</h2>
                    <p class="text-white/70 max-w-xl mb-8 animate-fade-in-up animate-delay-300">
                        We'll help you reset your password and regain access to your account. A secure password reset link will be sent to your email address.
                    </p>
                    
                    {{-- Visual Illustration --}}
                    <div class="relative w-full max-w-md mt-4 animate-fade-in-up animate-delay-300">
                        <div class="relative z-10 glass-dark rounded-lg p-8 border border-white/10 shadow-2xl transform rotate-3 hover:rotate-0 transition-all duration-500">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#D4B79F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-white">Secure Recovery</h3>
                                    <p class="text-white/70 text-sm">We use email verification to keep your account safe</p>
                                </div>
                            </div>
                            <div class="bg-white/5 p-4 rounded-lg border border-white/10 mb-4">
                                <div class="flex items-center space-x-2 mb-3">
                                    <div class="w-2 h-2 rounded-full bg-[#D4B79F]"></div>
                                    <div class="text-sm text-white/80">Enter your email</div>
                                </div>
                                <div class="flex items-center space-x-2 mb-3">
                                    <div class="w-2 h-2 rounded-full bg-[#D4B79F]"></div>
                                    <div class="text-sm text-white/80">Receive reset link via email</div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 rounded-full bg-[#D4B79F]"></div>
                                    <div class="text-sm text-white/80">Create new password</div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <div class="text-[#D4B79F] text-sm font-medium">Need more help?</div>
                                <div class="text-white/50 text-xs mt-1">Contact our support team</div>
                            </div>
                        </div>
                        
                        <div class="absolute top-0 left-0 w-full h-full glass rounded-lg border border-white/5 shadow-xl -rotate-3 -z-0 transform"></div>
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
    </style>
</div>
