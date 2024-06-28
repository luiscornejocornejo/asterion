<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error @yield('code')</title>
    <link rel="stylesheet" href="/css/error.css"> <!-- Tu CSS personalizado -->
</head>
<body>
    <div class="error-container">
        <h1>@yield('code')</h1>
        <p>@yield('message')</p>
        <a href="{{ url('/') }}">Volver al inicio</a>
    </div>
</body>
</html>
