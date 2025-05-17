<?php

namespace App\Livewire\Auth;

use App\Models\User; // Make sure this is imported
use App\Services\OtpService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered; // Import the Registered event
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

#[Layout('components.layouts.guest')]
#[Title('Register')]
class Register extends Component
{
    #[Rule('required|string|max:255')]
    public string $firstName = '';
    
    #[Rule('nullable|string|max:100')]
    public string $middleName = '';

    #[Rule('required|string|max:255')]
    public string $lastName = '';

    #[Rule('required|string|max:255|unique:users,username')] // Ensures username is unique
    public string $username = '';

    #[Rule('required|string|email|max:255|unique:users,email')] // Ensures email is unique
    public string $email = '';

    #[Rule('required|string|min:8|confirmed')] // Matches password_confirmation
    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle user registration - Creates a real user.
     */
    public function register(): void
    {
        // Validate input based on the rules defined above
        $validated = $this->validate();

        // Create the user in the database
        $user = User::create([
            'first_name' => $validated['firstName'], // Map form field to DB column
            'middle_name' => $validated['middleName'] ?? null, // Optional middle name
            'last_name' => $validated['lastName'],   // Map form field to DB column
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hash the password
            // 'role' column will use the default 'student' defined in the migration
        ]);

        // Dispatch the Registered event (for listeners like sending verification emails)
        event(new Registered($user));

        // Generate and send OTP for email verification
        $otpService = new OtpService();
        $otpService->generateOtp($user);
        $otpService->sendOtpEmail($user);

        // Store user ID in session for OTP verification
        Session::put('auth.user_id', $user->id);
        Session::put('auth.registration', true);

        // Redirect to OTP verification page
        $this->redirect(route('verify.otp'), navigate: true);
    }


    public function render()
    {
        // The view doesn't need changes for this step
        return view('livewire.auth.register');
    }
}