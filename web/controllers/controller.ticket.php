<?php

class TicketController{


    public function ticketManage(){

        if(isset($_POST['title_ticket']) && !empty($_POST['title_ticket'])){

            /*=============================================
            Edición Ticket
            =============================================*/
            if(isset($_POST['idTicket']) && !empty($_POST['idTicket'])){


            }
            /*=============================================
            Creación Ticket
            =============================================*/
            else{

                /*=============================================
                Generar random number para el nombre
                =============================================*/
                $randomNumber = rand(100000, 999999);

                $codigoTicket = $randomNumber."_".trim($_POST['id_admin_ticket']);

                /*=============================================
                Validar y Guardar Imagen
                =============================================*/
                if(isset($_FILES['image_ticket']['tmp_name']) && !empty($_FILES['image_ticket']['tmp_name'])){

                    $url_image = TemplateController::generateUrl($_POST['title_ticket']);

                    $image = $_FILES['image_ticket'];
                    $folder = "assets/images/tickets/";

                    // Generar un número aleatorio de 6 dígitos
                    $randomNumber = rand(100000, 999999);
                    $name = $randomNumber."_".$url_image;

                    $width = 1000;
                    $height = 600;

                    $saveImageTicket = TemplateController::saveImage($image, $folder, $name, $width, $height);

                }
                
                /*=============================================
                Validar y Guardar Datos
                =============================================*/
                $fields = array (

                    "title_ticket" => trim(TemplateController::capitalize($_POST['title_ticket'])),
                    "id_ticketcategory_ticket" => $_POST['id_ticketcategory_ticket'],
                    "id_tarea_ticket" => $_POST['id_tarea_ticket'],
                    "id_admin_ticket" => $_POST['id_admin_ticket'],
                    "id_estado_ticket" => $_POST['id_estado_ticket'],
                    "descripcion_ticket" => $_POST['descripcion_ticket'],
                    "image_ticket" => $saveImageTicket,
                    "date_created_ticket" => date("Y-m-d")
                );

                //echo '<pre>'; print_r($fields);echo '</pre>';

                $url = "tickets?token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                $method = "POST";

                $createData = CurlController::request($url,$method,$fields);
            
                if($createData->status == 200){

                    require_once 'controllers/controller.log.php';
                    $log = new ControllerLog();
                    $log->register($_SESSION['administrador']->email_admin, "CREACION TICKET", null);

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
                                    window.location.href = "/admin/servicio_tecnico";
                                }
                            });
                        }
                        showAlertSuccess("Éxito","success","Nuevo ticket creado");

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