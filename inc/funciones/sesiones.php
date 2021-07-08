<?php

function usuario_autenticado() {
    if(!revisar_usuario()) {
        if(obtenerPaginaActual()=='index') {
            header('Location:login.php');
            exit();
        }
    } else {
        if(obtenerPaginaActual()=='login' || obtenerPaginaActual()=='crear-cuenta') {
            header('Location:index.php');
            exit();
        }
    }
}

function revisar_usuario() {
    return isset($_SESSION['id']);
}