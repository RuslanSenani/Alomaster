<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Doğrulama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header h1 {
            color: #333333;
        }
        .email-body {
            text-align: center;
            line-height: 1.6;
        }
        .email-body p {
            margin: 10px 0;
            color: #555555;
        }
        .email-button {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Alo Master</h1>
        <p>E-poçt doğrulaması tələb olunur</p>
    </div>

    <div class="email-body">
        <p>Hörmətli {{ $user->full_name }},</p>
        <p>E-poçt ünvanınızı doğrulamaq üçün aşağıdakı düyməyə klikləyin:</p>
        <a href="{{ url('email/verify/'.$user->email_token) }}" class="email-button">E-poçt Doğrulama</a>
        <p>Əgər siz bu e-poçt doğrulamasını tələb etməmisinizsə, bu mesajı nəzərə almayın.</p>
    </div>
    <div class="email-footer">
        <p>© {{ date('Y') }} Alo Master. Bütün hüquqlar qorunur.</p>
    </div>
</div>
</body>
</html>
