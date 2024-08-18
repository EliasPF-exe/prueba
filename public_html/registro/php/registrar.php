<?php
include_once 'conn_auth_db-ro.php'; // Incluye el archivo con la función de conexión

$hw_conn_auth = conectar_auth_db(); // Conexión a la base de datos de autenticación
$hw_conn = conectar_db_elprogreso_rw(); // Conexión a la base de datos principal

// Obtener la información enviada por AJAX
$info = isset($_POST['info']) ? trim($_POST['info']) : '';
$cadenaInfo = explode(",", $info);

// Inicializar el resultado
$response = [];

if (count($cadenaInfo) === 8) { // Asegúrate de que los datos están completos
    // Crear la consulta SQL con sentencias preparadas para la tabla usuario
    $query = "INSERT INTO usuario (nombre, apellido, email, estado, creado, modificado, telefono, genero, fecha_nacimiento)
              VALUES (?, ?, ?, '1', NOW(), NOW(), ?, ?, ?)";
    
    if ($stmt = $hw_conn->prepare($query)) {
        // Enlazar los parámetros con los valores
        $stmt->bind_param(
            'ssssss',
            $cadenaInfo[1], // nombre
            $cadenaInfo[2], // apellido
            $cadenaInfo[0], // email
            $cadenaInfo[5], // telefono
            $cadenaInfo[3], // genero
            $cadenaInfo[4]  // fecha_nacimiento
        );
                
        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Insertar también en la tabla auth
            $auth_result = cargar_auth($hw_conn_auth, $cadenaInfo[6], $cadenaInfo[7], $cadenaInfo[0]);

            if ($auth_result['success']) {
                $response['success'] = true;
            } else {
                $response['error'] = $auth_result['error'];
            }
        } else {
            $response['error'] = 'Error al insertar el usuario: ' . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        $response['error'] = 'Error en la preparación de la consulta: ' . $hw_conn->error;
    }
} else {
    $response['error'] = 'Datos incompletos';
}

// Cerrar la conexión
mysqli_close($hw_conn);
mysqli_close($hw_conn_auth);

// Devolver la respuesta JSON
echo json_encode($response);

function cargar_auth($hw_conn_auth, $username, $password, $email) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $response = [];

    // Crear la consulta SQL con sentencias preparadas para la tabla auth
    $query = "INSERT INTO auth (username, password, email, rol, estado, creado, modificado)
              VALUES (?, ?, ?, 'usuario', '1', NOW(), NOW())";
    
    if ($stmt = $hw_conn_auth->prepare($query)) {
        // Enlazar los parámetros con los valores
        $stmt->bind_param(
            'sss',
            $username,         // Username
            $hashed_password,  // Contraseña hasheada
            $email             // Email
        );
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Error al insertar en la tabla auth: ' . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        $response['error'] = 'Error en la preparación de la consulta auth: ' . $hw_conn_auth->error;
    }

    return $response;
}
?>