@component('mail::message')
<div style="text-align: center; margin-bottom: 30px;">
    <h1 style="color: #7A1518; font-size: 28px; font-weight: bold;">Blazer SOS Staff Invitation</h1>
    <p style="font-size: 18px; color: #5F0104;">You've been invited to join our team!</p>
</div>

<p>Hello,</p>

<p>You have been invited to join <strong>Blazer SOS</strong> as a <strong>{{ $invitation->role_name }}</strong>.</p>

<p>As a staff member, you'll have access to manage the yearbook system and help create memorable experiences for our students.</p>

@component('mail::button', ['url' => route('register.admin', ['token' => $invitation->token, 'email' => $invitation->email]), 'color' => 'primary'])
Create Your Account
@endcomponent

<div style="background-color: #f8f5f2; padding: 15px; border-radius: 8px; margin: 20px 0;">
    <p style="font-weight: bold; margin-bottom: 10px;">Invitation Details:</p>
    <ul style="list-style-type: none; padding-left: 0;">
        <li><strong>Email:</strong> {{ $invitation->email }}</li>
        <li><strong>Role:</strong> {{ $invitation->role_name }}</li>
        <li><strong>Expires:</strong> {{ $invitation->expires_at->format('F d, Y') }}</li>
    </ul>
</div>

<p>This invitation link will expire in 48 hours. If you're unable to click the button, copy and paste the following URL into your browser:</p>

<p style="word-break: break-all; font-size: 12px; color: #666;">{{ route('register.admin', ['token' => $invitation->token, 'email' => $invitation->email]) }}</p>

<p>If you did not expect this invitation, please disregard this email.</p>

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
