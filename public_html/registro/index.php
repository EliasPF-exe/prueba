<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Autenticación</title>
        <link rel="stylesheet" href="css/estilo.css">
        <script src="js/jquery-3.7.1.js" type="text/javascript"></script>
        <script src="js/validar.js" type="text/javascript"></script>
    </head>
    <body>

        <header>
        <h1>El Progreso Deportes</h1>

        </header>

        <main>
            <section class="formulario_registro">
            <h2 class = "main-baner">Formulario registro</h2>
            <div class="form-container">
                <form method="POST" onsubmit="return registro(event)">
                    <div class="campoFormulario">
                        <label for="usuario">Usuario: <span class="obligatorio">*</span></label>
                        <input type='text' id="usuario" name="usuario" maxlength="15" value="<?php echo $usuario ?>" onblur="return validarNombreUsuario(this.value)" required/>
                        <label for="usuario"></label>
                    </div>
                    <div class="campoFormulario">
                        <label for="password">Contraseña: <span class="obligatorio">*</span></label>
                        <input type='password' id="password" name="password" maxlength="20" value="<?php echo $password ?>" onblur="return validarPassword(this.value)"required/>
                    </div>
                    <div class="campoFormulario">
                        <label for="password2">Repita la Contraseña: <span class="obligatorio">*</span></label>
                        <input type='password' id="password2" name="password2" maxlength="20" value="<?php echo $password2 ?>" onblur="return validarPasswordIguales(password.value,this.value)"required/>
                    </div>
                    <div class="campoFormulario">
                        <label for="email">Email: <span class="obligatorio">*</span></label>
                        <input type='text' id="email" name="email" maxlength="50" value="<?php echo $email ?>" onblur="return validarEmail(this.value)"required/>
                    </div>
                    <div class="campoFormulario">
                        <label for="nombre">Nombre:</label>
                        <input type='text' id="nombre" name="nombre" maxlength="20" value="<?php echo $nombre ?>" onblur="return validarNombre(this.value)"required/>
                    </div>
                    <div class="campoFormulario">
                        <label for="apellidos">Apellidos:</label>
                        <input type='text' id="apellidos" name="apellidos" maxlength="30" value="<?php echo $apellidos ?>" onblur="return validarApellidos(this.value)"required/>
                    </div>
                    <div class="campoFormulario">
                        <label for="genero">Genero:</label>
                        <select class = "genero" id="genero" name="genero" value="<?php echo $apellidos ?>" onblur="return validarGenero(this.value)">
                            <option value="F">Femenino</option>
                            <option value="M">Maculino</option>
                            <option value="O">Otro</option>
                        </select>
                    </div>
                    <div class="campoFormulario">
                        <label for="edad">Fecha de Nacimiento:</label>
                        <input type='date' id="birthday" name="birthday" value="<?php echo $fecha ?>" onblur="return validarFecha(this.value)"required/>
                    </div>
                    <div class="campoFormulario">
                        <label for="teléfono">Telefono: <span class="obligatorio">*</span></label>
                        <input type='text' id="telefono" name="telefono" maxlength="18" value="<?php echo $telefono ?>" onblur="return validarTelefono(this.value)" required/>
                    </div>

                    <div class="botonFormulario">
                        <input type="submit" id="registrar"disabled name="registrar" value="Registrarse" required> 
                    </div>  
                </form>
            </div>
            </section>
        </main>
        <footer class="footer">
        <p>&copy; 2024 El Progreso Deportes. Todos los derechos reservados.</p>
        </footer>
    </body>
</html>