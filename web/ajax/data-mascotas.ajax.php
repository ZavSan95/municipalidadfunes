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
            $url = "relations?rel=mascotas,tutores,especies&type=mascota,tutor,especie&select=id_tutor";
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

            $select = "id_mascota,nombre_mascota,dni_tutor,descripcion_especie,sexo_mascota";

            // Search data
            if(!empty($_POST['search']['value'])) {

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["nombre_mascota", "dni_tutor", "descripcion_especie"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    $data = [];
                    $recordsFiltered = 0;

                    foreach ($linkTo as $value) {
                        $url = "relations?rel=mascotas,tutores,especies&type=mascota,tutor,especie&select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
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
                $url = "relations?rel=mascotas,tutores,especies&type=mascota,tutor,especie&select=" . $select . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
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
                            <a href='/admin/salud_animal/mascotas/gestion?mascota=" . base64_encode($value->id_mascota) . "' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                                <i class='fas fa-pencil-alt text-white mr-1'></i>
                            </a>
                            <a href='/admin/salud_animal/mascotas/historias?mascota=" . base64_encode($value->id_mascota) . "' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                                <i class='fa-solid fa-notes-medical mr-1'></i>
                            </a>
                            <button class='btn btn-info border-0 rounded-pill mr-2 btn-sm deleteItem' 
                            rol='admin' table='mascotas' column='mascota' idItem='" . base64_encode($value->id_mascota) . "'>
                                <i class='fas fa-trash-alt text-white mr-1'></i>
                            </button>
                        </div>
                    ";

                    $actions = TemplateController::htmlClean($actions);

                    $nombre_mascota = TemplateController::capitalize($value->nombre_mascota);

                    $dataJSON['data'][] = [
                        "id_mascota" => ($start + $key + 1),
                        "nombre_mascota" => $nombre_mascota,
                        "dni_tutor" => $value->dni_tutor,
                        "descripcion_especie" => $value->descripcion_especie,
                        "sexo_mascota" => $value->sexo_mascota,
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
