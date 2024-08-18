
<?php
    include_once 'conn_db_apprw.php';

    $hw_conn = conectar_db_elprogreso_rw();

    // Obtener el nombre de usuario enviado por AJAX
    $username = $_POST['username'];

    $Query = "SELECT COUNT(*) AS username FROM auth WHERE username = '$username'";
    $result = mysqli_query($hw_conn, $Query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $exists = $row['count'] > 0;
    } else {
        $exists = false;
    }

    // Devolver el resultado como JSON
    echo json_encode(['exists' => $exists]);

    cerrar_db_elprogreso_rw($hw_conn)

?>