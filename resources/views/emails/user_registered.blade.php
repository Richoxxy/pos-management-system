<!-- resources/views/emails/user_registered.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our POS Application</title>
</head>
<body>
    <h1>Hello, {{ $userName }}!</h1>
    <p>Thank you for registering with us. Your email is {{ $userEmail }}.</p>
</body>
</html>
