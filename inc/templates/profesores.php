<pre>
<?php
    require 'inc/funciones/db.php';
    var_dump($_SESSION);
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
    
    <input type="hidden" name="profesor" value="<?php echo $_SESSION['id']; ?>">
    <input type="submit" class="boton-formulario" value="Enviar actividad">
</form>

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
            <pre>
                <?php var_dump($result); ?>
            </pre>

            <div class="cont-actividad" id="<?php echo $result['id']; ?>">
                <div class="header-actividad">
                    <p><?php echo $materia; ?> </p>
                    <p><?php echo $profesor; ?> </p>
                </div>
                <h2><?php echo $result['titulo']; ?> </h2>
                <p><?php echo $result['descripcion']; ?> </p>
            </div>
        <?php } 

    ?>
</div>
