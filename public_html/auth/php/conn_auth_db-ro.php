<?php
    function conectar_db_elprogreso_rw(){
        include_once "../../php/dbase_utiles.php";
        /* Codigo anterior a el nuevo archivo de conn db 
        //echo "valores:", $host, $username, $password, $database;

        // Crear conexión
        $hw_conn = new mysqli($host, $username, $password, $database);

        // Verificar la conexión
        if ($hw_conn->connect_error) {
            die("Error de conexión: " . $hw_conn->connect_error);
        }*/
        $hw_conn = connect_db_authrw();
        return $hw_conn;

    }

    function cerrar_db_elprogreso_rw($conn){
        // Cerrar la conexión
        close_db($conn);
    }

?>