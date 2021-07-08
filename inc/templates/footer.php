    <script src="js/jquery-1.12.0.min.js"></script>
<?php    
    //LogIn y SignIn
    echo (obtenerPaginaActual() == "crear-cuenta") 
    ? '<script src="js/sign-in.js"></script>' : "";

    echo (obtenerPaginaActual() == "login") 
    ? '<script src="js/log-in.js"></script>' : "";

    //INDEX
    if(obtenerPaginaActual() == "index") {
        echo '<script src="js/scripts.js"></script>';
        if($_SESSION['tipo_usuario']=='profesor') {
            echo '<script src="js/actividad.js"></script>';
        }
    }
?>
    <script src="js/sweetalert2.all.min.js"></script>
</body>
</html>