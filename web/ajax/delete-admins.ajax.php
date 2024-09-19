<?php
require_once "../controllers/controller.curl.php";
require_once "../controllers/controller.log.php";

class DeleteController {

    public $token;
    public $table;
    public $id;
    public $nameId;

    public function ajaxDelete() {

        if ($this->table == "admins" && base64_decode($this->id) == "1") {
            echo "no-borrar";
            return;
        }

        $url = "admins?id=" . base64_decode($this->id) . "&nameId=" . $this->nameId . "&token=" . $this->token . "&table=admins&suffix=admin";
        $method = "DELETE";
        $fields = array();

        $delete = CurlController::request($url, $method, $fields);

        return $delete->status; 
    }

}

if (isset($_POST["token"])) {

    $Delete = new DeleteController();
    $Delete->token = $_POST["token"];
    $Delete->table = $_POST["table"];
    $Delete->id = $_POST["id"];
    $Delete->nameId = $_POST["nameId"];

    $status = $Delete->ajaxDelete(); // Captura el estado de la eliminación

    // Registrar el log si la eliminación fue exitosa
    if (isset($_POST['email-admin'])) { // Verificar si se ha enviado el email-admin
        $log = new ControllerLog();

        if ($status == 200) {
            $log->register($_POST['email-admin'], "ELIMINACION USUARIO", base64_decode($_POST['id']));
        } else {
            $log->register($_POST['email-admin'], "ELIMINACION USUARIO FALLIDA", base64_decode($_POST['id']));
        }
    } else {
        echo "No hay email de administrador";
    }

    echo $status; // Responder con el estado de la operación
}
