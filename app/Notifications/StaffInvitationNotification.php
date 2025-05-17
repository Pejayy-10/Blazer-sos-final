<?php

namespace App\Notifications;

use App\Models\StaffInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StaffInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invitation;

    /**
     * Create a new notification instance.
     */
    public function __construct(StaffInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        $url = route('register.admin', [
            'token' => $this->invitation->token,
            'email' => $this->invitation->email
        ]);
        
        return (new MailMessage)
            ->subject('Staff Invitation - Join Blazer SOS as ' . $this->invitation->role_name)
            ->greeting('Hello!')
            ->line('You have been invited to join Blazer SOS as a ' . $this->invitation->role_name . '.')
            ->line('Click the button below to create your account:')
            ->action('Create Your Account', $url)
            ->line('This invitation link will expire in 48 hours.')
            ->line('If you did not expect this invitation, please disregard this email.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'invitation_id' => $this->invitation->id,
            'email' => $this->invitation->email,
            'role_name' => $this->invitation->role_name,
        ];
    }
}