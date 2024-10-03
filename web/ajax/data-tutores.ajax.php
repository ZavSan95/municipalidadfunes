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
            $url = "tutores?select=id_tutor";
            $method = "GET";
            $fields = array();

            $response = CurlController::request($url,$method,$fields);

            if($response->status == 200) {
                $totalData = $response->total;
            } else {
                echo json_encode(["data" => []]);
                return;
            }

            $select = "id_tutor,dni_tutor,nombre_tutor,apellido_tutor";

            /*=============================================
            Búsqueda de Datos
            =============================================*/
            if(!empty($_POST['search']['value'])){

                if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                    $linkTo = ["dni_tutor", "nombre_tutor", "apellido_tutor"];

                    $search = str_replace(" ","_",$_POST['search']['value']);

                    foreach ($linkTo as $key => $value) {
                        
                        $url = "tutores?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
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
                
                $url = "tutores?select=".$select."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
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
                                        <a href='/admin/salud_animal/tutores/gestion?tutor=".base64_encode($value->id_tutor)."' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                                            <i class='fas fa-pencil-alt text-white mr-1'></i>
                                        </a>
                                        <button class='btn btn-info border-0 rounded-pill mr-2 btn-sm deleteItem' 
                                        rol='admin' table='tutores' column='tutor' idItem='".base64_encode($value->id_tutor)."'>
                                            <i class='fas fa-trash-alt text-white mr-1'></i>
                                        </button>
                                    </div>
                ";

                $actions = TemplateController::htmlClean($actions);

                // Aplica capitalize a nombre y apellido
                $nombre_tutor = TemplateController::capitalize($value->nombre_tutor);
                $apellido_tutor = TemplateController::capitalize($value->apellido_tutor);

                $dataJSON['data'][] = [
                    "id_tutor" => ($start + $key + 1),
                    "dni_tutor" => $value->dni_tutor,
                    "nombre_tutor" => $nombre_tutor,
                    "apellido_tutor" => $apellido_tutor,
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
