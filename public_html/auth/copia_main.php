<?php
    include_once "php/master.php";

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>El Progreso Deportes</title>
        <link rel="stylesheet" href="../../main/css/main.css"> 

    </head>
    <body>
        <header>
            
        <p class = "register"> <a href="../registro/">Registrarse </a><a href="../auth/">Iniciar Sesión</a></p>
            <h1>El Progreso Deportes</h1>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Productos</a></li>
                <li class="has-submenu">
                    <a href="#">Categorías</a>
                    <ul class="submenu">
                        <li><a href="#">Deportes</a></li>
                        <li><a href="#">Ropa</a></li>
                        <li><a href="#">Accesorios</a></li>
                    </ul>
                </li>
                <li><a href="#">Marcas</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
            
        </header>

        <div class="main-banner">
            <br>
            <br>
            <h1>Bienvenido</h1>
        </div>

        <div class="container">

            <section>
                <h2>Productos Destacados</h2>
                <div class = "producto">
                    <?php mostrar_producto_destacados()?>
                </div>
            </section>


            <section>
                <h2>Todos los Productos</h2>
                <div class = "TodosProductos">
                    <?php mostrar_producto_destacados()?>
                </div>
            </section>

        </div>

        <footer class="footer">
            <p>&copy; 2024 El Progreso Deportes. Todos los derechos reservados.</p>
        </footer>
    </body>
</html>
