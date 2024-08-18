<?php
    require_once 'credenciales.php';

    // Conectar a auth con SELECT
    function connect_db_authro() {
        $creds = get_db_authro_credentials();
        $conn = mysqli_connect($creds['db_host'], $creds['db_user'], $creds['db_pass'], $creds['db_name']);
        
        if (!$conn) {
            error_log(mysqli_connect_error());
            die("Error de conexión: " . mysqli_connect_error());
        }
        
        return $conn;
    }

    // Conectar a auth con ALL
    function connect_db_authrw() {
        $creds = get_db_authrw_credentials();
        $conn = mysqli_connect($creds['db_host'], $creds['db_user'], $creds['db_pass'], $creds['db_name']);
        
        if (!$conn) {
            error_log(mysqli_connect_error());
            die("Error de conexión: " . mysqli_connect_error());
        }
        
        return $conn;
    }

    // Conecar a dbase_elprogreso con ALL
    function connect_db_apprw() {
        $creds = get_db_apprw_credentials();
        $conn = mysqli_connect($creds['db_host'], $creds['db_user'], $creds['db_pass'], $creds['db_name']);
        
        if (!$conn) {
            error_log(mysqli_connect_error());
            die("Error de conexión: " . mysqli_connect_error());
            
        }   
        
        return $conn;
    }


    function close_db($conn) {
        if ($conn) {
            mysqli_close($conn);
        }
    }


?>













