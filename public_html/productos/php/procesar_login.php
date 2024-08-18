<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de los campos del formulario
    $errores = [];

    if (empty($_POST['nombre'])) {
        $errores[] = "El campo 'Usuario' es obligatorio.";
    }
    
    if (empty($_POST['contraseña'])) {
        $errores[] = "El campo 'Contraseña' es obligatorio.";
    }

    // Usuario y contraseña predeterminados
    $admin_username = "admin";
    $admin_password = "admin";

    // Validar las credenciales del administrador
    if ($_POST['nombre'] === $admin_username && $_POST['contraseña'] === $admin_password) {
        // Inicio de sesión exitoso, redirigir a pagina_principal.php
        header("Location: ../../main/index.php");
        exit(); // Asegura que no se siga ejecutando el script después de la redirección
    } elseif (!empty($errores)) {
        // Si hay errores, los mostramos
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } else {
        // Si no hay errores pero las credenciales no son correctas
        echo "<p>Usuario o contraseña incorrectos.</p>";
    }
} else {
    echo "Método no permitido.";
}
?>
