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
            $url = "relations?rel=reclamos,rcategories,zonas,estados&type=reclamo,rcategory,zona,estado&select=id_reclamo";
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

            $select = "id_reclamo,descripcion_rcategory,dni_reclamo,cuenta_reclamo,deuda_reclamo,nombre_zona,descripcion_estado,latitud_reclamo,longitud_reclamo";

            // Search data
            if(!empty($_POST['search']['value'])) {

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["descripcion_rcategory", "dni_reclamo", "cuenta_reclamo", "nombre_zona", "descripcion_estado"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    $data = [];
                    $recordsFiltered = 0;

                    foreach ($linkTo as $value) {
                        $url = "relations?rel=reclamos,rcategories,zonas,estados&type=reclamo,rcategory,zona,estado&select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
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
                $url = "relations?rel=reclamos,rcategories,zonas,estados&type=reclamo,rcategory,zona,estado&select=" . $select . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
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
                            <a href='/admin/gestor_reclamos/visor?reclamo=" . base64_encode($value->id_reclamo) . "' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                                <i class='fa-regular fa-eye text-white mr-1'></i>
                            </a>
                            <a href='/admin/gestor_reclamos/gestion?reclamo=" . base64_encode($value->id_reclamo) . "' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                                <i class='fas fa-pencil-alt text-white mr-1'></i>
                            </a>
                            <button class='btn btn-info border-0 rounded-pill mr-2 btn-sm deleteItem' 
                                rol='admin' table='reclamos' column='reclamo' idItem='" . base64_encode($value->id_reclamo) . "'>
                                <i class='fas fa-trash-alt text-white mr-1'></i>
                            </button>
                            <button class='btn btn-info border-0 rounded-pill mr-2 btn-sm' 
                                data-toggle='modal' 
                                data-target='#mapModal' 
                                data-latitude='" . $value->latitud_reclamo . "' 
                                data-longitude='" . $value->longitud_reclamo . "' 
                                onclick='loadMap(\"" . $value->latitud_reclamo . "\", \"" . $value->longitud_reclamo . "\")'>
                                <i class='fas fa-map-marked-alt text-white mr-1'></i> <!-- Map icon -->
                            </button>
                        </div>
                    ";

                    $actions = TemplateController::htmlClean($actions);

                    $dataJSON['data'][] = [
                        "id_reclamo" => ($start + $key + 1),
                        "descripcion_rcategory" => $value->descripcion_rcategory,
                        "dni_reclamo" => $value->dni_reclamo,
                        "cuenta_reclamo" => $value->cuenta_reclamo,
                        "deuda_reclamo" => $value->deuda_reclamo,
                        "nombre_zona" => $value->nombre_zona,
                        "descripcion_estado" => $value->descripcion_estado,
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
