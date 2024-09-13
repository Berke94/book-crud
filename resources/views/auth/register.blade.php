<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
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
            max-width: 500px;
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
        .form-container a {
            color: #007bff;
        }
        .form-container a:hover {
            text-decoration: underline;
        }
        .form-container .phone-select {
            max-width: 100px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1 class="text-center">Kayıt Ol</h1>

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

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <x-input-label for="name" :value="__('İsim')" class="fw-bold" />
            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="mb-3">
            <x-input-label for="surname" :value="__('Soyisim')" class="fw-bold" />
            <x-text-input id="surname" class="form-control" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('E-mail')" class="fw-bold" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <x-input-label for="phone" :value="__('Telefon Numarası')" class="fw-bold" />
            <div class="d-flex">
                <!-- Country Code -->
                <select id="country_code" name="country_code" class="form-select phone-select me-2" required>
                    <option value="+90" selected>+90</option>
                    <!-- Add more country codes as needed -->
                </select>

                <!-- Phone Number -->
                <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" required autocomplete="tel" />
            </div>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Şifre')" class="fw-bold" />
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Şifre Tekrarı')" class="fw-bold" />
            <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="btn btn-primary">Kayıt Ol</button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">
                {{ __('Zaten kayıtlı mısınız?') }}
            </a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
