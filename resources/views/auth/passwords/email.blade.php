
    <!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifrəmi Sıfırla</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            transition: box-shadow 0.3s ease-in-out;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <h2 class="text-center mb-4">Şifrəmi Sıfırla</h2>

        @if(session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Email Alanı -->
        <div class="form-group mb-4">
            <label for="email" class="form-label">E-mail Adresi</label>
            <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                placeholder="E-mail adresinizi girin">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Gönder Butonu -->
        <button type="submit" class="btn btn-primary w-100">
            Şifrəmi Sıfırla
        </button>
    </form>
</div>

</body>
</html>
