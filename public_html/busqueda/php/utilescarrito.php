<?php
include_once "conn_auth_rw.php";

if(isset($_POST['query'])){
    $hw_conn = conectar_db_elprogreso_rw();
    $search = $_POST['query'];
    $marca = $_POST['marca']; // Valor de la marca a filtrar
    $descripcion = $_POST['descripcion']; // Valor de la descripción a filtrar

    $Query = "SELECT * FROM aux_producto WHERE 1=1";

    if(!empty($search)){
        $Query .= " AND nombre LIKE '%$search%'";
    }

    $result = $hw_conn->query($Query);

    if (!empty($search) && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p>" . $row['nombre'] . "</p>";
        }
    } else {
        echo "No se encontraron resultados";
    }
}

?>