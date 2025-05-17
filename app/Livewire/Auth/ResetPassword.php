<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Reset Password')]
class ResetPassword extends Component
{
    public $token;
    
    #[Rule('required|email')]
    public $email = '';
    
    #[Rule('required|string|min:8|confirmed')]
    public $password = '';
    
    public $password_confirmation = '';
    
    public function mount($token)
    {
        $this->token = $token;
        
        // If email is provided in the URL query parameters, pre-fill it
        $this->email = request()->query('email', '');
    }
    
    public function resetPassword()
    {
        $this->validate();
        
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
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
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }
        
        $this->addError('email', __($status));
    }
    
    public function render()
    {
        return view('livewire.auth.reset-password');
    }
} 