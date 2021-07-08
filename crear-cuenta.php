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
        <h1>Gestor de actividades<span>Crear cuenta</span></h1>
        <form id="formulario" class="caja-login" method="post">
            <div class="campos">
                <div class="campo">
                    <input type="number" name="cedula" id="cedula" placeholder="Tu cédula">
                </div>
                <div class="campo">
                    <input type="email" name="correo" id="correo" placeholder="Tu correo">
                </div>
                <div class="campo">
                    <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">
                </div>

                <div class="campo">
                    <select name="seccion" id="seccion-estudiante">
                    </select>
                </div>

                <div class="campo">
                    <div id="seccion-profesor">
                        <select name="secciones[]">
                        </select>
                    </div>
                    <a href="#" id="btn-seccion"><i class="fa fa-plus"></i></a>
                </div>

                <div class="campo">
                    <div id="materias-profesor">
                        <select name="materias[]">
                        </select>
                    </div>
                    <a href="#" id="btn-materias"><i class="fa fa-plus"></i></a>
                </div>

                <div class="campo">
                    <input type="phone" name="telefono" id="telefono" placeholder="Tu teléfono">
                </div>
                <div class="campo">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
            </div>
            <div class="campo enviar">
                <input type="hidden" id="tipo" value="crear">
                <input type="hidden" id="tipo-usuario">
                <a href="login.php">Inicia Sesión</a>
                <input type="submit" class="boton-formulario" value="Crear cuenta">
            </div>
        </form>
    </div>

<?php
    include 'inc/templates/footer.php';
?>