<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\OtpService;
use Illuminate\Console\Command;

class SendTestOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:test {email : The email of the user to send OTP to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test OTP to a user email to verify mail configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        // Find the user by email
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found.");
            return Command::FAILURE;
        }
        
        // Generate and send OTP
        $otpService = new OtpService();
        $otp = $otpService->generateOtp($user);
        
        try {
            $otpService->sendOtpEmail($user);
            $this->info("OTP {$otp} sent to {$email} successfully!");
            $this->info("This OTP will expire in 15 minutes.");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to send OTP: {$e->getMessage()}");
            return Command::FAILURE;
        }
    }
} 