<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Forgot Password')]
class ForgotPassword extends Component
{
    #[Rule('required|email')]
    public string $email = '';

    public bool $emailSentSuccessfully = false;

    public function sendResetLinkEmail(): void
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            $this->emailSentSuccessfully = true;
            return;
        }

        $this->addError('email', __($status));
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
