<?php
       
    // Funcion para obtener la crdenciales para acceso solo SELECT a auth
    function get_db_authro_credentials() {
        $ini_file = '/home/administrador/www/privado/auth-ro-conn.ini';
        if (!file_exists($ini_file)) {
            die("El archivo de configuración no existe: $ini_file");
        }
        
        $config = parse_ini_file($ini_file);
        if ($config === false) {
            die("Error al leer el archivo de configuración");
        }
        
        return [
            'db_host' => $config['host'],
            'db_user' => $config['username'],
            'db_pass' => $config['password'],
            'db_name' => $config['database']
        ];
    }

    // Funcion para obtener la crdenciales para acceso solo ALL(TOTAL) a auth
    function get_db_authrw_credentials() {
        $ini_file = '/home/administrador/www/privado/auth-rw-conn.ini';
        if (!file_exists($ini_file)) {
            die("El archivo de configuración no existe: $ini_file");
        }
        $config = parse_ini_file($ini_file);
        if ($config === false) {
            die("Error al leer el archivo de configuración");
        }
        return [
            'db_host' => $config['host'],
            'db_user' => $config['username'],
            'db_pass' => $config['password'],
            'db_name' => $config['database']
        ];
    }
    
    // Funcion para obtener la crdenciales para acceso solo ALL(TOTAL) a dbase_elprogreso
    function get_db_apprw_credentials() {
        $ini_file = '/home/administrador/www/privado/dbconn.ini';
        if (!file_exists($ini_file)) {
            die("El archivo de configuración no existe: $ini_file");
        }
        $config = parse_ini_file($ini_file);
        if ($config === false) {
            die("Error al leer el archivo de configuración");
        }
        return [
            'db_host' => $config['host'],
            'db_user' => $config['username'],
            'db_pass' => $config['password'],
            'db_name' => $config['database']
        ];
    }

?>