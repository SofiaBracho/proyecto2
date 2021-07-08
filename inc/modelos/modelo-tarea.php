<?php 
    require '../funciones/db.php';
    $titulo=$_POST['titulo-actividad'];
    $descripcion=$_POST['descripcion-actividad'];
    $seccion=$_POST['seccion-actividad'];
    $materia=$_POST['materia-actividad'];
    $profesor=$_POST['profesor'];
    
    try {
        $stmt = $conn->prepare("INSERT INTO actividades(`titulo`, `descripcion`, `seccion`, `materia`, `profesor`) VALUES (?, ?, ?, ?, ?); ");
        $stmt->bind_param('ssiii', $titulo, $descripcion, $seccion, $materia, $profesor);
        $stmt->execute();
        
        if($stmt) {
            $resultado = array(
                "respuesta" => "correcto"
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        // Tomar la excepcion
        $resultado = array(
            'error' => $e->getMessage()
        );
    }
    // Insertar tarea
    die(json_encode($resultado));
?>