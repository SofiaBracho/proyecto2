<?php 
    require '../funciones/db.php';
    $titulo=$_POST['titulo-actividad'];
    $descripcion=$_POST['descripcion-actividad'];
    $seccion=$_POST['seccion-actividad'];
    $materia=$_POST['materia-actividad'];
    $profesor=$_POST['profesor'];
    $correo_profesor=$_POST['correo_profesor'];
    
    // Insertar tarea
    try {
        $stmt = $conn->prepare("INSERT INTO actividades(`titulo`, `descripcion`, `seccion`, `materia`, `profesor`) VALUES (?, ?, ?, ?, ?); ");
        $stmt->bind_param('ssiii', $titulo, $descripcion, $seccion, $materia, $profesor);
        $stmt->execute();
        
        if($stmt) {
            // Extraer los correos de todos los estudiantes de la sección y hacer un array
            $stmt = $conn->prepare("SELECT correo FROM estudiantes WHERE seccion = ? ");
            $stmt->bind_param('i', $seccion);
            $stmt->execute();
            $rows = $stmt->get_result();

            $correos = array();
            while ( $correo = $rows->fetch_assoc() ) {
                $correos[] = $correo['correo'];
            }
            // Funcion implode para separarlos con comas
            $to = implode(",", $correos);
            // Otros datos para el envío
            $subject = $titulo;
            $message = $descripcion;
            $headers = "From: " . filter_var($correo_profesor, FILTER_SANITIZE_EMAIL);

            if( mail($to, $subject, $message, $headers) ) {
                $resultado = array(
                    "respuesta" => "correcto",
                    "mail" => "enviado"
                );
            } else {
                $resultado = array(
                    "respuesta" => "correcto",
                    "mail" => "fallido"
                );
            }
        }
        $stmt->close();
    } catch (Exception $e) {
        // Tomar la excepcion
        $resultado = array(
            'error' => $e->getMessage()
        );
    }

    

    die(json_encode($correos_string));
?>