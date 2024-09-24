<?php
require_once "../controllers/controller.curl.php";
require_once "../controllers/controller.log.php";

class DeleteController {

    public $token;
    public $table;
    public $id;
    public $nameId;

   
    public function ajaxDelete(){

        if ($this->table == "admins" && base64_decode($this->id) == "1") {
            echo "no-borrar";
            return;
        }

        if ($this->table == "news") {
            
            $select = "image_new";
            $url = "news?linkTo=id_new&equalTo=".base64_decode($this->id)."&select=".$select;
            $method = "GET";
            $fields = array();

            $dataItem = CurlController::request($url,$method,$fields)->results[0];

            // Ruta del archivo
            $imagePath = "../views/assets/images/noticias/" . $dataItem->image_new;
            
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $url = $this->table."?id=" . base64_decode($this->id) . "&nameId=" . $this->nameId . "&token=" . $this->token . "&table=admins&suffix=admin";
        $method = "DELETE";
        $fields = array();

        $delete = CurlController::request($url, $method, $fields);

        return $delete->status; 
    }    

    public function registerLogDelete(){

        if($this->table == "admins"){

            

            $select = "email_admin";
            $url = "admins?linkTo=id_admin&equalTo=".base64_decode($this->id)."&select=".$select;
            $method = "GET";
            $fields = array();

            $adminLog = CurlController::request($url,$method,$fields);
            
            
            if($adminLog->status == 200){

                $adminLog->results[0];

            }else{

                $userAction = null;
            }

            $log = new ControllerLog();
            $log->register($_SESSION['administrador']->email_admin, "ELIMINAR USUARIO", $adminLog->email_admin);

        }

        if($this->table == "news"){

            $log = new ControllerLog();
            $log->register($_SESSION['administrador']->email_admin, "ELIMINAR NOTICIA", null);
        }
    }

    }



if (isset($_POST["token"])) {


    $Delete = new DeleteController();
    $Delete->token = $_POST["token"];
    $Delete->table = $_POST["table"];
    $Delete->id = $_POST["id"];
    $Delete->nameId = $_POST["nameId"];

    $status = $Delete->ajaxDelete(); // Captura el estado de la eliminación



    echo $status; // Responder con el estado de la operación
}
