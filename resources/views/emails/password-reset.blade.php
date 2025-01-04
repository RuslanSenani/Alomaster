<!DOCTYPE html>
<html>
<head>
    <title>Hesabınıza Giriş Bərpa Edin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 16px;
            margin: 20px 0;
        }

        .button:hover {
            background-color: #45a049;
        }

        p {
            line-height: 1.6;
            color: #555555;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888888;
        }

        .social-icons img {
            width: 30px;
            margin: 0 5px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">

{{--    <div style="text-align: center;">--}}
{{--        <img src="{{ asset('assets/dist/img/alomasterLogo.svg') }}" alt="Alomaster Logo" style="max-width: 150px;">--}}
{{--    </div>--}}

    <h1>Hesabınıza Giriş Bərpa Edin</h1>
    <p>Salam {{ $username }},</p>
    <p>Parolunuzu sıfırlamaq üçün aşağıdakı düyməyə klikləyin. Yeni parol təyin etməklə hesabınıza yenidən giriş əldə
        edə bilərsiniz.</p>
    <a href="{{ $resetUrl }}" class="button">Şifrəmi Dəyişdir</a>
    <p>Bu keçid yalnız <strong>{{ $expiredAt }}</strong> tarixinə qədər etibarlıdır.</p>
    {{--    <p>Əgər kömək lazımdırsa, xahiş edirəm <a href="https://www.example.com/support">dəstək komandamızla</a> əlaqə saxlayın.</p>--}}
    <p>Hörmətlə,<br>
        <strong>{{ config('app.name') }}</strong>
    </p>
    <div class="social-icons">
        <p>Bizi sosial mediada izləyin:</p>
        <a href="https://www.instagram.com/alomaster.com_/">
            <img src="https://yourdomain.com/assets/icons/instagram.png" alt="Instagram">
        </a>
        <a href="https://www.youtube.com/@Alo_Master">
            <img src="https://yourdomain.com/assets/icons/youtube.png" alt="YouTube">
        </a>
        <a href="https://www.tiktok.com/@_alomaster_">
            <img src="https://yourdomain.com/assets/icons/tiktok.png" alt="TikTok">
        </a>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Bütün hüquqlar qorunur.</p>
    </div>
</div>
</body>
</html>

