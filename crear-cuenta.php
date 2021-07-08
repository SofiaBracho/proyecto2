<?php
    session_start();
    include 'inc/templates/header.php';
    include 'inc/funciones/pagina.php';
    include 'inc/funciones/db.php';

    if(isset($_SESSION['nombre'])) {
        header('Location:index.php');
        exit();
    }
?>

    <div class="contenedor-formulario">
        <h1 class="text-gradient">Mini Diary<span>Crear cuenta</span></h1>
        <form id="formulario" class="caja-login" method="post">
            <div class="campo">
                <label for="cedula">C.I: </label>
                <input type="number" name="cedula" id="cedula" placeholder="Tu cédula">
            </div>
            <div class="campo">
                <label for="correo">Correo: </label>
                <input type="email" name="correo" id="correo" placeholder="Tu correo">
            </div>
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">
            </div>

            <div class="campo">
                <label for="seccion">Sección: </label>

                <select name="seccion" id="seccion-estudiante">
                </select>
            </div>

            <div class="campo">
                <label for="secciones">Secciones:</label>
                <div id="seccion-profesor">
                    <select name="secciones[]">
                    </select>
                </div>
                <a href="#" id="btn-seccion"><i class="fa fa-plus"></i></a>
            </div>

            <div class="campo">
                <label for="materias">Materias: </label>
                <div id="materias-profesor">
                    <select name="materias[]">
                    </select>
                </div>
                <a href="#" id="btn-materias"><i class="fa fa-plus"></i></a>
            </div>

            <div class="campo">
                <label for="telefono">Teléfono: </label>
                <input type="phone" name="telefono" id="telefono" placeholder="Tu teléfono">
            </div>
            <div class="campo">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="campo enviar">
                <input type="hidden" id="tipo" value="crear">
                <input type="hidden" id="tipo-usuario">
                <input type="submit" class="boton-formulario" value="Crear cuenta">
            </div>
            <div class="campo">
                <a href="login.php">Inicia Sesión Aquí</a>
            </div>
        </form>
    </div>

<?php
    include 'inc/templates/footer.php';
?>