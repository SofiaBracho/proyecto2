<?php
    require "../funciones/db.php";
    
    try {
        //Extraigo las secciones
        $sql = " SELECT `nombre`, `id` FROM `secciones`";
        $resultado = $conn->query($sql);
    
        $secciones = array();
        while ( $seccion = $resultado->fetch_assoc() ) { 
            $secciones[] = $seccion;
        }

        $respuesta = [
            "respuesta" => "exito",
            "secciones" => $secciones
        ];
    } catch (\Throwable $e) {
        $respuesta = [
            "respuesta" => "error",
            "error" => $e
        ];
    }

    die (json_encode($respuesta));
?>