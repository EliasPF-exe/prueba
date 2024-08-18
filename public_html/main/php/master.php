<?php

    include_once '../php/dbase_utiles.php';

    include_once "db_utiles.php";

    function mostrar_producto_destacados() {
        $hw_conn = connect_db_apprw();
        
        // Consulta SQL para obtener los productos
        $Query = "SELECT uuid, nombre, descripcion, precio_venta FROM producto";
        $result = $hw_conn->query($Query);
    
        $productos = array(); // Inicializa el diccionario asociativo
    
        if ($result && $result->num_rows > 0) {
            // Recorre los resultados y construye el diccionario
            while ($row = $result->fetch_assoc()) {
                $productos[$row["nombre"]] = array(
                    'uuid' => $row["uuid"],
                    'descripcion' => $row["descripcion"],
                    'precio_venta' => $row["precio_venta"]
                );
            }
        } else {
            echo "<div class='no-results'>No se encontraron resultados</div>";
        }
    
        // Libera el resultado y cierra la conexión
        mysqli_free_result($result);
        close_db($hw_conn);
    
        // Muestra los productos utilizando el diccionario
        foreach ($productos as $nombre => $detalle) {
            echo "<div class='product'>";
            echo "<h3>" . htmlspecialchars($nombre) . "</h3>";
            echo "<p>" . htmlspecialchars($detalle['descripcion']) . "</p>";
            echo "<p>" . htmlspecialchars($detalle['precio_venta']) . "</p>";
            echo "<button class='btn-cart' onclick='cargar_carrito()' ><img src='img/car1.png' alt='Carrito'></button>";
            echo "<button class='view-details'>Ver detalles</button>";
            echo "</div>";
        }
    }
    function obtener_categorias() {

        $hw_conn = connect_db_apprw();
        if (!$hw_conn) {
            return '<a href="#">sin categorias</a>';
        }
        
        $Query = "SELECT uuid, nombre FROM categorias";
        $result = $hw_conn->query($Query);

        if ($result->num_rows > 0) {
            $select_html = "<ul class='submenu'>";
            while($row = $result->fetch_assoc()) {
                $select_html .= '<li class="' . $row['uuid'] . '">' . $row['nombre'] . "</li>";
            }
            $select_html .= "</ul>";
        }
        else {
            $select_html = '<a href="#">No se encontraron resultados</a>';
        }

        return $select_html;

        mysqli_free_result($result);
        close_db($hw_conn);
    }

    function obtener_marcas() {

        $hw_conn = connect_db_apprw();
        if (!$hw_conn) {
            return '<a href="#">sin marcas</a>';
        }
        
        $Query = "SELECT uuid, nombre FROM marcas";
        $result = $hw_conn->query($Query);

        if ($result->num_rows > 0) {
            $select_html = "<ul class='submenu'>";
            while($row = $result->fetch_assoc()) {
                $select_html .= '<li class="' . $row['uuid'] . '">' . $row['nombre'] . "</li>";
            }
            $select_html .= "</ul>";
        }
        else {
            $select_html = '<a href="#">No se encontraron resultados</a>';
        }

        return $select_html;

        mysqli_free_result($result);
        close_db($hw_conn);
    }