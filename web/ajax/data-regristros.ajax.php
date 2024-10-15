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

            // Total records count
            $url = "relations?rel=registros,equipos,restados,prioridades&type=registro,equipo,restado,prioridad&select=id_registro";
            $method = "GET";
            $fields = array();

            $response = CurlController::request($url, $method, $fields);

            //echo '<pre>';print_r($response);echo '</pre>';

            if ($response->status == 200) {
                $totalData = $response->total;
            } else {
                echo json_encode(["data" => []]);
                return;
            }

            $select = "id_registro,fecha_registro,descripcion_restado,descripcion_prioridad,nombre_registro,dni_registro,descripcion_equipo";

            // Search data
            if(!empty($_POST['search']['value'])) {

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["fecha_registro", "nombre_registro", "dni_registro", "descripcion_restado"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    $data = [];
                    $recordsFiltered = 0;

                    foreach ($linkTo as $value) {
                        $url = "relations?rel=registros,equipos,restados,prioridades&type=registro,equipo,restado,prioridad&select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
                        $response = CurlController::request($url, $method, $fields);

                        if ($response->status == 200) {
                            $data = $response->results;
                            if ($data != "Not Found") {
                                $recordsFiltered = count($data);
                                break;
                            }
                        }
                    }

                } else {
                    echo json_encode(["data" => []]);
                    return;
                }

            } else {

                // Select data
                $url = "relations?rel=registros,equipos,restados,prioridades&type=registro,equipo,restado,prioridad&select=" . $select . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
                //$url = "relations?rel=news,categories&type=new,category&select=".$select."&linkTo="."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
                $response = CurlController::request($url, $method, $fields);

                if ($response->status == 200) {
                    $data = $response->results;
                    $recordsFiltered = $totalData;
                } else {
                    $data = [];
                    $recordsFiltered = 0;
                }
            }

            // Building JSON response
            $dataJSON = [
                "draw" => intval($draw),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $recordsFiltered,
                "data" => []
            ];

            if (is_array($data) || is_object($data)) {
                foreach ($data as $key => $value) {
                    
                    $actions = "
                    <div class='btn-group'>
                <a href='/admin/inclusion_social/modules/generar_pdf.php?registro=".base64_encode($value->id_registro). "' target='_blank' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                            <i class='fas fa-file-pdf text-white mr-1'></i>
                        </a>
                        <a href='/admin/servicio_tecnico/gestion?registro=" . base64_encode($value->id_registro) . "' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                            <i class='fas fa-pencil-alt text-white mr-1'></i>
                        </a>
                        <button class='btn btn-info border-0 rounded-pill mr-2 btn-sm deleteItem' 
                            rol='admin' table='registros' column='registro' idItem='" . base64_encode($value->id_registro) . "'>
                            <i class='fas fa-trash-alt text-white mr-1'></i>
                        </button>
                    </div>
                ";
                

                    $actions = TemplateController::htmlClean($actions);

                    $dataJSON['data'][] = [
                        "id_registro" => ($start + $key + 1),
                        "fecha_registro" => $value->fecha_registro,
                        "descripcion_restado" => $value->descripcion_restado,
                        "descripcion_prioridad" => $value->descripcion_prioridad,
                        "dni_registro" => $value->dni_registro,
                        "nombre_registro" => $value->nombre_registro,
                        "descripcion_equipo" => $value->descripcion_equipo,
                        "actions" => $actions
                    ];
                }
            }

            echo json_encode($dataJSON);
        }
    }
}

// Activate data function
$data = new DataTableController();
$data->data();
