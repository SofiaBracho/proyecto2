<?php
$accion = $_POST['accion'];
$cedula = (int) $_POST['cedula'];
$password = $_POST['password'];
$tipo_usuario = $_POST['tipo_usuario'];

if($accion === 'crear') {
    $correo = (string) $_POST['correo'];
    $nombre = $_POST['nombre'];
    $seccion = $_POST['seccion'];
    $telefono = $_POST['telefono'];

    // Hashear passwords
    $opciones = array(
        'cost' => 12
    );
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
    // Importar la conexion
    include '../funciones/db.php';

    try {

        if($tipo_usuario=='estudiante') {
            // Insertar estudiante
            $stmt = $conn->prepare("INSERT INTO estudiantes(`nombre_estudiante`, `correo`, `ci`, `seccion`, `telefono`, `password`) VALUES (?, ?, ?, ?, ?, ?); ");
            $stmt->bind_param('ssiiis', $nombre, $correo, $cedula, $seccion, $telefono, $hash_password);
        }
        else if($tipo_usuario=='profesor') {
            $materias = (string) $_POST['materias'];

            //Crear un arreglo con las secciones
            $secciones = explode(',', $seccion);
            $json_secciones = array();
            foreach ($secciones as $seccion) {
                if($seccion != '') {
                    $json_secciones[] = (int) $seccion;
                }
            }
            $json_secciones = json_encode($json_secciones);

            //Crear un arreglo con las materias
            $materias = explode(',', $materias);
            $json_materias = array();
            foreach ($materias as $materia) {
                if($materia != '') {
                    $json_materias[] = (int) $materia;
                }
            }
            $json_materias = json_encode($json_materias);
            
            // Insertar profesor
            $stmt = $conn->prepare("INSERT INTO profesores(`nombre_profesor`, `correo`, `ci`, `secciones`, `telefono`, `password`, `materias`) VALUES (?, ?, ?, ?, ?, ?, ?); ");
            $stmt->bind_param('ssisiss', $nombre, $correo, $cedula, $json_secciones, $telefono, $hash_password, $json_materias);
        }
            
        $stmt->execute();
        if($stmt->affected_rows == 1) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $accion
            );
        } else if($stmt->affected_rows == -1) {
            $respuesta = array(
                'respuesta' => 'Error',
                'error' => 'El usuario ya existe',
                'stmt' => $stmt
            );
        } else {
            $respuesta = array(
                'respuesta' => 'Error',
                'error' => 'Hubo un error al crear la cuenta'
            );
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        // Tomar la excepcion
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }

    echo json_encode($respuesta);
}

if($accion === 'login') {
    // Loguear a los usuarios
    include '../funciones/db.php';

    if($tipo_usuario=='estudiante') {
        
        try {
            // Seleccionar el estudiante de la base de datos
            $stmt = $conn->prepare("SELECT nombre_estudiante, id, correo, telefono, seccion, password FROM estudiantes WHERE ci = ? ");
            $stmt->bind_param('i', $cedula);
            $stmt->execute();
    
            // Loguear al usuario
            $stmt->bind_result($nombre_estudiante, $id_estudiante, $correo_estudiante, $telefono_estudiante, $seccion_estudiante, $pass_estudiante);
            $stmt->fetch();
    
            // Si existe el usuario
            if($nombre_estudiante) {
                if(password_verify($password, $pass_estudiante)) {
                    // Inicio la sesión
                    session_start();
                    $_SESSION['tipo_usuario'] = 'estudiante';
                    $_SESSION['nombre'] = $nombre_estudiante;
                    $_SESSION['correo'] = $correo_estudiante;
                    $_SESSION['telefono'] = $telefono_estudiante;
                    $_SESSION['seccion'] = $seccion_estudiante;
                    $_SESSION['id'] = $id_estudiante;
                    $_SESSION['login'] = true;
                    // La contraseña es correcta
                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'usuario' => $nombre_estudiante,
                        'tipo' => $accion
                    );
                } else{
                    // Contraseña incorrecta
                    $respuesta = array(
                        'error' => 'Contraseña incorrecta'
                    );
                }
                
            } else{
                $respuesta = array(
                    'error' => 'El usuario no existe'
                );
            }
    
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            // Tomar la excepcion
            $respuesta = array(
                'pass' => $e->getMessage()
            );
        }
    }else if ($tipo_usuario=='profesor') {
        try {
            // Seleccionar el estudiante de la base de datos
            $stmt = $conn->prepare("SELECT nombre_profesor, id, correo, telefono, secciones, password, materias FROM profesores WHERE ci = ? ");
            $stmt->bind_param('i', $cedula);
            $stmt->execute();
    
            // Loguear al usuario
            $stmt->bind_result($nombre_profesor, $id_profesor, $correo_profesor, $telefono_profesor, $secciones_profesor, $pass_profesor, $materias_profesor);
            $stmt->fetch();
    
            // Si existe el usuario
            if($nombre_profesor) {
                if(password_verify($password, $pass_profesor)) {
                    // Inicio la sesión
                    session_start();
                    $_SESSION['tipo_usuario'] = 'profesor';
                    $_SESSION['nombre'] = $nombre_profesor;
                    $_SESSION['correo'] = $correo_profesor;
                    $_SESSION['telefono'] = $telefono_profesor;
                    $_SESSION['secciones'] = $secciones_profesor;
                    $_SESSION['materias'] = $materias_profesor;
                    $_SESSION['id'] = $id_profesor;
                    $_SESSION['login'] = true;
                    // La contraseña es correcta
                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'usuario' => $nombre_profesor,
                        'tipo' => $accion
                    );
                } else{
                    // Contraseña incorrecta
                    $respuesta = array(
                        'error' => 'Contraseña incorrecta'
                    );
                }
                
            } else{
                $respuesta = array(
                    'error' => 'El usuario no existe'
                );
            }
    
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            // Tomar la excepcion
            $respuesta = array(
                'pass' => $e->getMessage()
            );
        }
    }

    echo json_encode($respuesta);
}