<?php
    include 'inc/templates/header.php';
    include 'inc/funciones/db.php';
?>
    <header class="contenedor header">
        <h1 class="text-gradient">Sistema educativo</h1>
        <div class="botones">
            <a href="seccion.php" id="boton-seccion"> <?php echo ($_SESSION['tipo_usuario']=='estudiante') ? 'Mi seccion' : 'Mis secciones' ; ?> </a>
            <a href="login.php?cerrar_sesion=true" id="boton-logout"> Cerrar Sesión </a>
        </div>
    </header>

    <?php if($_SESSION['tipo_usuario']=='estudiante') {
        $stmt = $conn->prepare("SELECT seccion FROM estudiantes WHERE id = ? ");
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
        $stmt->bind_result($seccion);
        $stmt->fetch();
        $stmt->close();

        $stmt = $conn->prepare("SELECT nombre FROM secciones WHERE id = ? ");
        $stmt->bind_param("i", $seccion);
        $stmt->execute();
        $stmt->bind_result($nombre_seccion);
        $stmt->fetch();
        $stmt->close();

    // ESTUDIANTES
        echo '<h2> Seccion: '. $nombre_seccion .'</h2>';

        $stmt = $conn->prepare("SELECT * FROM estudiantes WHERE seccion = ? ");
        $stmt->bind_param("i", $seccion);
        $stmt->execute();
        $estudiantes = $stmt->get_result();
        $stmt->close();
    ?>

        <table>
            <thead>
                <th>Nombre</th>
                <th>CI</th>
                <th>Telefono</th>
                <th>Correo</th>
            </thead>
            <tbody>
        
            <?php while ($result=$estudiantes->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$result['nombre_estudiante'].'</td>'; 
                echo '<td>'.$result['ci'].'</td>'; 
                echo '<td>'.$result['telefono'].'</td>'; 
                echo '<td>'.$result['correo'].'</td>';
                echo '</tr>';
            } ?>

            </tbody>
        </table>

    <!-- PROFESORES -->
    <?php echo '<h2>Profesores</h2>';

        $stmt = $conn->prepare("SELECT secciones, id FROM profesores ");
        $stmt->execute();
        $resultado=$stmt->get_result();
        $stmt->close();

        // CREO UN ARRAY CON LOS PROFESORES
        $profesores = array();
        while ($result=$resultado->fetch_assoc() ) {
            $secciones=json_decode($result['secciones']);
            foreach ($secciones as $secc) {
                if($secc==$seccion) {
                    $profesores[] = $result['id'];
                }
            }
        } ?>

        <table>
        <thead>
            <th>Nombre</th>
            <th>CI</th>
            <th>Telefono</th>
            <th>Correo</th>
        </thead>
        <tbody>
    
        <?php 
            foreach ($profesores as $profesor) {
                $stmt = $conn->prepare("SELECT * FROM profesores WHERE id = ? ");
                $stmt->bind_param("i", $profesor);
                $stmt->execute();
                $row = $stmt->get_result();
                $stmt->close();
                
                while ($result=$row->fetch_assoc()) {
                    echo '<tr>';
                        echo '<td>'.$result['nombre_profesor'].'</td>'; 
                        echo '<td>'.$result['ci'].'</td>'; 
                        echo '<td>'.$result['telefono'].'</td>'; 
                        echo '<td>'.$result['correo'].'</td>';
                    echo '</tr>';
                } 

            }?>
            </tbody>
        </table>

<?php  }else if($_SESSION['tipo_usuario']=='profesor') {

        $stmt = $conn->prepare("SELECT secciones FROM profesores WHERE id = ? ");
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
        $stmt->bind_result($secciones);
        $stmt->fetch();
        $stmt->close();

        $secciones_arr=json_decode($secciones);
        foreach ($secciones_arr as $seccion) {
            $stmt = $conn->prepare("SELECT nombre FROM secciones WHERE id = ? ");
            $stmt->bind_param("i", $seccion);
            $stmt->execute();
            $stmt->bind_result($nombre_seccion);
            $stmt->fetch();
            $stmt->close();

            echo '<h2>'. $nombre_seccion .'</h2>';

            // ESTUDIANTES
            $stmt = $conn->prepare("SELECT * FROM estudiantes WHERE seccion = ? ");
            $stmt->bind_param("i", $seccion);
            $stmt->execute();
            $estudiantes = $stmt->get_result();
            $stmt->close();
        ?>

        <table>
            <thead>
                <th>Nombre</th>
                <th>CI</th>
                <th>Telefono</th>
                <th>Correo</th>
            </thead>
            <tbody>
        
            <?php while ($result=$estudiantes->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$result['nombre_estudiante'].'</td>'; 
                echo '<td>'.$result['ci'].'</td>'; 
                echo '<td>'.$result['telefono'].'</td>'; 
                echo '<td>'.$result['correo'].'</td>';
                echo '</tr>';
            } ?>

            </tbody>
        </table>
<?php        }
    }

    include_once "inc/templates/footer.php";
?>