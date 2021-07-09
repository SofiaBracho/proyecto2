<?php
    include 'inc/templates/header.php';
?>
    <div class="contenedor-formulario">
        <h1>Gestor de actividades</h1>
        <form id="formulario" class="caja-login" method="post">
            <div class="campos">
                <div class="campo">
                    <input type="number" name="cedula" id="cedula" placeholder="Tu cédula">
                </div>
                <div class="campo">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
            </div>
            <div class="campo enviar">
                <input type="hidden" id="tipo" value="login">
                <input type="hidden" id="tipo-usuario">
                <a href="crear-cuenta.php">Regístrate</a>
                <input type="submit" class="boton-formulario" value="Iniciar Sesión">
            </div>
        </form>
    </div>

<?php
    include 'inc/templates/footer.php';
?>