<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi App')</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0d1117;
            color: #e6edf3;
            display: flex;
        }

        
        .left-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 80px;
            height: 100vh;
            background: #161b22;
            z-index: 900;
            display: flex;
            flex-direction: column;  
            justify-content: flex-start;
            align-items: center;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.4);
        }

        /* BOTÓN HAMBURGUESA */
        .toggle-btn {
            background: #1f6feb;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 5px;
        }

        .logout-btn {
            background: #1f6feb;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 15px;
            border-radius: 5px;
            margin-top: auto;          
            margin-bottom: 60px;
        }

        
        .sidebar {
            width: 250px;
            background: #161b22;
            height: 100vh;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 80px;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 10px rgba(0,0,0,0.4);
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .close-btn {
            background: none;
            border: none;
            color: #e6edf3;
            font-size: 28px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .content {
            margin-left: 80px;
            padding: 30px;
            width: 100%;
            transition: margin-left 0.3s;
        }

        .content.expanded {
            margin-left: 330px; /* 80 + 250 */
        }

        .sidebar a {
            display: block;
            color: #58a6ff;
            margin: 15px 0;
            text-decoration: none;
            font-size: 18px;
        }

        .sidebar a:hover {
            color: #1f6feb;
        }
    </style>

</head>
<body>

<!-- BARRA IZQUIERDA -->
<div class="left-bar">
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <button class="logout-btn">Salir</button>
</div>

<!-- SIDEBAR -->
<div class="sidebar hidden" id="sidebar">
    <button class="close-btn" onclick="toggleSidebar()">✕</button>

    <h2 style="text-align: center;">Swapin</h2>

    <a href="#">Inicio</a>
    <a href="#">Productos</a>
    <a href="#">Usuarios</a>
    <a href="#">Configuración</a>
</div>

<!-- CONTENIDO -->
<div class="content" id="content">
    @yield('content')
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");

        sidebar.classList.toggle("hidden");
        content.classList.toggle("expanded");
    }
</script>

</body>
</html>
