<?php
include_once 'error.php';
include_once 'conn_auth_db-ro.php';

$hw_conn = conectar_db_elprogreso_rw();

// Obtener el nombre de usuario enviado por AJAX
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

function validar_email($hw_conn, $email) {
    // Validar el formato del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error' => 'Formato de email inválido']);
        return;
    }

    // Preparar la consulta para prevenir inyección SQL
    $query = "SELECT COUNT(*) AS count FROM usuario WHERE email = ?";
    if ($stmt = mysqli_prepare($hw_conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            $exists = $count > 0;
        } else {
            $exists = false;
            echo json_encode(['error' => 'Error al ejecutar la consulta']);
        }

        // Enviar el resultado como JSON
        echo json_encode(['exists' => $exists]);

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['error' => 'Error al preparar la consulta']);
    }

    // Cerrar la conexión
    cerrar_db_elprogreso_rw($hw_conn);
}

validar_email($hw_conn, $email);
?>
