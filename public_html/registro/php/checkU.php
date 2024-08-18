<?php
include_once 'error.php';
include_once 'conn_auth_db-ro.php';


$hw_conn = conectar_auth_db();


// Obtener el nombre de usuario enviado por AJAX
$username = isset($_POST['nombreUsuario']) ? trim($_POST['nombreUsuario']) : '';


function validar_usuario($hw_conn, $username) {
   // Validar el formato del nombre de usuario en el servidor
   if (!preg_match('/^[a-zA-Z0-9_-]{4,15}$/', $username)) {
       echo json_encode(['error' => 'Formato de nombre de usuario inválido']);
       return;
   }


   // Preparar la consulta para prevenir inyección SQL
   $query = "SELECT COUNT(*) AS count FROM auth WHERE username = ?";
   $stmt = mysqli_prepare($hw_conn, $query);
   mysqli_stmt_bind_param($stmt, "s", $username);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);


   $exists = false;


   if ($result) {
       $row = mysqli_fetch_assoc($result);
       $count = $row['count'];
      
       if ($count > 0) {
           $exists = true;
       }
   }


   // Enviar el resultado como JSON
   echo json_encode(['exists' => $exists]);


   // Cerrar la conexión
   mysqli_stmt_close($stmt);
   cerrar_db_elprogreso_rw($hw_conn);
}


validar_usuario($hw_conn, $username);
?>
