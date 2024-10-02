<?php

class ReclamoController{

    public function reCaptcha(){

        $recaptchaSecret = '6Lfwo1UqAAAAAJi2Lv5C5IxBplCmR_Oo8Q-0NXhT'; // Clave secreta de reCAPTCHA v3
        $recaptchaResponse = $_POST['g-recaptcha-response'];

        // Verifica el token con la API de reCAPTCHA
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
        $responseData = json_decode($verifyResponse);
    
        // Verifica si la validación fue exitosa
        if ($responseData->success && $responseData->score >= 0.5) {
            // reCAPTCHA validado correctamente. Procesa el formulario
            // Aquí pones tu lógica para procesar los datos
            return true;
        } else {
            // Fallo en la validación de reCAPTCHA
            return false;
        }
    }

    public function validarReclamo($data) {

        //Verificar captcha
        if(!$this->reCaptcha()){

            return "Error al completar el captcha, intente nuevamente.";
        }

        // Verificar si los campos requeridos están vacíos
        if (empty($data['nombre_reclamo']) || empty($data['apellido_reclamo']) || empty($data['dni_reclamo']) || empty($data['celular_reclamo']) || empty($data['correo_reclamo']) || empty($data['detalle_reclamo'])) {
            return "Todos los campos obligatorios deben estar completos.";
        }
    
        // Validar el nombre y apellido
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['nombre_reclamo'])) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['apellido_reclamo']))) {
            return "El nombre y apellido solo pueden contener letras y espacios.";
        }

        //Validar detalle del reclamo
        // Validar el nombre y apellido
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['detalle_reclamo']))) {
            return "El detalle del reclamo solo pueden contener letras y espacios.";
        }
    
        // Validar el DNI
        if (!preg_match("/^\d{7,8}$/", trim($data['dni_reclamo']))) {
            return "El DNI debe ser un número válido de 7 u 8 dígitos.";
        }
    
        // Validar el celular
        if (!preg_match("/^\d{10}$/", trim($data['celular_reclamo']))) {
            return "El número de celular debe contener 10 dígitos.";
        }
    
        // Validar el correo electrónico
        if (!filter_var(trim($data['correo_reclamo']), FILTER_VALIDATE_EMAIL)) {
            return "Correo electrónico inválido.";
        }
    
        // Validar las coordenadas
        if (!is_numeric($data['latitud_reclamo']) || !is_numeric($data['longitud_reclamo']) || $data['latitud_reclamo'] < -90 || $data['longitud_reclamo'] < -180 || $data['latitud_reclamo'] > 90 || $data['longitud_reclamo'] > 180) {
            return "Coordenadas inválidas.";
        }
    
        // Validar imágenes si existen
        if (!empty($data['img_reclamo'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            foreach (json_decode($data['img_reclamo'], true) as $image) {
                if (strpos($image['type'], 'image') === false || !in_array($image['type'], $allowedTypes)) {
                    return "Uno de los archivos no es una imagen válida o tiene un formato no permitido.";
                }
    
                // Validar tamaño base64 (Ej: máx 2 MB)
                if (strlen(base64_decode($image['file'])) > 2097152) {
                    return "Una de las imágenes supera los 2 MB permitidos.";
                }
            }
        }

    
        return true; // Todas las validaciones pasaron
    }
    public function reclamoManage(){

        if(isset($_POST['cuenta_reclamo']) && !empty($_POST['cuenta_reclamo'])){

            /*=============================================
            Ediciòn reclamo
            =============================================*/
            if(isset($_POST['idReclamo']) && !empty($_POST['idReclamo'])){

                $idReclamo = $_POST['idReclamo'];
                $codReclamo = $_POST['codigoReclamo'];

                /*=============================================
                Guardar imágenes base64
                =============================================*/
                $galleryReclamo = []; // Inicializa aquí
                $galleryCount = 0;

                if (!empty($_POST['img_reclamo'])) {
                    foreach (json_decode($_POST['img_reclamo'], true) as $key => $value) {
                        $galleryCount++;

                        $image["tmp_name"] = $value["file"];
                        $image["type"] = $value["type"];
                        $image["mode"] = "base64";

                        $folder = "assets/images/reclamos/";
                        $name = $codReclamo . "_" . $key;
                        $width = 1000;
                        $height = 600;

                        $saveImageGallery = TemplateController::saveImage64($image, $folder, $name, $width, $height);
                        array_push($galleryReclamo, $saveImageGallery);
                    }
                }

                // Manejar imágenes viejas
                if (!empty($_POST['galleryOldReclamo'])) {
                    $galleryOldReclamo = json_decode($_POST['galleryOldReclamo'], true);

                    // Verificar que el valor decodificado es un array
                    if (is_array($galleryOldReclamo)) {
                        foreach ($galleryOldReclamo as $index => $item) {
                            array_push($galleryReclamo, $item);
                        }
                    }
                }

                // Convertir a JSON una vez después del bucle
                $images_reclamo = json_encode($galleryReclamo);



                /*=============================================
                Eliminación de imágenes borradas
                =============================================*/
                if (!empty($_POST['deleteGalleryReclamo'])) {
                    foreach (json_decode($_POST['deleteGalleryReclamo'], true) as $i => $img) {
                        unlink("views/assets/images/reclamos/" . $img);
                    }
                }

                $fields = 
                    "codigo_reclamo=".$codReclamo."&id_estado_reclamo=".$_POST['id_estado_reclamo'].
                    "&id_rcategory_reclamo=".$_POST['id_rcategory_reclamo']."&img_reclamo=".$images_reclamo.
                    "&latitud_reclamo=".$_POST['latitud_reclamo']."&longitud_reclamo=".$_POST['longitud_reclamo'].
                    "&cuenta_reclamo=".trim($_POST['cuenta_reclamo'])."&deuda_reclamo=".$_POST['deuda_reclamo'].
                    "&id_zona_reclamo=".$_POST['id_zona_reclamo']."&direccion_reclamo=".trim($_POST['direccion_reclamo']).
                    "&nombre_reclamo=".trim($_POST['nombre_reclamo'])."&apellido_reclamo=".trim($_POST['apellido_reclamo']).
                    "&dni_reclamo=".trim($_POST['dni_reclamo'])."&celular_reclamo=".trim($_POST['celular_reclamo']).
                    "&correo_reclamo=".trim($_POST['correo_reclamo'])."&date_created_reclamo=".date("Y-m-d").
                    "&detalle_reclamo=".trim($_POST['detalle_reclamo']);

                $url = "reclamos?id=".$_POST['idReclamo']."&nameId=id_reclamo&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                $method = "PUT";

                $updateReclamo = CurlController::request($url,$method,$fields);

                if($updateReclamo->status == 200){

                    require_once 'controllers/controller.log.php';
                    $log = new ControllerLog();
                    $log->register($_SESSION['administrador']->email_admin, "EDICION RECLAMO", null);

                        echo '
                            <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Correcto",
                                        icon: "success",
                                        text: "Reclamo editado con éxito",
                                        confirmButtonColor: "#074A1F"
                                    }).then((result) => {
                                        // Redirige al usuario después de cerrar la alerta
                                        if (result.isConfirmed) {
                                            window.location.href = "/admin/gestor_reclamos";
                                        }
                                    });
                                }
                                showAlert();
                        </script>';
                }else{

                    if($updateReclamo->status == 303){

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
            Creación reclamo
            =============================================*/
            else{

                $resultadoValidacion = $this->validarReclamo($_POST);
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
                    Generar random number para el codigo reclamo
                    =============================================*/
                    $randomNumber = rand(100000, 999999);

                    $codigoReclamo = $randomNumber."_".trim($_POST['cuenta_reclamo']);


                    /*=============================================
                    Guardar imagenes base64
                    =============================================*/
                    if(!empty($_POST['img_reclamo'])){

                        $galleryReclamo = array();
                        $galleryCount = 0;

                        foreach(json_decode($_POST['img_reclamo'],true) as $key => $value){

                            $galleryCount++;

                            // echo '<pre>';print_r($value);echo'</pre>';
                            $image["tmp_name"] = $value["file"];
                            $image["type"] = $value["type"];
                            $image["mode"] = "base64";
                            
                            $folder = "assets/images/reclamos/";
                            $name = $codigoReclamo."_".$key;
                            $width = 1000;
                            $height = 600;

                            $saveImageGallery = TemplateController::saveImage64($image,$folder,$name,$width,$height);

                            array_push($galleryReclamo,$saveImageGallery);

                            if(count(json_decode($_POST['img_reclamo'],true)) == $galleryCount){

                                $images_reclamo = json_encode($galleryReclamo);
                            }

                        }
                    }

                    /*=============================================
                    Campos reclamo
                    =============================================*/
                    $fields = array(

                        //Datos reclamo
                        "codigo_reclamo" => $codigoReclamo,
                        "id_estado_reclamo" => $_POST['id_estado_reclamo'],
                        "id_rcategory_reclamo" => $_POST['id_rcategory_reclamo'],
                        "img_reclamo" => $images_reclamo,
                        "latitud_reclamo" => $_POST['latitud_reclamo'],
                        "longitud_reclamo" => $_POST['longitud_reclamo'],
                        "detalle_reclamo" => $_POST['detalle_reclamo'],

                        //Datos propiedad
                        "cuenta_reclamo" => trim($_POST['cuenta_reclamo']),
                        "deuda_reclamo" => $_POST['deuda_reclamo'],
                        "id_zona_reclamo" => $_POST['id_zona_reclamo'],
                        "direccion_reclamo" => trim($_POST['direccion_reclamo']),

                        //Datos personales
                        "nombre_reclamo" => trim($_POST['nombre_reclamo']),
                        "apellido_reclamo" => trim($_POST['apellido_reclamo']),
                        "dni_reclamo" => trim($_POST['dni_reclamo']),
                        "celular_reclamo" => trim($_POST['celular_reclamo']),
                        "correo_reclamo" => trim($_POST['correo_reclamo']),

                        "date_created_reclamo" => date("Y-m-d")

                    );

                    $fields['cuenta_reclamo'] = htmlspecialchars(trim($_POST['cuenta_reclamo']), ENT_QUOTES);
                    $fields['direccion_reclamo'] = htmlspecialchars(trim($_POST['direccion_reclamo']), ENT_QUOTES);
                    $fields['nombre_reclamo'] = htmlspecialchars(trim($_POST['nombre_reclamo']), ENT_QUOTES);
                    $fields['apellido_reclamo'] = htmlspecialchars(trim($_POST['apellido_reclamo']), ENT_QUOTES);
                    $fields['dni_reclamo'] = htmlspecialchars(trim($_POST['dni_reclamo']), ENT_QUOTES);
                    $fields['celular_reclamo'] = htmlspecialchars(trim($_POST['celular_reclamo']), ENT_QUOTES);
                    $fields['correo_reclamo'] = htmlspecialchars(trim($_POST['correo_reclamo']), ENT_QUOTES);

                    /*=============================================
                    Guardamos reclamo
                    =============================================*/

                    $url = "reclamos?token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "POST";

                    $createReclamo = CurlController::request($url,$method,$fields);

                    if($createReclamo->status == 200){

                        require_once 'controllers/controller.log.php';
                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "CREACION RECLAMO", null);
                        
                        $subject = 'Reclamos - Municipalidad de Funes';
                        $email = "noreply@funes.gob.ar";
                        $title ='GENERACIÓN DE RECLAMO';
                        $link = "#";

                        $message = '
                                    <div style="font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; padding: 20px;">
                                        <div style="background-color: #ffffff; max-width: 600px; margin: 0 auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px;">
                                            <h2 style="color: #074A1F; text-align: center;">Reclamo generado con éxito</h2>
                                            <p>Estimado/a <strong>' . trim($_POST['nombre_reclamo']) . ' ' . trim($_POST['apellido_reclamo']) . '</strong>,</p>
                                            <p>Su reclamo ha sido registrado correctamente en nuestro sistema.</p>
                                            <p><strong>Código de Reclamo:</strong> ' . $codigoReclamo . '</p>
                                            <p>Puede consultar el estado de su reclamo en cualquier momento accediendo a nuestra plataforma con el código proporcionado.</p>
                                            <p>Si tiene alguna duda o inquietud, no dude en ponerse en contacto con nosotros.</p>
                                            <br>
                                            <p style="text-align: center;">
                                                <a href="https://funes.gob.ar/reclamos/consultar" target="_blank" style="background-color: #074A1F; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Consultar Reclamo</a>
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

                            $reDirec = $_POST['redirec_reclamo'];

                            if($sendMail == "ok"){

                                // Verificar si $reDirec está vacío
                                $redirectUrl = empty($reDirec) ? "/admin/gestor_reclamos" : $reDirec;

                                echo '
                                <script>
                                    // Función para mostrar una alerta de SweetAlert2
                                    function showAlert() {
                                        Swal.fire({
                                            title: "Correcto",
                                            icon: "success",
                                            text: "Reclamo creado con éxito",
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
                                
                            }
                            
                    }else{

                        if($createReclamo->status == 303){

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
