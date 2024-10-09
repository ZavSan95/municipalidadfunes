<?php
require_once 'controllers/controller.log.php';
class HistoriaController{

    public function validarHistoria($data) {
        // Verificar si los campos requeridos están vacíos
        if (empty($data['id_mascota_historia']) || empty($data['id_veterinario_historia']) || empty($data['id_tipoconsulta_historia']) || 
            empty($data['peso_historia']) || empty($data['detalle_historia'])) {

            return "Todos los campos obligatorios deben estar completos.";
        }

        return true; // Todas las validaciones pasaron
    }

    public function historiaManage(){

        $resultadoValidacion = $this->validarHistoria($_POST);

        if(isset($_POST['id_mascota_historia']) && $_POST['id_mascota_historia'] != null){

            /*=============================================
            Validaciones
            =============================================*/                
            if ($resultadoValidacion !== true) {
                echo '<script>
                        Swal.fire({
                            title: "Error",
                            icon: "error",
                            text: "' . $resultadoValidacion . '",
                            confirmButtonColor: "#EF1400"
                        });
                    </script>';
            }else{



                /*=============================================
                Validar y Guardar Datos
                =============================================*/
                $fields = array (

                    "id_mascota_historia" => $_POST['id_mascota_historia'],
                    "fecha_hora_historia" => date('Y-m-d H:i:s'),
                    "id_veterinario_historia" => $_POST['id_veterinario_historia'],
                    "id_tipoconsulta_historia" => $_POST['id_tipoconsulta_historia'],
                    "peso_historia" => $_POST['peso_historia'],
                    "detalle_historia" => $_POST['detalle_historia'],
                    "date_created_historia" => date('Y-m-d')
                );

                //echo '<pre>'; print_r($fields);echo '</pre>';

                $url = "historias?token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                $method = "POST";

                $createData = CurlController::request($url,$method,$fields);

                if($createData->status == 200){

                    $log = new ControllerLog();
                    $log->register($_SESSION['administrador']->email_admin, "CREACION HISTORIA", $_POST['id_mascota_historia']);

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
                                    window.location.href = "/admin/salud_animal/mascotas/historias?mascota='.base64_encode($_POST['id_mascota_historia']).'";
                                }
                            });
                        }
                        showAlertSuccess("Éxito","success","Nueva historia creada");

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