<?php
    require_once "../funciones/db.php";
    session_start();

    try {
        //Se leen todas las actividades de la materia
        $sql = " SELECT * FROM `` WHERE  ORDER BY `date` DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("", );
        $stmt->execute();
        $resultado = $stmt->get_result();

        $entradas = array();
        while ( $entrada = $resultado->fetch_assoc() ) {
            $entradas[] = $entrada;
        }

        $respuesta = [
            "respuesta" => "exito",
            "entradas" => $entradas
        ];
    } catch (\Exception $e) {
        //Lanza el error
        $respuesta = [
            "respuesta" => "error",
            "error" => "Error: " . $e
        ];
    }
    
    $conn->close();

    die( json_encode($respuesta) );