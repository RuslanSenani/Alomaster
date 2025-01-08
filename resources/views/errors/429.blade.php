<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Too Many Requests</title>
</head>
<body>
<div style="text-align: center; margin-top: 50px;">
    <h1 style="font-size: 72px; color: #FF5733;">429</h1>
    <h2>Too Many Requests</h2>
    <p>You've made too many requests in a short period. Please try again later.</p>
    <p>We are limiting your login attempts to protect your account. Please wait for {{ ceil($retryAfter/60) }} minutes and try again.</p>
    <a href="{{ url('/') }}" style="text-decoration: none; color: #008CBA;">Back to Home</a>
</div>
</body>
</html>
