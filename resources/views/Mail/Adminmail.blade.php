<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created</title>
</head>
<body style="font-family: 'Arial', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
        <h1 style="color: #3498db; text-align: center;">Welcome to Blue Owl!</h1>
        <p style="color: #555555; line-height: 1.6; text-align: justify;">Dear {{ ucfirst($data['username']) }},</p>

        <p style="color: #555555; line-height: 1.6; text-align: justify;">Your account has been successfully created. Here are your account details:</p>

        <ul style="list-style: none; padding: 0;">
            <li style="margin-bottom: 10px;"><strong>Email:</strong>{{$data['email']}}</li>
            <li style="margin-bottom: 10px;"><strong>Username:</strong>{{$data['email']}}</li>
        </ul>

        <p style="color: #555555; line-height: 1.6; text-align: justify;">To set your custom password and complete your account setup, click the button below:</p>

        <a href="{{ $data['url'] }}" style="display: inline-block; padding: 12px 20px; background-color: #3498db; background-color:#3498db; color: #ffffff; text-decoration: none; border-radius: 5px;">Set Password</a>

        <div style="color: #777777; font-size: 14px; margin-top: 20px;">
            <p>Alternatively, you can log in to your account using the default password provided below. Remember to change your password after logging in for security reasons.</p>
        </div>

        <ul style="list-style: none; padding: 0;">
            <li style="margin-bottom: 10px;"><strong>Default Password:</strong>{{$data['defautpassword']}}</li>
        </ul>

        <p style="color: #555555; line-height: 1.6; text-align: justify;">If you did not create an account or have any questions, please contact our support team at [support@example.com].</p>

        <div style="text-align: center; margin-top: 30px;">
            <p>Best regards,<br>Blue Owl</p>
        </div>
    </div>
</body>
</html>
