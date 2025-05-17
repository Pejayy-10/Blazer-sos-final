<?php

namespace App\Notifications;

use App\Mail\StaffInvitationLink;
use App\Models\StaffInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class StaffInvitationLinkNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The staff invitation instance.
     *
     * @var \App\Models\StaffInvitation
     */
    protected $invitation;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\StaffInvitation  $invitation
     * @return void
     */
    public function __construct(StaffInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new StaffInvitationLink($this->invitation))
            ->to($this->invitation->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'invitation_id' => $this->invitation->id,
            'email' => $this->invitation->email,
            'role_name' => $this->invitation->role_name,
        ];
    }
} 