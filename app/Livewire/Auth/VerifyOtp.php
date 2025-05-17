<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Services\OtpService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Verify Email')]
class VerifyOtp extends Component
{
    #[Rule('required|string|min:6|max:6')]
    public string $otp = '';
    
    public User $user;
    
    public string $email = '';
    public bool $isRegistration = false;
    
    public function mount()
    {
        // Get user ID from session
        $userId = Session::get('auth.user_id');
        
        // Check if this is for registration
        $this->isRegistration = Session::get('auth.registration', false);
        
        if (!$userId) {
            // If no user ID is in session, redirect to login
            return redirect()->route('login');
        }
        
        // Get the user and store email for display
        $this->user = User::findOrFail($userId);
        $this->email = $this->user->email;
    }
    
    public function verifyOtp()
    {
        // Validate the OTP input
        $this->validate();
        
        // Verify the OTP using the service
        $otpService = new OtpService();
        $verified = $otpService->verifyOtp($this->user, $this->otp);
        
        if ($verified) {
            // Remove OTP session data
            Session::forget('auth.user_id');
            
            // Handle differently for registration vs password reset
            if ($this->isRegistration) {
                // This was a registration - log the user in
                Session::forget('auth.registration');
                Auth::login($this->user);
                
                // Regenerate the session ID for security
                request()->session()->regenerate();
                
                // Redirect to profile edit
                return redirect()->route('student.profile.edit');
            } else {
                // This was a password reset or other verification
                // Redirect to login with success message
                return redirect()->route('login')->with('status', 'Your email has been verified! You can now login.');
            }
        } else {
            // If verification fails, show error
            $this->addError('otp', 'The verification code is invalid or has expired.');
            return null;
        }
    }
    
    public function resendOtp()
    {
        // Generate and send a new OTP
        $otpService = new OtpService();
        $otpService->generateOtp($this->user);
        $otpService->sendOtpEmail($this->user);
        
        // Notify the user
        session()->flash('message', 'A new verification code has been sent to your email.');
    }
    
    public function render()
    {
        return view('livewire.auth.verify-otp');
    }
} 