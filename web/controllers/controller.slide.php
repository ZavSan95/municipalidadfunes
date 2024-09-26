<?php
require_once 'controllers/controller.log.php';
class SlideController {

    public function slidesManage(){

        if(isset($_POST['title_slide'])){

            // Comprobar si el título está vacío
            if (empty(trim($_POST['title_slide']))) {
                // Establecer el mensaje de error en la sesión
                $_SESSION['error-form'] = "Complete los campos requeridos";
                return; 
            }

            if(isset($_POST['idSlide'])){

                // echo '<pre>';print_r($_POST);echo '</pre>';
                // return;

                
                if(isset($_FILES['image_slide']['tmp_name']) && !empty($_FILES['image_slide']['tmp_name'])){

                    $url_image = TemplateController::generateUrl($_POST['title_slide']);

                    $image = $_FILES['image_slide'];
                    $folder = "assets/images/slides/";
                
                    // Generar un número aleatorio de 6 dígitos
                    $randomNumber = rand(100000, 999999);
                    $name = $randomNumber . "_" . $url_image;
                
                
                    unlink("views/assets/images/slides/".$_POST['old_image_slide']); // Eliminar la imagen vieja
                
                    // Guardar la nueva imagen
                    $saveImageSlide = TemplateController::saveImageOriginal($image, $folder, $name);


                }else{

                    $saveImageSlide = $_POST['old_image_slide'];
                }
                
                
                $fields = "title_slide=".trim(TemplateController::capitalize($_POST['title_slide'])).
                "&intro_slide=".$_POST['intro_slide']."&image_slide=".$saveImageSlide;

                //echo '<pre>';print_r($fields);echo '</pre>';
                
            
                $url = "slides?id=".base64_decode($_POST['idSlide'])."&nameId=id_slide&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                $method = "PUT";

                $updateData = CurlController::request($url,$method,$fields);

                // echo '<pre>';print_r($updateData);echo '</pre>';
                // return;
                if($updateData->status == 200){

                    $log = new ControllerLog();
                    $log->register($_SESSION['administrador']->email_admin, "EDICION SLIDE", null);

                    echo '
                        <script>
                            // Función para mostrar una alerta de SweetAlert2
                            function showAlert() {
                                Swal.fire({
                                    title: "Correcto",
                                    icon: "success",
                                    text: "Slide editada con éxito",
                                    confirmButtonColor: "#074A1F"
                                }).then((result) => {
                                    // Redirige al usuario después de cerrar la alerta
                                    if (result.isConfirmed) {
                                        window.location.href = "/admin/slides";
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

            }else{

                /*=============================================
                Validar y Guardar Imagen
                =============================================*/
                if(isset($_FILES['image_slide']['tmp_name']) && !empty($_FILES['image_slide']['tmp_name'])){

                    $url_image = TemplateController::generateUrl($_POST['title_slide']);

                    $image = $_FILES['image_slide'];
                    $folder = "assets/images/slides/";

                    // Generar un número aleatorio de 6 dígitos
                    $randomNumber = rand(100000, 999999);
                    $name = $randomNumber."_".$url_image;


                    $saveImageSlide = TemplateController::saveImageOriginal($image, $folder, $name);

                }

                /*=============================================
                Validar y Guardar Datos
                =============================================*/
                $fields = array (

                    "title_slide" => trim(TemplateController::capitalize($_POST['title_slide'])),
                    "intro_slide" => $_POST['intro_slide'],
                    "image_slide" => $saveImageSlide,
                    "date_created_slide" => date("Y-m-d")
                );

                //echo '<pre>'; print_r($fields);echo '</pre>';

                $url = "slides?token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                $method = "POST";

                $createData = CurlController::request($url,$method,$fields);
                
                //echo '<pre>'; print_r($createData);echo '</pre>';
                if($createData->status == 200){

                    $log = new ControllerLog();
                    $log->register($_SESSION['administrador']->email_admin, "CREACION SLIDE", null);

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
                                    window.location.href = "/admin/slides";
                                }
                            });
                        }
                        showAlertSuccess("Éxito","success","Nueva slide creada");

                        </script>';
                }
                
            }            
        }
    }
}