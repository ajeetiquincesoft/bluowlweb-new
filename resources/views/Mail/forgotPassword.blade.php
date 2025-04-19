<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['title'] }}</title>
</head>
<body>
    <h2>Hello {{ $data['username'] }},</h2>
    <p>{{ $data['body'] }}</p>
    <p><a href="{{ $data['url'] }}">Click here to reset your password</a></p>
    <br>
    <p>Regards,<br>Team Blue Owl</p>
</body>
</html>
