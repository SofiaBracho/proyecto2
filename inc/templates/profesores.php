<pre>
<?php
    require 'inc/funciones/db.php';
    // var_dump($_SESSION);
?>
</pre>

<form action="#" id="form-actividad" class="contenedor">
    <h2>Publicar actividad</h2>
    <div class="campo-actividad">
        <input type="text" name="titulo-actividad" id="titulo-actividad" placeholder="Título de la actividad">
    </div>
    <div class="campo-actividad">
        <textarea name="descripcion-actividad" id="descripcion-actividad" cols="30" rows="10" placeholder="Descripción..."></textarea>
    </div>

    <div class="selects">
        <select name="seccion-actividad" id="seccion-actividad">
            <?php
                $secciones = json_decode($_SESSION['secciones']);
                foreach ($secciones as $seccion) { 

                        $stmt = $conn->prepare("SELECT nombre FROM secciones WHERE id = ? ");
                        $stmt->bind_param("i", $seccion);
                        $stmt->execute();
                        $stmt->bind_result($nombre_seccion);
                        $stmt->fetch();
                        $stmt->close();
                    ?>
                    <option value="<?php echo $seccion ?>">
                        <?php echo $nombre_seccion; ?>
                    </option>   
            <?php } ?>
        </select>
        <select name="materia-actividad" id="materia-actividad">
            <?php
                $materias = json_decode($_SESSION['materias']);
                foreach ($materias as $materia) { 

                        $stmt = $conn->prepare("SELECT nombre FROM materias WHERE id = ? ");
                        $stmt->bind_param("i", $materia);
                        $stmt->execute();
                        $stmt->bind_result($nombre_materia);
                        $stmt->fetch();
                        $stmt->close();
                    ?>
                    <option value="<?php echo $materia ?>">
                        <?php echo $nombre_materia; ?>
                    </option>   
            <?php } ?>
        </select>
    </div>

    <input type="hidden" name="accion" id="accion" value="crear">
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="profesor" value="<?php echo $_SESSION['id']; ?>">
    <input type="hidden" name="correo_profesor" value="<?php echo $_SESSION['correo']; ?>">
    <input type="submit" class="boton-formulario" value="Enviar actividad">
</form>


<!-- ACTIVIDADES -->
<div class="resultados contenedor">
    <?php
        $profesor=$_SESSION['id'];
        $stmt = $conn->prepare("SELECT * FROM actividades WHERE profesor = ? ORDER BY id DESC ");
        $stmt->bind_param("i", $profesor);
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
            ?>

            <div class="cont-actividad" id="<?php echo $result['id']; ?>">
                <div class="botones-actividad">
                    <a class="edit"> <i class="fas fa-pencil-alt"></i> </a>
                    <a class="delete"> <i class="fas fa-trash"></i> </a>
                </div>
                <h2><?php echo $result['titulo']; ?> </h2>
                <div class="header-actividad">
                    <p> <b>Materia:</b> <?php echo $materia; ?> </p>
                    <p> <b>Prof:</b> <?php echo $_SESSION['nombre']; ?> </p>
                </div>
                <p><?php echo $result['descripcion']; ?> </p>
            </div>
        <?php } 

    ?>
</div>
