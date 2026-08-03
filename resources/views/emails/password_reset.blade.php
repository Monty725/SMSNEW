<!DOCTYPE html>
<html>
<body>
<p>Hello {{ $user->firstname }},</p>

<p>Your password for the Sugar Monitoring System has been reset by an administrator.</p>

<p><strong>Your new password is:</strong> {{ $newPassword }}</p>

<p>Please log in and change your password as soon as possible for security purposes.</p>

<p>If you did not request this change, please contact the MIS Office immediately.</p>

<br>
<p>— Sugar Monitoring System</p>
</body>
</html>