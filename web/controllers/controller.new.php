<?php
require_once 'controllers/controller.log.php';
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

            // Comprobar si el título está vacío
            if (empty(trim($_POST['title_new'])) || empty($_POST['id_category_new'])) {
                // Establecer el mensaje de error en la sesión
                $_SESSION['error-form'] = "Complete los campos requeridos";
                return; 
            }

            /*=============================================
            Edición Noticia
            =============================================*/
            if(isset($_POST['idNew'])){

                // echo '<pre>';print_r($_POST);echo '</pre>';
                // echo 'fin segundo print_r';
                // echo $_POST['idNew'];
                // return;

                
                if(isset($_FILES['image_new']['tmp_name']) && !empty($_FILES['image_new']['tmp_name'])){

                    $url_image = TemplateController::generateUrl($_POST['title_new']);

                    $image = $_FILES['image_new'];
                    $folder = "assets/images/noticias/";
                
                    // Generar un número aleatorio de 6 dígitos
                    $randomNumber = rand(100000, 999999);
                    $name = $randomNumber . "_" . $url_image;
                
                    $width = 1000;
                    $height = 600;
                
                    unlink("views/assets/images/noticias/".$_POST['old_image_new']); // Eliminar la imagen vieja
                
                    // Guardar la nueva imagen
                    $saveImageNew = TemplateController::saveImage($image, $folder, $name, $width, $height);

                }else{

                    $saveImageNew = $_POST['old_image_new'];
                }
                
                
                $fields = "title_new=".trim(TemplateController::capitalize($_POST['title_new']))."&id_category_new=".$_POST['id_category_new'].
                "&intro_new=".$_POST['intro_new']."&body_new=".$_POST['body_new']."&image_new=".$saveImageNew;

                //echo '<pre>';print_r($fields);echo '</pre>';
                
            
                $url = "news?id=".base64_decode($_POST['idNew'])."&nameId=id_new&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                $method = "PUT";

                $updateData = CurlController::request($url,$method,$fields);

                // echo '<pre>';print_r($updateData);echo '</pre>';
                // return;
                if($updateData->status == 200){

                    $log = new ControllerLog();
                    $log->register($_SESSION['administrador']->email_admin, "EDICION NOTICIA", null);

                    echo '
                        <script>
                            // Función para mostrar una alerta de SweetAlert2
                            function showAlert() {
                                Swal.fire({
                                    title: "Correcto",
                                    icon: "success",
                                    text: "Noticia editada con éxito",
                                    confirmButtonColor: "#074A1F"
                                }).then((result) => {
                                    // Redirige al usuario después de cerrar la alerta
                                    if (result.isConfirmed) {
                                        window.location.href = "/admin/prensa";
                                    }
                                });
                            }
                            showAlert();
                    </script>';
                }else{

                    if($updateData->status == 303){

                        echo '    <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Error",
                                        icon: "error",
                                        text: "Token expirado, vuelva a iniciar sesión",
                                        confirmButtonColor: "#EF1400"
                                    });
                                }
                                showAlert();
                            </script>
                        ';
                    }else{

                        echo '    <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Error",
                                        icon: "error",
                                        text: "Error al guardar los datos, intente nuevamente",
                                        confirmButtonColor: "#EF1400"
                                    });
                                }
                                showAlert();
                            </script>
                        ';
                    }
                }

            }
            /*=============================================
            Creación Noticia
            =============================================*/
            else{


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

                    $log = new ControllerLog();
                    $log->register($_SESSION['administrador']->email_admin, "CREACION NOTICIA", null);

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
                }else{

                    if($createData->status == 303){

                        echo '    <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Error",
                                        icon: "error",
                                        text: "Token expirado, vuelva a iniciar sesión",
                                        confirmButtonColor: "#EF1400"
                                    });
                                }
                                showAlert();
                            </script>
                        ';

                    }else{


                        echo '    <script>
                                    // Función para mostrar una alerta de SweetAlert2
                                    function showAlert() {
                                        Swal.fire({
                                            title: "Error",
                                            icon: "error",
                                            text: "Error al guardar los datos, intente nuevamente",
                                            confirmButtonColor: "#EF1400"
                                        });
                                    }
                                    showAlert();
                                </script>
                            ';
                    }
                }
                
            }            
        }
    }
}

?>
