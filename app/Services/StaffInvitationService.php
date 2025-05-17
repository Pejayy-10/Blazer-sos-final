<?php

namespace App\Services;

use App\Models\StaffInvitation;
use App\Notifications\StaffInvitationNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

class StaffInvitationService
{
    /**
     * Create a new staff invitation.
     *
     * @param string $email
     * @param string $roleName
     * @param int|null $roleNameId
     * @return \App\Models\StaffInvitation
     */
    public function createInvitation(string $email, string $roleName, ?int $roleNameId = null): StaffInvitation
    {
        // Check if there's an existing unused invitation for this email
        $existingInvitation = StaffInvitation::where('email', $email)
            ->whereNull('registered_at')
            ->first();

        if ($existingInvitation) {
            // Update the existing invitation with new details
            $existingInvitation->update([
                'role_name' => $roleName,
                'role_name_id' => $roleNameId,
                'token' => Str::random(64),
                'expires_at' => now()->addDays(2), // Set expiration to 48 hours
                'is_verified' => false,
            ]);

            return $existingInvitation->fresh();
        }

        // Create a new invitation
        return StaffInvitation::create([
            'email' => $email,
            'role_name' => $roleName,
            'role_name_id' => $roleNameId,
            'token' => Str::random(64),
            'expires_at' => now()->addDays(2), // Set expiration to 48 hours
            'is_verified' => false,
        ]);
    }

    /**
     * Send invitation email to the staff member.
     *
     * @param \App\Models\StaffInvitation $invitation
     * @return void
     */
    public function sendInvitationEmail(StaffInvitation $invitation): void
    {
        // Use StaffInvitationNotification instead of StaffInvitationLinkNotification
        Notification::route('mail', $invitation->email)
            ->notify(new \App\Notifications\StaffInvitationNotification($invitation));
    }

    /**
     * Verify if an invitation is valid.
     *
     * @param string $token
     * @param string $email
     * @return bool
     */
    public function verifyInvitation(string $token, string $email): bool
    {
        $invitation = StaffInvitation::where('token', $token)
            ->where('email', $email)
            ->whereNull('registered_at')
            ->where('expires_at', '>', now())
            ->first();

        return $invitation !== null;
    }

    /**
     * Mark an invitation as used.
     *
     * @param string $token
     * @param string $email
     * @return bool
     */
    public function markInvitationAsUsed(string $token, string $email): bool
    {
        $invitation = StaffInvitation::where('token', $token)
            ->where('email', $email)
            ->whereNull('registered_at')
            ->first();

        if ($invitation) {
            $invitation->update([
                'registered_at' => now(),
                'is_verified' => true,
            ]);

            return true;
        }

        return false;
    }
} 