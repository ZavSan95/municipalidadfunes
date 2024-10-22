<?php
require_once 'controllers/controller.log.php';

class TurnoController{


    // Método para verificar si los campos requeridos están vacíos
    public function validarCamposRequeridos($campos) {
        foreach ($campos as $campo => $nombreCampo) {
            if (!isset($campo) || empty(trim($campo))) {
                return "El campo {$nombreCampo} es obligatorio y no puede estar vacío.";
            }
        }
        return true; // Si todos los campos están completos
    }

    public function validarSoloLetrasYEspacios($campo, $nombreCampo){
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($campo))) {
            return "El campo {$nombreCampo} solo puede contener letras y espacios.";
        }
        return true; // Si pasa la validación
    }

    public function validarTurno($data) {
        // Campos requeridos
        $camposRequeridos = [
            'id_dependencia_turno' => 'Dependencia',
            'id_servicio_turno' => 'Servicio',
            'fecha_turno' => 'Fecha del Turno',
            'horario_turno' => 'Horario del Turno',
            'nombre_turno' => 'Nombre y Apellido',
            'dni_turno' => 'DNI',
            'telefono_turno' => 'Teléfono',
            'direccion_turno' => 'Dirección',
            'correo_turno' => 'Correo Electrónico'
        ];
    
        // Validar si los campos requeridos están completos
        foreach ($camposRequeridos as $key => $nombreCampo) {
            if (!isset($data[$key]) || empty(trim($data[$key]))) {
                return "El campo {$nombreCampo} es obligatorio y no puede estar vacío.";
            }
        }
    
        // Validar campos de solo letras y espacios
        $camposTexto = [
            'nombre_turno' => 'Nombre y Apellido'
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
        if (isset($data['dni_turno']) && !preg_match("/^\d{7,8}$/", trim($data['dni_turno']))) {
            return "El DNI debe ser un número válido de 7 u 8 dígitos.";
        }
    
        // Validar el celular
        if (isset($data['telefono_turno']) && !preg_match("/^\d{10}$/", trim($data['telefono_turno']))) {
            return "El número de celular debe contener 10 dígitos.";
        }

        // Validar el correo electrónico
        if (!filter_var(trim($data['correo_turno']), FILTER_VALIDATE_EMAIL)) {
            return "Correo electrónico inválido.";
        }
    
        return true; // Todas las validaciones pasaron
    }

    public function validarTurnoEdit($data) {
        // Campos requeridos
        $camposRequeridos = [
            'dependencia' => 'Dependencia',
            'servicio' => 'Servicio',
            'fecha_turno' => 'Fecha del Turno',
            'horario_turno' => 'Horario del Turno',
            'nombre_turno' => 'Nombre y Apellido',
            'dni_turno' => 'DNI',
            'telefono_turno' => 'Teléfono',
            'direccion_turno' => 'Dirección',
            'correo_turno' => 'Correo Electrónico'
        ];
    
        // Validar si los campos requeridos están completos
        foreach ($camposRequeridos as $key => $nombreCampo) {
            if (!isset($data[$key]) || empty(trim($data[$key]))) {
                return "El campo {$nombreCampo} es obligatorio y no puede estar vacío.";
            }
        }
    
        // Validar campos de solo letras y espacios
        $camposTexto = [
            'nombre_turno' => 'Nombre y Apellido'
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
        if (isset($data['dni_turno']) && !preg_match("/^\d{7,8}$/", trim($data['dni_turno']))) {
            return "El DNI debe ser un número válido de 7 u 8 dígitos.";
        }
    
        // Validar el celular
        if (isset($data['telefono_turno']) && !preg_match("/^\d{10}$/", trim($data['telefono_turno']))) {
            return "El número de celular debe contener 10 dígitos.";
        }

        // Validar el correo electrónico
        if (!filter_var(trim($data['correo_turno']), FILTER_VALIDATE_EMAIL)) {
            return "Correo electrónico inválido.";
        }
    
        return true; // Todas las validaciones pasaron
    }

    // Función para obtener las fechas hábiles (lunes a viernes) de hoy a 30 días adelante
    function obtenerFechasHabiles($diasAdelante = 30) {
        $fechas = [];
        $fechaActual = new DateTime(); // Fecha de hoy

        while (count($fechas) < $diasAdelante) {
            $diaSemana = $fechaActual->format('N'); // 1 = Lunes, 7 = Domingo
            if ($diaSemana < 6) { // Si es un día hábil (Lunes a Viernes)
                $fechas[] = $fechaActual->format('Y-m-d');
            }
            $fechaActual->modify('+1 day'); // Avanzar al siguiente día
        }

        return $fechas;
    }


    function turnoManage(){

        /*=============================================
        Instancio métodos para validar
        =============================================*/
        $validarDatos = $this->validarTurno($_POST);
        $validarDatosEdit = $this->validarTurnoEdit($_POST);
        
        if(isset($_POST['nombre_turno']) && !empty($_POST['nombre_turno'])){
            
            /*=============================================
            Edición Turno
            =============================================*/
            if(isset($_POST['idTurno']) && !empty($_POST['idTurno'])){

                // echo '<pre>';print_r($_POST);echo '</pre>';
                // return;                

                if($validarDatosEdit !== true){

                    echo '<script>
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "' . $validarDatos . '",
                                confirmButtonColor: "#EF1400"
                            });
                        </script>';
                }else{

                    $inicio_turno = $_POST['horario_turno']; // Obtén la hora de inicio del POST
    
                    // Crea un objeto DateTime con la hora de inicio
                    $turnoDateTime = new DateTime($inicio_turno);
    
                    // Agrega 30 minutos para calcular la hora de finalización
                    $turnoDateTime->modify('+30 minutes');
    
                    // Formatea la hora de finalización
                    $fin_turno = $turnoDateTime->format('H:i'); // Formato HH:MM

                    $fields = "id_dependencia_turno=".$_POST['dependencia'].
                    "&id_servicio_turno=".$_POST['servicio']."&fecha_turno=".$_POST['fecha_turno'].
                    "&inicio_turno=".$inicio_turno."&fin_turno=".$fin_turno."&nombre_turno=".trim($_POST['nombre_turno']).
                    "&dni_turno=".trim($_POST['dni_turno'])."&telefono_turno=".trim($_POST['telefono_turno']).
                    "&direccion_turno=".trim($_POST['direccion_turno'])."&correo_turno=".trim($_POST['correo_turno']);

                    $url = "turnos?id=".base64_decode($_POST['idTurno'])."&nameId=id_turno&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "PUT";
    
                    $updateData = CurlController::request($url,$method,$fields);
    
                    //echo '<pre>';print_r($updateData);echo '</pre>';
                    //return;
                    if($updateData->status == 200){
    
                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "EDICION TURNO", null);
    
                        echo '
                            <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Correcto",
                                        icon: "success",
                                        text: "Turno editado con éxito",
                                        confirmButtonColor: "#074A1F"
                                    }).then((result) => {
                                        // Redirige al usuario después de cerrar la alerta
                                        if (result.isConfirmed) {
                                            window.location.href = "/admin/turnos/listado";
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
            Creación Turno
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

                    

                    //echo'<pre>';print_r($_POST);echo'</pre>';

                    $inicio_turno = $_POST['horario_turno']; // Obtén la hora de inicio del POST
    
                    // Crea un objeto DateTime con la hora de inicio
                    $turnoDateTime = new DateTime($inicio_turno);
    
                    // Agrega 30 minutos para calcular la hora de finalización
                    $turnoDateTime->modify('+30 minutes');
    
                    // Formatea la hora de finalización
                    $fin_turno = $turnoDateTime->format('H:i'); // Formato HH:MM
    
                    $fields = array (
    
                        "id_dependencia_turno" => $_POST['id_dependencia_turno'],
                        "id_servicio_turno" => $_POST['id_servicio_turno'],
                        "fecha_turno" => $_POST['fecha_turno'],
                        "inicio_turno" => $inicio_turno,
                        "fin_turno" => $fin_turno,
                        "nombre_turno" => trim($_POST['nombre_turno']),
                        "dni_turno" => trim($_POST['dni_turno']),
                        "telefono_turno" => trim($_POST['telefono_turno']),
                        "direccion_turno" => trim($_POST['direccion_turno']),
                        "correo_turno" => trim($_POST['correo_turno']),
                        "date_created_turno" => date('Y-m-d')
                    );
    
                    $url = "turnos?token=" . $_SESSION['administrador']->token_admin . "&table=admins&suffix=admin";
                    $method = "POST";
    
                    $createData = CurlController::request($url, $method, $fields);
                    //echo '<pre>';print_r($createData);echo'</pre>';
                    $subject = 'Turnos - Municipalidad de Funes';
                    $email = "noreply@funes.gob.ar";
                    $title ='GENERACIÓN DE TURNO';
                    $link = "#";

                    $message = '
                                <div style="font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; padding: 20px;">
                                    <div style="background-color: #ffffff; max-width: 600px; margin: 0 auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px;">
                                        <h2 style="color: #074A1F; text-align: center;">Turno generado con éxito</h2>
                                        <p>Estimado/a <strong>' . trim($_POST['nombre_turno']) .'</strong>,</p>
                                        <p>Su turno ha sido registrado correctamente en nuestro sistema.</p>
                                        <p><stron>Fecha: '.$_POST['fecha_turno'].'</stron></p>
                                        <p><stron>Horario: '.$inicio_turno.'</stron></p>
                                        <p>Si tiene alguna duda o inquietud, no dude en ponerse en contacto con nosotros.</p>
                                        <br>
                                        <p style="text-align: center;">
                                            <a href="#" target="_blank" style="background-color: #074A1F; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Consultar</a>
                                        </p>
                                        <br>
                                        <p>Saludos cordiales,</p>
                                        <p><strong>Municipalidad de Funes</strong></p>
                                        <hr>
                                        <p style="color: #999999; font-size: 12px;">Este correo electrónico fue generado automáticamente. Si no realizó esta solicitud, por favor ignórelo o contáctenos de inmediato.</p>
                                    </div>
                                </div>
                            ';

                        $sendMail = TemplateController::sendMail($subject, $email, $title, $message, $link);

                        $reDirec = $_POST['redirec_turno'];

                        if($sendMail == "ok"){

                            // Verificar si $reDirec está vacío
                            $redirectUrl = empty($reDirec) ? "/admin/turnos/listado" : $reDirec;

                            echo '
                            <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Correcto",
                                        icon: "success",
                                        text: "Turno creado con éxito",
                                        confirmButtonColor: "#074A1F"
                                    }).then((result) => {
                                        // Redirige al usuario después de cerrar la alerta
                                        if (result.isConfirmed) {
                                            window.location.href = "' . $redirectUrl . '";
                                        }
                                    });
                                }
                                showAlert();
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