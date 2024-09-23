<?php

class NewController {

    /**
     * Traduce el nombre del mes al español.
     *
     * @param int $mes Número del mes (1-12).
     * @return string Nombre del mes en español.
     */
    private function getMesEnEspanol($mes) {
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre'
        ];

        return $meses[$mes];
    }

    /**
     * Formatea una fecha en el formato deseado en español.
     *
     * @param string $fecha La fecha en formato Y-m-d (por ejemplo, '2024-08-09').
     * @return string La fecha formateada en español (por ejemplo, '9 de agosto de 2024').
     */
    public function dateFormat($fecha) {
        // Convertir la fecha a un timestamp
        $timestamp = strtotime($fecha);
        
        // Extraer el día, mes y año
        $dia = date('j', $timestamp);
        $mes = date('n', $timestamp);
        $ano = date('Y', $timestamp);

        // Formatear la fecha en español
        $fecha_formateada = $dia . ' de ' . $this->getMesEnEspanol($mes) . ' de ' . $ano;
        
        return $fecha_formateada;
    }

    public function newsManage(){

        if(isset($_POST['title_new'])){


            /*=============================================
            Validar y Guardar Imagen
            =============================================*/
            if(isset($_FILES['image_new']['tmp_name']) && !empty($_FILES['image_new']['tmp_name'])){

                $url_image = TemplateController::generateUrl($_POST['title_new']);

                $image = $_FILES['image_new'];
                $folder = "assets/images/noticias/";

                // Generar un número aleatorio de 6 dígitos
                $randomNumber = rand(100000, 999999);
                $name = $randomNumber."_".$url_image;

                $width = 1000;
                $height = 600;

                $saveImageNew = TemplateController::saveImage($image, $folder, $name, $width, $height);

            }

            /*=============================================
            Validar y Guardar Datos
            =============================================*/
            $fields = array (

                "title_new" => trim(TemplateController::capitalize($_POST['title_new'])),
                "id_category_new" => $_POST['id_category_new'],
                "intro_new" => $_POST['intro_new'],
                "body_new" => $_POST['body_new'],
                "image_new" => $saveImageNew,
                "date_created_new" => date("Y-m-d")
            );

            //echo '<pre>'; print_r($fields);echo '</pre>';

            $url = "news?token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
            $method = "POST";

            $createData = CurlController::request($url,$method,$fields);

            if($createData->status == 200){

                echo '<script>

                    fncFormatInputs();

                    function showAlertSuccess(title,type,text) {
                        Swal.fire({
                            title: title,
                            icon: type,
                            text: text,
                            confirmButtonColor: "#074A1F"
                        }).then((result) => {
                            // Redirige al usuario después de cerrar la alerta
                            if (result.isConfirmed) {
                                window.location.href = "/admin/prensa";
                            }
                        });
                    }
                    showAlertSuccess("Éxito","success","Nueva noticia creada");

                    </script>';
            }
        }
    }
}

?>
