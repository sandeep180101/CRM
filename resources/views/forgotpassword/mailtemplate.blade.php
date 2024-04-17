@component('mail::message')
# Reset Your Password

You are receiving this email because we received a password reset request for your account.

**Reset Password Link:** [Click Here]({{ $resetUrl }})

This link will expire at {{ $expiration->format('Y-m-d H:i:s') }}.

If you did not request a password reset, no further action is required.

Thanks,<br>
Your App Team
@endcomponent
