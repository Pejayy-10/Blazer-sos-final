<?php

namespace App\Services;

use App\Models\StaffInvitation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\StaffInvitationOtp;

class StaffInvitationOtpService
{
    /**
     * Generate a 6-digit OTP code for a staff invitation
     *
     * @param StaffInvitation $invitation
     * @return string
     */
    public function generateOtp(StaffInvitation $invitation): string
    {
        // Generate a random 6-digit code
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Set expiration time (15 minutes from now)
        $expires = Carbon::now()->addMinutes(15);
        
        // Save to invitation record
        $invitation->otp_code = $otp;
        $invitation->otp_expires_at = $expires;
        $invitation->save();
        
        return $otp;
    }
    
    /**
     * Send OTP verification email to invited staff
     *
     * @param StaffInvitation $invitation
     * @return void
     */
    public function sendOtpEmail(StaffInvitation $invitation): void
    {
        // Send the OTP code via email
        Mail::to($invitation->email)->send(new StaffInvitationOtp($invitation));
    }
    
    /**
     * Verify an OTP code for a staff invitation
     *
     * @param StaffInvitation $invitation
     * @param string $otpCode
     * @return bool
     */
    public function verifyOtp(StaffInvitation $invitation, string $otpCode): bool
    {
        // Check if OTP is valid and not expired
        if (
            $invitation->otp_code === $otpCode && 
            $invitation->otp_expires_at && 
            Carbon::now()->lt($invitation->otp_expires_at)
        ) {
            // Mark the invitation as verified
            $invitation->is_verified = true;
            $invitation->otp_code = null;
            $invitation->otp_expires_at = null;
            $invitation->save();
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if an invitation is verified
     *
     * @param StaffInvitation $invitation
     * @return bool
     */
    public function isVerified(StaffInvitation $invitation): bool
    {
        return (bool) $invitation->is_verified;
    }
} 