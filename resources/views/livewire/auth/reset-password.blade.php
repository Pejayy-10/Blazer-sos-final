<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PasswordReset) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

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

                    <h1 class="text-3xl sm:text-4xl font-bold mb-2 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-[#D4B79F]">Reset Password</h1>
                    <p class="text-base sm:text-lg opacity-80 font-light">Create a new password for your account</p>
                </div>

                {{-- Form Container --}}
                <div class="glass rounded-xl p-6 backdrop-blur-md border border-white/10 shadow-xl">
                    <form wire:submit="resetPassword" class="space-y-5">
                        {{-- Email Address --}}
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium opacity-90">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input wire:model="email" id="email" type="email" 
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('email') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Enter your email address">
                            </div>
                            @error('email') 
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium opacity-90">New Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input wire:model="password" id="password" type="password" 
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('password') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Enter your new password">
                                <button type="button" onclick="togglePasswordVisibility('password', 'password-eye-icon')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/70 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="password-eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password') 
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Password Confirmation --}}
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium opacity-90">Confirm Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/50 group-focus-within:text-[#D4B79F] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input wire:model="password_confirmation" id="password_confirmation" type="password"
                                    class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border @error('password_confirmation') border-red-500 @else border-white/10 @enderror focus:outline-none focus:ring-2 focus:ring-[#D4B79F] focus:border-transparent placeholder-white/50 text-white transition-all duration-200"
                                    placeholder="Confirm your new password">
                                <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'confirm-eye-icon')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/70 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="confirm-eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        {{-- Submit Button --}}
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#D4B79F] to-[#E5C8B0] text-[#5F0104] font-bold py-3 px-4 rounded-lg hover:from-[#E5C8B0] hover:to-[#F5D8C0] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#9A382F] focus:ring-[#D4B79F] transition-all duration-300 ease-in-out flex items-center justify-center disabled:opacity-70 shadow-lg hover:shadow-xl transform hover:-translate-y-1 active:translate-y-0 mt-4">
                            <span wire:loading.remove>
                                Reset Password
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </span>
                            <span wire:loading class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#5F0104]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> 
                                Processing...
                            </span>
                        </button>
                    </form>
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
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6 animate-fade-in-up">Create a Strong Password</h2>
                    <p class="text-white/70 max-w-xl mb-8 animate-fade-in-up animate-delay-300">
                        A strong password helps keep your account secure. Make sure to use a combination of uppercase letters, lowercase letters, numbers, and special characters.
                    </p>
                    
                    {{-- Password Tips --}}
                    <div class="relative w-full max-w-md mt-4 animate-fade-in-up animate-delay-300">
                        <div class="relative z-10 glass-dark rounded-lg p-8 border border-white/10 shadow-2xl transform rotate-1 hover:rotate-0 transition-all duration-500">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-[#D4B79F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Password Tips
                            </h3>
                            <ul class="space-y-2 text-white/80 text-sm">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-[#D4B79F]" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    At least 8 characters long
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-[#D4B79F]" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Include uppercase letters (A-Z)
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-[#D4B79F]" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Include lowercase letters (a-z)
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-[#D4B79F]" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Include numbers (0-9)
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-[#D4B79F]" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Include special characters (!@#$%^&*)
                                </li>
                            </ul>
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
