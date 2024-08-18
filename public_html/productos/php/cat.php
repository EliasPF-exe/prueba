<?php
    
    include_once '../php/dbase_utiles.php';


   
    function obtener_categorias() {

        $hw_conn = connect_db_apprw();
        if (!$hw_conn) {
            return '<select><option>Error de conexión</option></select>';
        }
        
        $Query = "SELECT uuid, nombre FROM categorias";
        $result = $hw_conn->query($Query);

        if ($result->num_rows > 0) {
            $select_html = "<select id='categoria' name='categoria'>";
            while($row = $result->fetch_assoc()) {
                $select_html .= '<option value="' . $row['uuid'] . '">' . $row['nombre'] . "</option>";
            }
            $select_html .= "</select>";
        }
        else {
            $select_html = "<tr><td colspan='3'>No se encontraron resultados</td></tr>";
        }

        return $select_html;

        mysqli_free_result($result);
        close_db($hw_conn);
    }

    function obtener_marcas() {
                
        $hw_conn = connect_db_apprw();
        if (!$hw_conn) {
            return '<select><option>Error de conexión</option></select>';
        }

        $Query = "SELECT uuid, nombre FROM marcas";
        $result = $hw_conn->query($Query);
        
        $select_html = "<select id='marca' name='marca'>";
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $select_html .= '<option value="' . $row['uuid'] . '">' . $row['nombre'] . "</option>";
            }
            $select_html .= '</select>';

        } else {
            $select_html .= "<option>No se encontraron resultados</option>";
        }

        return $select_html;

        mysqli_free_result($result);
        close_db($hw_conn);
        
    }

    function obtener_proveedores() {
                
        $hw_conn = connect_db_apprw();
    
        $Query = "SELECT uuid, nombre FROM proveedores";
        $result = $hw_conn->query($Query);

        $select_html = "<select id='proveedor' name='proveedor'>";
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $select_html .= '<option value="' . $row['uuid'] . '">' . $row['nombre'] . "</option>";
            }
            $select_html .= '</select>';

        } else {
            $select_html .= "<option>No se encontraron resultados</option>";
        }

        return $select_html;

        mysqli_free_result($result);
        close_db($hw_conn);
        
    }

?>

