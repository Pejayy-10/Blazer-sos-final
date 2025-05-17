<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpVerification;

class OtpService
{
    /**
     * Generate a 6-digit OTP code for a user
     *
     * @param User $user
     * @return string
     */
    public function generateOtp(User $user): string
    {
        // Generate a random 6-digit code
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Set expiration time (15 minutes from now)
        $expires = Carbon::now()->addMinutes(15);
        
        // Save to user record
        $user->otp_code = $otp;
        $user->otp_expires_at = $expires;
        $user->save();
        
        return $otp;
    }
    
    /**
     * Send OTP verification email to user
     *
     * @param User $user
     * @return void
     */
    public function sendOtpEmail(User $user): void
    {
        // Send the OTP code via email
        Mail::to($user->email)->send(new OtpVerification($user));
    }
    
    /**
     * Verify an OTP code for a user
     *
     * @param User $user
     * @param string $otpCode
     * @return bool
     */
    public function verifyOtp(User $user, string $otpCode): bool
    {
        // Check if OTP is valid and not expired
        if (
            $user->otp_code === $otpCode && 
            $user->otp_expires_at && 
            Carbon::now()->lt($user->otp_expires_at)
        ) {
            // Mark the user as verified
            $user->is_verified = true;
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if a user is verified
     *
     * @param User $user
     * @return bool
     */
    public function isVerified(User $user): bool
    {
        return $user->is_verified;
    }
} 