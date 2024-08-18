<?php
// Configuración de la base de datos
$servername = "localhost";
$dbusername = "elprogreso";
$dbpassword = "NqtZpq4vKl4SxIiNAj0KUaHa";
$dbname = "dbase_elprogreso";

// Crear conexión
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de los campos del formulario
    $errores = [];

    if (empty($_POST['nombre'])) {
        $errores[] = "El campo 'Nombre' es obligatorio.";
    }
    
    if (empty($_POST['apellido'])) {
        $errores[] = "El campo 'Apellido' es obligatorio.";
    }
    
    if (empty($_POST['dni']) || !preg_match('/^\d{8}$/', $_POST['dni'])) {
        $errores[] = "El campo 'DNI' es obligatorio y debe contener exactamente 8 dígitos.";
    }
    
    if (empty($_POST['gmail']) || !filter_var($_POST['gmail'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El campo 'Correo' es obligatorio y debe ser un correo electrónico válido.";
    }
    
    if (empty($_POST['contraseña'])) {
        $errores[] = "El campo 'Contraseña' es obligatorio.";
    }
    
    if (empty($_POST['telefono']) || !preg_match('/^\d{10}$/', $_POST['telefono'])) {
        $errores[] = "El campo 'Teléfono' es obligatorio y debe tener 10 dígitos.";
    }
    
    if (empty($_POST['direccion'])) {
        $errores[] = "El campo 'Dirección' es obligatorio.";
    }

    // Si hay errores, los mostramos
    if (!empty($errores)) {
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } else {
        // Obtener datos del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $gmail = $_POST['gmail'];
        $contraseña = $_POST['contraseña'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        // Verificar si el correo ya existe
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<p>El correo electrónico ya está registrado.</p>";
        } else {
            // Cifrar la contraseña
            $hashed_password = password_hash($contraseña, PASSWORD_BCRYPT);

            // Insertar el nuevo usuario
            $sql = "INSERT INTO usuario (nombre, apellido, email, contraseña) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $apellido, $gmail, $hashed_password);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<p>¡Registro exitoso!</p>";
                // Aquí podrías redirigir a otra página o realizar alguna otra acción
            } else {
                echo "<p>Error al registrar el usuario.</p>";
            }

            $stmt->close();
        }
    }
} else {
    echo "Método no permitido.";
}

// Cerrar la conexión
$conn->close();
?>
