<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Email Verification</h2>
    <p>Hi {{ $user->name }},</p>
    <p>Please click the following link to verify your email address:</p>
    <p>
        <a href="{{ route('verify-email', ['token' => $user->verification_token]) }}">Verify Email</a>
    </p>
</body>
</html>
