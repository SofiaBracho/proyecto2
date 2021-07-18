<?php 
    require 'inc/funciones/db.php';
    $seccion = $_SESSION['seccion']
?>

<div class="resultados contenedor">
    <?php
        $stmt = $conn->prepare("SELECT * FROM actividades WHERE seccion = ? ORDER BY id DESC");
        $stmt->bind_param("i", $seccion);
        $stmt->execute();
        $actividades=$stmt->get_result();
        $stmt->close();

        while($result=$actividades->fetch_assoc()) { 
            
                $stmt = $conn->prepare("SELECT nombre FROM materias WHERE id = ? ");
                $stmt->bind_param("i", $result['materia']);
                $stmt->execute();
                $stmt->bind_result($materia);
                $stmt->fetch();
                $stmt->close();

                $stmt = $conn->prepare("SELECT nombre_profesor FROM profesores WHERE id = ? ");
                $stmt->bind_param("i", $result['profesor']);
                $stmt->execute();
                $stmt->bind_result($profesor);
                $stmt->fetch();
                $stmt->close();
            ?>

            <div class="cont-actividad" id="<?php echo $result['titulo']; ?>">
                <h2><?php echo $result['titulo']; ?> </h2>
                <div class="header-actividad">
                    <p><?php echo $materia; ?> </p>
                    <p><?php echo $profesor; ?> </p>
                </div>
                <p><?php echo $result['descripcion']; ?> </p>
            </div>
        <?php } 

    ?>
</div>