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
            $url = "areas?select=id_area";
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

            $select = "id_area,nombre_area";

            // Search data
            if(!empty($_POST['search']['value'])) {

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["nombre_area"];
                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    $data = [];
                    $recordsFiltered = 0;

                    foreach ($linkTo as $value) {
                        $url = "areas?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;
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
                $url = "areas?select=" . $select . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;                
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
                            <a href='/admin/areas/gestion?area=" . base64_encode($value->id_area) . "' class='btn btn-info border-0 rounded-pill mr-2 btn-sm'>
                                <i class='fas fa-pencil-alt text-white mr-1'></i>
                            </a>
                            <button class='btn btn-info border-0 rounded-pill mr-2 btn-sm deleteItem' 
                            rol='admin' table='areas' column='area' idItem='" . base64_encode($value->id_area) . "'>
                                <i class='fas fa-trash-alt text-white mr-1'></i>
                            </button>
                        </div>
                    ";

                    $actions = TemplateController::htmlClean($actions);

                    $dataJSON['data'][] = [
                        "id_area" => ($start + $key + 1),
                        "nombre_area" => $value->nombre_area,
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
