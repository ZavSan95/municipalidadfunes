<?php
require_once 'controllers/controller.log.php';

class TutorController {

    
    public function validarTutor($data) {
        // Verificar si los campos requeridos están vacíos
        if (empty($data['nombre_tutor']) || empty($data['apellido_tutor']) || empty($data['dni_tutor']) || 
            empty($data['celular_tutor']) || empty($data['mail_tutor']) || empty($data['direccion_tutor'])) {

            return "Todos los campos obligatorios deben estar completos.";
        }

        // Validar el nombre y apellido
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['nombre_tutor'])) || 
            !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['apellido_tutor']))) {
            return "El nombre y apellido solo pueden contener letras y espacios.";
        }

        // Validar la dirección del tutor
        if (!preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['direccion_tutor']))) {
            return "La dirección solo puede contener letras, números y espacios.";
        }

        // Validar el DNI
        if (!preg_match("/^\d{7,8}$/", trim($data['dni_tutor']))) {
            return "El DNI debe ser un número válido de 7 u 8 dígitos.";
        }

        // Validar el celular
        if (!preg_match("/^\d{10}$/", trim($data['celular_tutor']))) {
            return "El número de celular debe contener 10 dígitos.";
        }

        // Validar el correo electrónico
        if (!filter_var(trim($data['mail_tutor']), FILTER_VALIDATE_EMAIL)) {
            return "Correo electrónico inválido.";
        }

        return true; // Todas las validaciones pasaron
    }

    public function validateRepeatData($data) {

        if(isset($data['dni_tutor']) && !empty($data['dni_tutor'])){
            $url = "tutores?select=dni_tutor&linkTo=dni_tutor&equalTo=".$data['dni_tutor'];
            $method = "GET";
            $fields = array();
    
            $validateData = CurlController::request($url, $method, $fields);
    
            if ($validateData->status == 200) {
    
                return "Los datos del tutor ya existen en la base de datos";
    
            } else {
                
                return true;
            }
        }
    }

    public function tutorManage() {

        /*=============================================
        Instancio métodos para validar
        =============================================*/
        $resultadoRepeticion = $this->validateRepeatData($_POST);
        $resultadoValidacion = $this->validarTutor($_POST);

        if (isset($_POST['dni_tutor']) && !empty($_POST['dni_tutor'])) {

            /*=============================================
            Edición Tutor
            =============================================*/
            if (isset($_POST['idTutor']) && !empty($_POST['idTutor'])) {
                if($resultadoValidacion !== true){

                    echo '<script>
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "' . $resultadoValidacion . '",
                                confirmButtonColor: "#EF1400"
                            });
                        </script>';
                } 
                else{
                    $fields = "nombre_tutor=".trim(TemplateController::capitalize($_POST['nombre_tutor'])).
                    "&apellido_tutor=".trim(TemplateController::capitalize($_POST['apellido_tutor'])).
                    "&dni_tutor=".$_POST['dni_tutor'].
                    "&mail_tutor=".trim(TemplateController::capitalize($_POST['mail_tutor'])).
                    "&celular_tutor=".trim(TemplateController::capitalize($_POST['celular_tutor'])).
                    "&direccion_tutor=".trim(TemplateController::capitalize($_POST['direccion_tutor']));

                    $url = "tutores?id=".base64_decode($_POST['idTutor'])."&nameId=id_tutor&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "PUT";
                    $updateData = CurlController::request($url,$method,$fields);

                    if($updateData->status == 200){

                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "EDICION TUTOR", null);

                        echo '
                            <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Correcto",
                                        icon: "success",
                                        text: "Tutor editado con éxito",
                                        confirmButtonColor: "#074A1F"
                                    }).then((result) => {
                                        // Redirige al usuario después de cerrar la alerta
                                        if (result.isConfirmed) {
                                            window.location.href = "/admin/salud_animal/tutores";
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
            Creación Tutor
            =============================================*/
            else {

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
                    Guardar Datos
                    =============================================*/
                    $fields = array(
                        "nombre_tutor" => trim($_POST['nombre_tutor']),
                        "apellido_tutor" => trim($_POST['apellido_tutor']),
                        "dni_tutor" => $_POST['dni_tutor'],
                        "celular_tutor" => trim($_POST['celular_tutor']),
                        "mail_tutor" => trim($_POST['mail_tutor']),
                        "direccion_tutor" => trim($_POST['direccion_tutor']),
                        "date_created_tutor" => date("Y-m-d")
                    );

                    $url = "tutores?token=" . $_SESSION['administrador']->token_admin . "&table=admins&suffix=admin";
                    $method = "POST";

                    $createData = CurlController::request($url, $method, $fields);

                    if ($createData->status == 200) {
                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "CREACION TUTOR", null);

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
                                            window.location.href = "/admin/salud_animal/tutores";
                                        }
                                    });
                                }
                                showAlertSuccess("Éxito", "success", "Nuevo tutor creado");
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
