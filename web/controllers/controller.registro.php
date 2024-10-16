<?php
require_once 'controllers/controller.log.php';

class RegistroController{

    // Método para validar si un campo contiene solo letras y espacios
    public function validarSoloLetrasYEspacios($campo, $nombreCampo){
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($campo))) {
            return "El campo {$nombreCampo} solo puede contener letras y espacios.";
        }
        return true; // Si pasa la validación
    }

    // Método para verificar si los campos requeridos están vacíos
    public function validarCamposRequeridos($campos) {
        foreach ($campos as $campo => $nombreCampo) {
            if (!isset($campo) || empty(trim($campo))) {
                return "El campo {$nombreCampo} es obligatorio y no puede estar vacío.";
            }
        }
        return true; // Si todos los campos están completos
    }

    public function validarReclamo($data) {
        // Campos requeridos
        $camposRequeridos = [
            'id_restado_registro' => 'Estado del registro',
            'id_prioridad_registro' => 'Prioridad',
            'nombre_registro' => 'Nombre',
            'dni_registro' => 'DNI',
            'id_rzona_registro' => 'Zona',
            'direccion_registro' => 'Dirección',
            'telefono_registro' => 'Teléfono',
            'observacion_registro' => 'Observación',
            'id_equipo_registro' => 'Equipo',
            'id_trabajo_registro' => 'Trabajo',
            'bancarizacion_registro' => 'Bancarización',
            'acceso_registro' => 'Acceso',
            'utrabajo_registro' => 'Último Trabajo',
            'informe_registro' => 'Informe'
        ];
    
        // Validar si los campos requeridos están completos
        foreach ($camposRequeridos as $key => $nombreCampo) {
            if (!isset($data[$key]) || empty(trim($data[$key]))) {
                return "El campo {$nombreCampo} es obligatorio y no puede estar vacío.";
            }
        }
    
        // Validar campos de solo letras y espacios
        $camposTexto = [
            'nombre_registro' => 'Nombre',
            'bancarizacion_registro' => 'Bancarización',
            'acceso_registro' => 'Acceso',
            'utrabajo_registro' => 'Último Trabajo',
        ];
    
        foreach ($camposTexto as $campo => $nombreCampo) {
            if (isset($data[$campo])) {
                $validacionTexto = $this->validarSoloLetrasYEspacios($data[$campo], $nombreCampo);
                if ($validacionTexto !== true) {
                    return $validacionTexto; // Retorna el error si no pasa la validación
                }
            }
        }
    
        // Validar el DNI
        if (isset($data['dni_registro']) && !preg_match("/^\d{7,8}$/", trim($data['dni_registro']))) {
            return "El DNI debe ser un número válido de 7 u 8 dígitos.";
        }
    
        // Validar el celular
        if (isset($data['telefono_registro']) && !preg_match("/^\d{10}$/", trim($data['telefono_registro']))) {
            return "El número de celular debe contener 10 dígitos.";
        }
    
        return true; // Todas las validaciones pasaron
    }
    

    public function registroManage(){
        
        /*=============================================
        Instancio métodos para validar
        =============================================*/
        $validarDatos = $this->validarReclamo($_POST);

        if(isset($_POST['nombre_registro']) && !empty($_POST['nombre_registro'])){


            /*=============================================
            Edición Registro
            =============================================*/
            if(isset($_POST['idRegistro']) && !empty($_POST['idRegistro'])){

                if($validarDatos !== true){

                    echo '<script>
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "' . $validarDatos . '",
                                confirmButtonColor: "#EF1400"
                            });
                        </script>';
                }else{

                    $fields = "id_restado_registro=".$_POST['id_restado_registro']."&id_prioridad_registro=".$_POST['id_prioridad_registro'].
                    "&nombre_registro=".trim(TemplateController::capitalize($_POST['nombre_registro'])).
                    "&dni_registro=".trim($_POST['dni_registro']).
                    "&id_rzona_registro=".$_POST['id_rzona_registro'].
                    "&direccion_registro=".trim(TemplateController::capitalize($_POST['direccion_registro'])).
                    "&telefono_registro=".trim(TemplateController::capitalize($_POST['telefono_registro'])).
                    "&observacion_registro=".trim($_POST['observacion_registro'])."&id_equipo_registro=".$_POST['id_equipo_registro'].
                    "&id_trabajo_registro=".$_POST['id_trabajo_registro']."&bancarizacion_registro=".trim($_POST['bancarizacion_registro']).
                    "&acceso_registro=".trim($_POST['acceso_registro'])."&utrabajo_registro=".$_POST['utrabajo_registro'].
                    "&informe_registro=".urlencode($_POST['informe_registro']);

                    $url = "registros?id=".base64_decode($_POST['idRegistro'])."&nameId=id_registro&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "PUT";
                    $updateData = CurlController::request($url,$method,$fields);

                    if($updateData->status == 200){

                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "EDICION REGISTRO", null);
    
                        echo '
                            <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Correcto",
                                        icon: "success",
                                        text: "Registro editado con éxito",
                                        confirmButtonColor: "#074A1F"
                                    }).then((result) => {
                                        // Redirige al usuario después de cerrar la alerta
                                        if (result.isConfirmed) {
                                            window.location.href = "/admin/inclusion_social";
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
            Creación Registro
            =============================================*/
            else{

                if($validarDatos !== true){

                    echo '<script>
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "' . $validarDatos . '",
                                confirmButtonColor: "#EF1400"
                            });
                        </script>';
                }else{

                    /*=============================================
                    Validar y Guardar Datos
                    =============================================*/
                    $fields = array (

                        "id_restado_registro" => $_POST['id_restado_registro'],
                        "id_prioridad_registro" => $_POST['id_prioridad_registro'],
                        "nombre_registro" => trim(TemplateController::capitalize($_POST['nombre_registro'])),
                        "dni_registro" => trim($_POST['dni_registro']),
                        "id_rzona_registro" => $_POST['id_rzona_registro'],
                        "direccion_registro" => trim($_POST['direccion_registro']),
                        "telefono_registro" => trim($_POST['telefono_registro']),
                        "observacion_registro" => trim($_POST['observacion_registro']),
                        "id_equipo_registro" => $_POST['id_equipo_registro'],
                        "id_trabajo_registro" => $_POST['id_trabajo_registro'],
                        "bancarizacion_registro" => trim($_POST['bancarizacion_registro']),
                        "acceso_registro" => trim($_POST['acceso_registro']),
                        "utrabajo_registro" => $_POST['utrabajo_registro'],
                        "informe_registro" => urlencode($_POST['informe_registro']),
                        "date_created_registro" => date('Y-m-d')
                    );

                    $url = "registros?token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "POST";
    
                    $createData = CurlController::request($url,$method,$fields);
    
                    if($createData->status == 200){
    
                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "CREACION REGISTRO", null);
    
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
                                        window.location.href = "/admin/inclusion_social";
                                    }
                                });
                            }
                            showAlertSuccess("Éxito","success","Nuevo registro creado");
    
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
}
