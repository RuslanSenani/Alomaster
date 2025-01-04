<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifrəni Sıfırla</title>
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

        .password-strength {
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <h2 class="text-center mb-4">Şifrəni Sıfırla</h2>

        @if(session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group mb-3">
            <label for="email" class="form-label">E-mail Adresi</label>
            <input
                id="email"
                type="email"
                class="form-control  @error('email') is-invalid @enderror"
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


        <div class="form-group mb-3">
            <label for="password" class="form-label">Yeni Şifrə</label>
            <div class="input-group">
                <input
                    id="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Yeni şifrə"
                    oninput="checkPasswordStrength()">
                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password')">
                    Göster
                </button>
            </div>
            <div id="password-strength" class="password-strength text-muted"></div>
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="password_confirmation" class="form-label">Şifrəni Təkrar Girin</label>
            <div class="input-group">
                <input
                    id="password_confirmation"
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Şifrəni təkrar girin">
                <button type="button" class="btn btn-outline-secondary"
                        onclick="togglePasswordVisibility('password_confirmation')">
                    Göster
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Şifrəni Sıfırla
        </button>
    </form>
</div>

<script>
    function checkPasswordStrength() {
        const strengthText = document.getElementById('password-strength');
        const password = document.getElementById('password').value;

        if (password.length < 8) {
            strengthText.textContent = 'Zəif şifrə';
            strengthText.style.color = 'red';
        } else if (password.length >= 8 && password.length < 10) {
            strengthText.textContent = 'Orta şifrə';
            strengthText.style.color = 'orange';
        } else {
            strengthText.textContent = 'Güclü şifrə';
            strengthText.style.color = 'green';
        }
    }

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>

</body>
</html>
