<?php

use Google\Service\Analytics\Column;
require_once '../controllers/controller.curl.php';
require_once '../controllers/controller.template.php';

class DataTableController {

    public function data() {

        if(isset($_POST)) {

            $draw = $_POST['draw'];

            $orderByColumnIndex = $_POST['order'][0]['column'];
            $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];
            $orderType = $_POST['order'][0]['dir'];
            $start = $_POST['start'];
            $length = $_POST['length'];

            /*=============================================
            Total de registros de la data
            =============================================*/
            $url = "admins?select=id_admin";
            $method = "GET";
            $fields = array();

            $response = CurlController::request($url,$method,$fields);

            if($response->status == 200) {
                $totalData = $response->total;
            } else {
                echo json_encode(["data" => []]);
                return;
            }

            $select = "id_admin,rol_admin,name_admin,email_admin,date_updated_admin";

            /*=============================================
            Búsqueda de Datos
            =============================================*/
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["name_admin", "email_admin", "rol_admin"];

                    $search = str_replace(" ","_",$_POST['search']['value']);

                    foreach ($linkTo as $key => $value) {
                        
                        $url = "admins?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
                        $data = CurlController::request($url, $method, $fields)->results;

                        if($data == "Not Found"){

                            $data = array();
                            $recordsFiltered = 0;
                        }else{

                            $recordsFiltered = count($data);
                            break;
                        }
                    }

                }else{

                    echo json_encode(["data" => []]);
                    return;
                }

            }else{

                /*=============================================
                Selección de Datos
                =============================================*/
                
                $url = "admins?select=".$select."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;

                $recordsFiltered = $totalData;

            }

            
            /*=============================================
            Cuando no hay datos
            =============================================*/
            if(empty($data)) {
                
            }

            /*=============================================
            Construcción del JSON a retornar
            =============================================*/
            $dataJSON = [
                "draw" => intval($draw),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $recordsFiltered,
                "data" => []
            ];

            
            foreach($data as $key => $value) {

                $actions = "
                    <div class='btn-group'>
                                        <a href='/admin/administradores/gestion?admin=".base64_encode($value->id_admin)."' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                                            <i class='fas fa-pencil-alt text-white mr-1'></i>
                                        </a>
                                        <a href='' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                                            <i class='fas fa-trash-alt text-white mr-1'></i>
                                        </a>
                                    </div>
                ";

                $actions = TemplateController::htmlClean($actions);

                $dataJSON['data'][] = [
                    "id_admin" => ($start + $key + 1),
                    "name_admin" => $value->name_admin,
                    "email_admin" => $value->email_admin,
                    "rol_admin" => $value->rol_admin,
                    "date_updated_admin" => $value->date_updated_admin,
                    "actions" => $actions
                ];
            }

            echo json_encode($dataJSON);
        }
    }
}

/*=============================================
Activar función data
=============================================*/
$data = new DataTableController();
$data->data();
