<?php
    require_once "../funciones/db.php";
    session_start();
    
    if(isset($_POST["accion"])) {

        //Para crear una nueva entrada
        if($_POST["accion"] == "crear") {
            // Definir variables post
    
            try {
                $sql = "INSERT INTO `entradas`() 
                        VALUES () ";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("", );
                $stmt->execute();
    
                $respuesta = [
                    "respuesta" => "exito"
                ];
            } catch (\Exception $e) {
                $respuesta = [
                    "respuesta" => "Error: " . $e
                ];
            }
        }
    
        //Para modificar una entrada existente
        if($_POST["accion"] == "actualizar") {
            // Inicializar variables
    
            try {
                $sql = "UPDATE `entradas` SET WHERE";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("", );
                $stmt->execute();
    
                $respuesta = [
                    "respuesta" => "exito"
                ];
            } catch (\Exception $e) {
                $respuesta = [
                    "respuesta" => "Error: " . $e
                ];
            }        
        }

        //Para eliminar entradas
        if($_POST["accion"] == "eliminar") {
            $date = $_POST["date"];
    
            try {
                $sql = " DELETE FROM `entradas` WHERE ";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("", );
                $stmt->execute();
    
                $respuesta = [
                    "respuesta" => "exito"
                ];
            } catch (\Exception $e) {
                $respuesta = [
                    "respuesta" => "Error: " . $e
                ];
            }        
        }
        
    }
    

    die( json_encode($respuesta) );