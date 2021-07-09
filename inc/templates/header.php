<?php 
    session_start();
    if(isset($_GET['cerrar_sesion']) ) {
        $_SESSION = array();
        
        if(isset($_SESSION['id'])) {
            header('Location:index.php');
            
            exit();
        }
    }
    include 'inc/funciones/pagina.php';
    include 'inc/funciones/sesiones.php';
    usuario_autenticado(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" user-scalable="yes">
    <title>Proyecto II</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/72df3b1037.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
