<?php
session_start();

// Verifica si ya existe una sesión de usuario activa
if (isset($_SESSION['username'])) {
    // Si existe, redirige al usuario a la página principal o a donde desees
    header("Location: ../../main/index.php");
    exit();
}

// Aquí iría el código para mostrar el formulario de inicio de sesión
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Autenticación</title>
        <script src="js/jquery-3.7.1.js" type="text/javascript"></script>
        <script src="js/validar_i.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>

        <header>
        
        <h1>El Progreso Deportes</h1>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="#">Categorías</a></li>
                <li><a href="#">Marcas</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
            
        </nav>
        </header>

        <main>
            <section class="formulario_registro">
            <h1>Formulario inicio sesion</h1>
            <div class="form-container">
                <form method="POST" action="php/sesion_start.php">
                    <div class="campoFormulario">
                        <label for="usuario">Usuario: <span class="obligatorio">*</span></label>
                        <input type='text' id="usuario" name="usuario" maxlength="15" value="<?php echo $usuario ?>" onblur="return validarNombreUsuario(this.value)"/>
                        <label for="usuario"></label>
                    </div>
                    <div class="campoFormulario">
                        <label for="password">Contraseña: <span class="obligatorio">*</span></label>
                        <input type='password' id="password" name="password" maxlength="20" value="<?php echo $password ?>" onblur="return validarPassword(this.value)"/>
                    </div>

                    <div class="botonFormulario">
                        <input type="submit" id="registrar" name="registrar" value="Inicio sesion" > 
                    </div>  
                    <p> <a href="../registro/">Registrarse </a></p>
                </form>
                
            </div>

            

            </section>

            <div id="miDiv">
  <!-- Aquí se agregará el contenido desde JavaScript -->
        </div>
        </footer>

        </main>
        <footer>


    </body>
</html>