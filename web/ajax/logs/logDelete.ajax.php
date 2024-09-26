<?php
require_once "../../controllers/controller.curl.php";
require_once "../../controllers/controller.log.php";

if (isset($_POST["token"], $_POST["table"], $_POST["id"], $_POST["emailUser"])) {
    $logController = new ControllerLog();
    
    // Personaliza el mensaje de registro
    $logMessage = "Eliminado item de la tabla: " . $_POST["table"] . " con ID: " . $_POST["id"];

    if($_POST['table'] == "admins"){

        $otherUse = base64_decode($_POST["id"]);
        
    }
    else if ($_POST['table'] == "news" || $_POST['table'] == "slides"){

        $otherUse = null;
    }
    
    // Llama al método de registro
    if ($logController->register($_POST["emailUser"], "ELIMINACION ".$_POST["table"]." ID: ".base64_decode($_POST["id"]), $otherUse)) {
        // Devuelve una respuesta en formato JSON
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el log."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Parámetros inválidos."]);
}

