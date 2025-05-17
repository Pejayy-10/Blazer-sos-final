<?php

namespace App\Livewire\Auth;

use App\Models\StaffInvitation;
use App\Services\StaffInvitationOtpService;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Verify Staff Invitation')]
class VerifyStaffInvitationOtp extends Component
{
    #[Rule('required|string|min:6|max:6')]
    public string $otp = '';
    
    public StaffInvitation $invitation;
    
    public string $email = '';
    public string $token = '';
    
    public function mount($token)
    {
        $this->token = $token;
        
        // Find the invitation by token
        $invitation = StaffInvitation::where('token', $token)
            ->whereNull('registered_at')
            ->first();
        
        if (!$invitation) {
            // If no valid invitation found, redirect with error
            return redirect()->route('login')
                ->with('error', 'Invalid or expired invitation token.');
        }
        
        $this->invitation = $invitation;
        $this->email = $invitation->email;
        
        // Generate OTP if not already generated or has expired
        if (!$invitation->otp_code || !$invitation->otp_expires_at || now()->gt($invitation->otp_expires_at)) {
            $otpService = new StaffInvitationOtpService();
            $otpService->generateOtp($invitation);
            $otpService->sendOtpEmail($invitation);
        }
    }
    
    public function verifyOtp()
    {
        // Validate the OTP input
        $this->validate();
        
        // Verify the OTP using the service
        $otpService = new StaffInvitationOtpService();
        $verified = $otpService->verifyOtp($this->invitation, $this->otp);
        
        if ($verified) {
            // Redirect to admin registration form with verified token
            return redirect()->route('admin.register.form', ['token' => $this->token])
                ->with('status', 'Your email has been verified! Please complete your registration.');
        } else {
            // If verification fails, show error
            $this->addError('otp', 'The verification code is invalid or has expired.');
            return null;
        }
    }
    
    public function resendOtp()
    {
        // Generate and send a new OTP
        $otpService = new StaffInvitationOtpService();
        $otpService->generateOtp($this->invitation);
        $otpService->sendOtpEmail($this->invitation);
        
        // Notify the user
        session()->flash('message', 'A new verification code has been sent to your email.');
    }
    
    public function render()
    {
        return view('livewire.auth.verify-staff-invitation-otp');
    }
}
