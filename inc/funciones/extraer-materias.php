<?php
    require "../funciones/db.php";
    
    try {
        //Extraigo las materias
        $sql = " SELECT `nombre`, `id` FROM `materias`";
        $resultado = $conn->query($sql);
    
        $materias = array();
        while ( $materia = $resultado->fetch_assoc() ) { 
            $materias[] = $materia;
        }

        $respuesta = [
            "respuesta" => "exito",
            "materias" => $materias
        ];
    } catch (\Throwable $e) {
        $respuesta = [
            "respuesta" => "error",
            "error" => $e
        ];
    }

    die (json_encode($respuesta));
?>