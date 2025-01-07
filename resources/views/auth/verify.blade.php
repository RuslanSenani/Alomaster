<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-poçt Doğrulaması</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .alert {
            padding: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
            margin-bottom: 15px;
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            text-align: center;
        }

        .content p {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }

        .btn-primary {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>E-poçt Doğrulaması</h1>
    </div>

    <div class="content">
        @if (session('resent'))
            <div class="alert">
                {{ __('E-poçt ünvanınıza yeni doğrulama linki göndərildi, Zəhmət omasa E-poçtunuzu yoxlayın.') }}
            </div>
        @endif

        <p>{{ __('Davam etməzdən əvvəl e-poçt ünvanınızdakı doğrulama linkini yoxlayın..') }}</p>
        <p>{{ __('Əgər E-poçt almamısınızsa') }}:</p>

        <form method="POST" action="{{ route('resendVerificationEmail') }}">
            @csrf
            <button type="submit" class="btn-primary">
                {{ __('Başqa bir keçid göndərmək üçün klikləyin') }}
            </button>
        </form>
    </div>

    <div class="footer">
        <p>{{ __('Yardım üçün bizimlə əlaqə saxlaya bilərsiniz..') }}</p>
        <p>{{ __('055 396 79 44') }}</p>
    </div>
</div>
</body>
</html>
