<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi App')</title>

    <!-- Estilos minimalistas -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background: white;
            padding: 15px 25px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.1);
        }

        main {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.08);
        }

        .title {
            font-size: 24px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<header>
    <strong>Mi App</strong>
</header>

<main>
    @yield('content')
</main>

<footer>
    <small>© {{ date('Y') }} - Laravel Minimal</small>
</footer>

</body>
</html>
