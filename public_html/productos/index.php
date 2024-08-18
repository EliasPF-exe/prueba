<?php

    include_once 'php/error.php';
    include_once "php/cat.php";

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cargar Productos</title>
        <link rel="stylesheet" href="css/estilo.css">
        <script src="js/jquery-3.7.1.js" type="text/javascript"></script>
        <script src="js/validar.js" type="text/javascript"></script>
    </head>
    <body>
        <head>

        </head>
        <nav>

        </nav>
        <main>
            
            <section class="formulario_registro">
            <h2>Gargar Productos</h2>
            <div class="form-container">
                <form method="POST" onsubmit="return registro()">
                    <div class="campoFormulario">
                        <label for="nombre">Nombre: <span class="obligatorio">*</span></label>
                        <input type='text' id="nombre" name="nombre" maxlength="50" autocomplete="off"/>
                        <label for="nombre"></label>
                    </div>
                    <div class="campoFormulario">
                        <label for="descripcion">Descripción: </label>
                        <input type='text' id="descripcion" name="descripcion" maxlength="300"/>
                    </div>
                    <div class="campoFormulario">
                        <label for="categoria">Categoria: <span class="obligatorio">*</span></label>
                        <?php 
                            echo obtener_categorias(); 
                        ?>
                    </div>
                    <div class="campoFormulario">
                        <label for="marca">Marca: <span class="obligatorio">*</span></label>
                        <?php 
                            echo obtener_marcas(); 
                        ?>
                    </div>
                    
                    <div>
                    <label for="categoria">Proveedor: <span class="obligatorio">*</span></label>
                        <?php 
                            echo obtener_proveedores(); 
                        ?>
                    </div>
                    <p></p>
                    <div class="campoFormulario">
                        <label for="codBarras">Código de Barras: <span class="obligatorio">*</span></label>
                        <input type='text' id="codBarras" name="codBarras" maxlength="20"/>
                    </div>
                    <div class="campoFormulario">
                        <label for="precio">Precio de Venta: </label>
                        <input type='text' id="precio" name="precio" maxlength="10"/>
                    </div>
                    <div class="campoFormulario">
                        <label for="stock">Stock: <span class="obligatorio">*</span></label>
                        <input class = "styock" type="number" id="stock" name="stock" min="0" max="10" step="1" required />

                    </div>
                    <div class="campoFormulario">
                        <label for="modelo">Modelo:</label>
                        
                    </div>

                    <div class="botonFormulario">
                        <input type="submit" id="registrar" name="registrar" value="Registrarse"> 
                    </div>  
                </form>
            </div>

        <!-- onblur="return validarNombreUsuario(this.value)" -->

            </section>

            <div id="miDiv">
  <!-- Aquí se agregará el contenido desde JavaScript -->
        </div>
        </footer>

        </main>
        <footer>


    </body>
</html>