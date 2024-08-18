<?php
    include_once "php/master.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Progreso Deportes</title>
    <link rel="stylesheet" href="css/main.css"> 
</head>
<body>
    <div class="sidebar" id="sidebar">
        <button class="closebtn" onclick="closeSidebar()">×</button>
        <br><br>
        <?php if (!isset($_SESSION['username'])): ?>
            <h2>Debes iniciar sesión para acceder al carrito</h2>
        <?php else: ?>
            <h2>Carrito de Compras</h2>
            <p>Contenido del carrito...</p>
        <?php endif; ?>
    </div>

    <header>
        <p class="register">
            <?php if (!isset($_SESSION['username'])): ?>
                <a href="../registro/">Registrarse</a>
                <a href="../auth/">Iniciar Sesión</a>
            <?php else: ?>
                <span>Cuenta <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="php/logout.php">Cerrar Sesión</a>
            <?php endif; ?>
        </p>
        <h1>El Progreso Deportes</h1>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li class="has-submenu">
                    <a href="#">Categorías</a>
                    <ul class="submenu">
                        <?php echo obtener_categorias(); ?>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#">Marcas</a>
                    <ul class="submenu">
                        <?php echo obtener_marcas(); ?>
                    </ul>
                </li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
        <button class="btn-carrito" onclick="toggleSidebar()">
            <img src="img/car3.png" alt="Carrito">
        </button>
    </header>

    <div class="main-banner">
        <br><br>
        <h1>Bienvenido <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    </div>

    <div class="container">
        <section>
            <h2>Productos Destacados</h2>
            <div class="producto">
                <?php mostrar_producto_destacados(); ?>
            </div>
        </section>

        <section>
            <h2>Todos los Productos</h2>
            <div class="TodosProductos">
                <?php mostrar_producto_destacados(); ?>
            </div>
        </section>
    </div>

    <footer class="footer">
        <p>&copy; 2024 El Progreso Deportes. Todos los derechos reservados.</p>
    </footer>
    <script src="js/main.js"></script>
</body>
</html>
