<?php

namespace App\Mail;

use App\Models\StaffInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StaffInvitationLink extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The staff invitation instance.
     *
     * @var \App\Models\StaffInvitation
     */
    public $invitation;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\StaffInvitation  $invitation
     * @return void
     */
    public function __construct(StaffInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Staff Invitation - Join Blazer SOS as ' . $this->invitation->role_name,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.staff-invitation-link',
            with: [
                'invitation' => $this->invitation,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
} 