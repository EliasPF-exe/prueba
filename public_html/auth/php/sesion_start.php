<?php
include_once 'error.php';
include_once 'conn_auth_db-ro.php';
include_once '../../main/php/users_conn.php';
session_set_cookie_params([
    'lifetime' => 360*12*30*60*50,        // Duración de la cookie en segundos
    'path' => '/',
    'domain' => '.example.com',
    'secure' => true,          // Solo para HTTPS
    'httponly' => true         // No accesible vía JavaScript
]);
session_start();
if (isset($_SESSION['usuario'])) {
    // Si la sesión está activa
    echo "La sesión está abierta. Usuario: " . $_SESSION['usuario'];
} else {
    // Si no hay sesión activa
    echo "No hay sesión iniciada.";
}




$hw_conn = conectar_db_elprogreso_rw();

if ($hw_conn->connect_error) {
    die("Conexión fallida: " . $hw_conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario
    $stmt = $hw_conn->prepare("SELECT password FROM auth WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            
            $_SESSION['username'] = $username;

            header("Location: ../../main/index.php"); // Redirigir a la página principal
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
        header("Location: ../index.php?error=" . urlencode($error));
    }

    $stmt->close();
    $hw_conn->close();

    // Redirigir al formulario de login con un mensaje de error
    header("Location: ../index.php?error=" . urlencode($error));
    exit();
}

?>