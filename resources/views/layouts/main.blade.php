<!-- resources/views/layouts/main.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles') <!-- Diğer stil dosyaları için -->
</head>
<body>
@include('partials.navbar')

<div class="container mt-4">
    @yield('content')
</div>

@include('layouts.scripts') <!-- Burada scriptleri dahil ediyoruz -->
@stack('scripts') <!-- Diğer script dosyaları için -->
</body>
</html>
