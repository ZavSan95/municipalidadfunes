<?php
require_once 'controllers/controller.log.php';

class AreaController{

    public function validarArea($data){

        // Verificar si los campos requeridos están vacíos
        if (empty($data['nombre_area'])) {

            return "Todos los campos obligatorios deben estar completos.";
        }

        // Validar el nombre y apellido
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['nombre_area']))) {
            return "El nombre solo puede contener letras y espacios.";
        }

        return true;

    }

    public function validarRepeatArea($data){



        $url = "areas?linkTo=url_area&equalTo=".$data;
        $method = "GET";
        $fields = array();

        $validateData = CurlController::request($url, $method, $fields);

    
        if ($validateData->status == 200) {

            return "El área ya existe en la base de datos";

        } else if ($validateData->status == 404) {
            
            return true;

        }else{

            return "Error al buscar área";
        }
    }
    public function areaManage(){


        if(isset($_POST['nombre_area'])){


            $urlArea = trim(TemplateController::generateUrl($_POST['nombre_area']));

            /*=============================================
            Instancio métodos para validar
            =============================================*/
            $resultadoRepeticion = $this->validarRepeatArea($urlArea);
            $resultadoValidacion = $this->validarArea($_POST);

            /*=============================================
            Edición Área
            =============================================*/ 
            if(isset($_POST['idArea']) && !empty($_POST['idArea'])){

                /*=============================================
                Validaciones
                =============================================*/ 
                if($resultadoValidacion !== true){

                    echo '<script>
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "' . $resultadoValidacion . '",
                                confirmButtonColor: "#EF1400"
                            });
                        </script>';
                }  else if ($resultadoRepeticion !== true) {
                    echo '<script>
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "' . $resultadoRepeticion . '",
                                confirmButtonColor: "#EF1400"
                            });
                        </script>';
                }
                else{

                    $fields = "nombre_area=".trim($_POST['nombre_area'])."&url_area=".$urlArea;

                    $url = "areas?id=".base64_decode($_POST['idArea'])."&nameId=id_area&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "PUT";
                    $updateData = CurlController::request($url,$method,$fields);

                    if($updateData->status == 200){

                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "EDICION AREA}", null);

                        echo '
                            <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Correcto",
                                        icon: "success",
                                        text: "Área editada con éxito",
                                        confirmButtonColor: "#074A1F"
                                    }).then((result) => {
                                        // Redirige al usuario después de cerrar la alerta
                                        if (result.isConfirmed) {
                                            window.location.href = "/admin/areas";
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
            }
            /*=============================================
            Creación Área
            =============================================*/ 
            else{

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
                } else if ($resultadoRepeticion !== true) {
                    echo '<script>
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "' . $resultadoRepeticion . '",
                                confirmButtonColor: "#EF1400"
                            });
                        </script>';
                } else {

                    /*=============================================
                    Validar y Guardar Datos
                    =============================================*/
                    $fields = array (

                        "nombre_area" => trim(TemplateController::upperCase($_POST['nombre_area'])),
                        "url_area" => $urlArea,
                        "date_created_area" => date("Y-m-d")
                    );

                    $url = "areas?token=" . $_SESSION['administrador']->token_admin . "&table=admins&suffix=admin";
                    $method = "POST";

                    $createData = CurlController::request($url, $method, $fields);

                    if ($createData->status == 200) {
                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "CREACION AREA", null);

                        echo '<script>
                                fncFormatInputs();

                                function showAlertSuccess(title, type, text) {
                                    Swal.fire({
                                        title: title,
                                        icon: type,
                                        text: text,
                                        confirmButtonColor: "#074A1F"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "/admin/areas";
                                        }
                                    });
                                }
                                showAlertSuccess("Éxito", "success", "Nueva área creada");
                            </script>';
                    } else {
                        if ($createData->status == 303) {
                            echo '<script>
                                    Swal.fire({
                                        title: "Error",
                                        icon: "error",
                                        text: "Token expirado, vuelva a iniciar sesión",
                                        confirmButtonColor: "#EF1400"
                                    });
                                </script>';
                        } else {
                            echo '<script>
                                    Swal.fire({
                                        title: "Error",
                                        icon: "error",
                                        text: "Error al guardar los datos, intente nuevamente",
                                        confirmButtonColor: "#EF1400"
                                    });
                                </script>';
                        }
                    }
                }
            }
        }
    
    }
}