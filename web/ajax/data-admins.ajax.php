<?php

use Google\Service\Analytics\Column;
require_once '../controllers/controller.curl.php';

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

            /*=============================================
            Selección de Datos
            =============================================*/
            $select = "id_admin,rol_admin,name_admin,email_admin,date_updated_admin";

            $url = "admins?select=".$select."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;
            $method = "GET";
            $fields = array();

            $data = CurlController::request($url, $method, $fields)->results;

            $recordsFiltered = $totalData;

            /*=============================================
            Cuando no hay datos
            =============================================*/
            if(empty($data)) {
                echo json_encode(["data" => []]);
                return;
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
                $dataJSON['data'][] = [
                    "id_admin" => ($start + $key + 1),
                    "name_admin" => $value->name_admin,
                    "email_admin" => $value->email_admin,
                    "rol_admin" => $value->rol_admin,
                    "date_updated_admin" => $value->date_updated_admin,
                    "actions" => "" // Puedes agregar botones de acción aquí
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
