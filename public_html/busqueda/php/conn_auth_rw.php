<?php
    function conectar_db_elprogreso_rw(){


        include_once "/home/administrador/www/public_html/php/conn_rw-dbase.php";

        // echo "valores:", $host, $username, $password, $database;

        // Crear conexión
        $hw_conn = new mysqli($host, $username, $password, $database);

        // Verificar la conexión
        if ($hw_conn->connect_error) {
            die("Error de conexión: " . $hw_conn->connect_error);
        }
        

        return $hw_conn;

    }

    function cerrar_db_elprogreso_rw($conn){
        // Cerrar la conexión
        $conn->close();
    }

?>