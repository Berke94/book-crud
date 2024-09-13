<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border: 1px solid #ddd;
            border-radius: 0.75rem;
            box-shadow: 0 0 1.5rem rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .form-container h1 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: #343a40;
        }
        .form-container .form-label {
            font-weight: bold;
        }
        .form-container button {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1 class="text-center">Giriş Yap</h1>

    <!-- Hata mesajlarını göstermek için -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('E-mail')" class="fw-bold" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Şifre')" class="fw-bold" />
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Şifreni mi unuttun?	') }}
            </a>

            <button type="submit" class="btn btn-primary">
                {{ __('Giriş Yap') }}
            </button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
