<?php 
    require '../funciones/db.php';
    $accion=$_POST['accion'];
    $id=$_POST['id'];

    if($accion=='crear' || $accion=='editar') {
        
        $titulo=$_POST['titulo-actividad'];
        $descripcion=$_POST['descripcion-actividad'];
        $seccion=$_POST['seccion-actividad'];
        $materia=$_POST['materia-actividad'];
        $profesor=$_POST['profesor'];
        $correo_profesor=$_POST['correo_profesor'];
    }
    
    // Insertar tarea
    if($accion=='crear') {
        try {
            $stmt = $conn->prepare("INSERT INTO actividades(`titulo`, `descripcion`, `seccion`, `materia`, `profesor`) VALUES (?, ?, ?, ?, ?); ");
            $stmt->bind_param('ssiii', $titulo, $descripcion, $seccion, $materia, $profesor);
            $stmt->execute();
            $stmt->close();
            
            if($stmt) {
                // Extraer los correos de todos los estudiantes de la sección y hacer un array
                $stmt = $conn->prepare("SELECT correo FROM estudiantes WHERE seccion = ? ");
                $stmt->bind_param('i', $seccion);
                $stmt->execute();
                $rows = $stmt->get_result();
                $stmt->close();

                $correos = array();
                while ( $correo = $rows->fetch_assoc() ) {
                    $correos[] = $correo['correo'];
                }
                // Funcion implode para separarlos con comas
                $to = implode(", ", $correos);
                // Otros datos para el envío
                $subject = $titulo;
                $message = $descripcion;
                $headers = "From: " . $correo_profesor . "\r\n";
                $headers .= "Reply-to: " . $correo_profesor . "\r\n";
                $headers .= "X-mailer: PHP/" . phpversion();

                $mail = mail($to, $subject, $message, $headers);

                // Si se envía el correo
                if( $mail ) {
                    // Enviar SMS
                    // Extraigo los telefonos de la sección
                    $stmt = $conn->prepare("SELECT telefono FROM estudiantes WHERE seccion = ? ");
                    $stmt->bind_param('i', $seccion);
                    $stmt->execute();
                    $rows = $stmt->get_result();
                    $stmt->close();
    
                    // Creo un array con los telefonos
                    $telefonos = array();
                    while ( $telefono = $rows->fetch_assoc() ) {
                        $telefonos[] = $telefono['telefono'];
                    }

                    // Obteniendo nombre del profesor
                    $stmt = $conn->prepare("SELECT nombre_profesor FROM profesores WHERE id = ? ");
                    $stmt->bind_param('i', $profesor);
                    $stmt->execute();
                    $stmt->bind_result($nombre_profesor);
                    $stmt->fetch();
                    $stmt->close();
                    
                    // Obteniendo materia
                    $stmt = $conn->prepare("SELECT nombre FROM materias WHERE id = ? ");
                    $stmt->bind_param('i', $materia);
                    $stmt->execute();
                    $stmt->bind_result($nombre_materia);
                    $stmt->fetch();
                    $stmt->close();
                        
                    $mensaje = $titulo;
                    $mensaje .= "\n" . $descripcion;
                    $mensaje .= "\nProfesor: " . $nombre_profesor;
                    $mensaje .= "\nMateria: ". $nombre_materia;

    
                    include '../funciones/testAltiriaSms.php';
                    // Si se envía el SMS
                    if($response) {
                        $resultado = array(
                            "respuesta" => "correcto",
                            "mail" => "enviado",
                            "mensaje" => "enviado"
                        );
                    }else {
                        $resultado = array(
                            "respuesta" => "correcto",
                            "mail" => "enviado",
                            "mensaje" => "fallido"
                        );
                    }
                } else {
                    $resultado = array(
                        "respuesta" => "correcto",
                        "mail" => "fallido",
                        "mensaje" => "fallido"
                    );
                }

            }
        } catch (Exception $e) {
            // Tomar la excepcion
            $resultado = array(
                'error' => $e->getMessage()
            );
        }
    }else if($accion=="editar") {
        try {
            $stmt = $conn->prepare("UPDATE actividades SET `titulo`=?, `descripcion`=?, `seccion`=?, `materia`=?, `profesor`=? WHERE `id`=?; ");
            $stmt->bind_param('ssiiii', $titulo, $descripcion, $seccion, $materia, $profesor, $id);
            $stmt->execute();
            $stmt->close();
    
            if($stmt) {
                // Extraer los correos de todos los estudiantes de la sección y hacer un array
                $stmt = $conn->prepare("SELECT correo FROM estudiantes WHERE seccion = ? ");
                $stmt->bind_param('i', $seccion);
                $stmt->execute();
                $rows = $stmt->get_result();
                $stmt->close();

                $correos = array();
                while ( $correo = $rows->fetch_assoc() ) {
                    $correos[] = $correo['correo'];
                }
                // Funcion implode para separarlos con comas
                $to = implode(", ", $correos);
                // Otros datos para el envío
                $subject = $titulo;
                $message = $descripcion;
                $headers = "From: " . $correo_profesor . "\r\n";
                $headers .= "Reply-to: " . $correo_profesor . "\r\n";
                $headers .= "X-mailer: PHP/" . phpversion();

                $mail = mail($to, $subject, $message, $headers);

                // Si se envía el correo
                if( $mail ) {
                    // Enviar SMS
                    // Extraigo los telefonos de la sección
                    $stmt = $conn->prepare("SELECT telefono FROM estudiantes WHERE seccion = ? ");
                    $stmt->bind_param('i', $seccion);
                    $stmt->execute();
                    $rows = $stmt->get_result();
                    $stmt->close();
    
                    // Creo un array con los telefonos
                    $telefonos = array();
                    while ( $telefono = $rows->fetch_assoc() ) {
                        $telefonos[] = $telefono['telefono'];
                    }

                    // Obteniendo nombre del profesor
                    $stmt = $conn->prepare("SELECT nombre_profesor FROM profesores WHERE id = ? ");
                    $stmt->bind_param('i', $profesor);
                    $stmt->execute();
                    $stmt->bind_result($nombre_profesor);
                    $stmt->fetch();
                    $stmt->close();
                    
                    // Obteniendo materia
                    $stmt = $conn->prepare("SELECT nombre FROM materias WHERE id = ? ");
                    $stmt->bind_param('i', $materia);
                    $stmt->execute();
                    $stmt->bind_result($nombre_materia);
                    $stmt->fetch();
                    $stmt->close();
                        
                    $mensaje = $titulo;
                    $mensaje .= "\n" . $descripcion;
                    $mensaje .= "\nProfesor: " . $nombre_profesor;
                    $mensaje .= "\nMateria: ". $nombre_materia;

    
                    include '../funciones/testAltiriaSms.php';
                    // Si se envía el SMS
                    if($response) {
                        $resultado = array(
                            "respuesta" => "correcto",
                            "mail" => "enviado",
                            "mensaje" => "enviado"
                        );
                    }else {
                        $resultado = array(
                            "respuesta" => "correcto",
                            "mail" => "enviado",
                            "mensaje" => "fallido"
                        );
                    }
                } else {
                    $resultado = array(
                        "respuesta" => "correcto",
                        "mail" => "fallido",
                        "mensaje" => "fallido"
                    );
                }
            }
        } catch (Exception $e) {
            // Tomar la excepcion
            $resultado = array(
                'error' => $e->getMessage()
            );
        }
    }else if($accion=="eliminar") {
        try {
            $stmt = $conn->prepare("DELETE FROM actividades WHERE `id`=?; ");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();

            if($stmt){
                $resultado = array(
                    "respuesta" => "correcto"
                );
            }    
        } catch (Exception $e) {
            // Tomar la excepcion
            $resultado = array(
                'error' => $e->getMessage()
            );
        }
    }
    
    die(json_encode($resultado));
?>