<?php
include_once '../php/dbase_utiles.php';

function obtener_max_id($tabla){
    $hw_conn = connect_db_apprw();
    
    $Query = "SELECT MAX(uuid) AS max_id FROM `$tabla`";
    $result = $hw_conn->query($Query);

    $max_id = null;

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'];
    }
    
    mysqli_free_result($result);
    close_db($hw_conn);

    return $max_id;
}
?>
