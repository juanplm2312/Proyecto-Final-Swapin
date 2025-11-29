<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

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

        .register-container {
            background: #161b22;
            padding: 40px;
            width: 380px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.4);
        }

        .register-container h2 {
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

        /* Campo en error */
        .input-error {
            border-color: #ff4d4d !important;
        }

        .error-text {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 5px;
        }

        .register-btn {
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

        .register-btn:hover {
            background: #388bff;
        }

        .extra-links {
            margin-top: 15px;
            text-align: center;
        }

        .extra-links a {
            color: #58a6ff;
            text-decoration: none;
        }

        .extra-links a:hover {
            color: #1f6feb;
        }

        .alert-error {
            background: #441c1c;
            color: #ffb4b4;
            border: 1px solid #6b0000;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="register-container">
        <h2>Crear cuenta</h2>

        {{-- Mostrar errores generales --}}
        @if ($errors->any())
            <div class="alert-error">
                ⚠️ Corrige los errores antes de continuar.
            </div>
        @endif

        <form action="{{ route('registro.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Correo:</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="@error('email') input-error @enderror"
                    placeholder="Ingresa tu correo" 
                    required>
                
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Nombre:</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    class="@error('name') input-error @enderror"
                    placeholder="Ingresa tu nombre" 
                    required>

                @error('name')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Contraseña:</label>
                <input 
                    type="password" 
                    name="password" 
                    class="@error('password') input-error @enderror"
                    placeholder="Crea una contraseña" 
                    required>

                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <button class="register-btn" type="submit">Registrarse</button>

            <div class="extra-links">
                <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </form>
    </div>

</body>
</html>
