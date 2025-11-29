<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0d1117;
            color: #e6edf3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #161b22;
            padding: 40px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.4);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #58a6ff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #e6edf3;
            font-size: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #30363d;
            background: #0d1117;
            color: #e6edf3;
            font-size: 16px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1f6feb;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #1f6feb;
            border: none;
            color: #fff;
            font-size: 18px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-btn:hover {
            background: #388bff;
        }

        .extra-links {
            margin-top: 15px;
            text-align: center;
        }

        .extra-links a {
            color: #58a6ff;
            text-decoration: none;
            font-size: 14px;
        }

        .extra-links a:hover {
            color: #1f6feb;
        }
    </style>

</head>
<body>

    <div class="login-container">
        <h2>Swapin</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="Ingresa tu correo" required>
            </div>

            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>

            <button class="login-btn" type="submit">Entrar</button>

            <div class="extra-links">
                <a href="{{ route('registro') }}">Registrate</a> <br>
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>

</body>
</html>
