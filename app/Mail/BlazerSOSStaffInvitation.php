<?php

namespace App\Mail;

use App\Models\StaffInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BlazerSOSStaffInvitation extends Mailable implements ShouldQueue
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
     */
    public function __construct(StaffInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Staff Invitation - Join Blazer SOS as ' . $this->invitation->role_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.staff-invitation',
            with: [
                'invitation' => $this->invitation,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
