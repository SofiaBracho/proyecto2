<?php
    include 'inc/templates/header.php';
?>
    <header class="contenedor header">
        <a href="index.php"> <h1 class="text-gradient">Sistema educativo</h1> </a>
        <div class="botones">
            <a href="seccion.php" id="boton-seccion"> <?php echo ($_SESSION['tipo_usuario']=='estudiante') ? 'Mi seccion' : 'Mis secciones' ; ?> </a>
            <a href="login.php?cerrar_sesion=true" id="boton-logout"> Cerrar Sesión </a>
        </div>
    </header>

    <?php if($_SESSION['tipo_usuario']=='estudiante') {
        include 'inc/templates/estudiantes.php';
    }else if($_SESSION['tipo_usuario']=='profesor') {
        include 'inc/templates/profesores.php';
    }?>

    <footer>
        
    </footer>

<?php
    include_once "inc/templates/footer.php";
?>