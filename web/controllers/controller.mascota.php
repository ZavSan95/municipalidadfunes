<?php
require_once 'controllers/controller.log.php';
class MascotaController{

    public function validarMascota($data) {
        // Verificar si los campos requeridos están vacíos
        if (empty($data['nombre_mascota']) || empty($data['id_tutor_mascota']) || empty($data['id_especie_mascota']) || 
            empty($data['raza_mascota']) || empty($data['edad_mascota']) || empty($data['sexo_mascota']) || empty($data['color_mascota'])) {

            return "Todos los campos obligatorios deben estar completos.";
        }

        // Validar el nombre, raza y color
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['nombre_mascota'])) || 
            !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['raza_mascota'])) || 
            !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['color_mascota']))) {
            return "El nombre, raza y color solo pueden contener letras y espacios.";
        }

        // Validar la edad
        if (!preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/", trim($data['edad_mascota']))) {
            return "La edad solo puede contener letras, números y espacios.";
        }

        return true; // Todas las validaciones pasaron
    }

    public function mascotaManage(){

        /*=============================================
        Instancio métodos para validar
        =============================================*/
        $resultadoValidacion = $this->validarMascota($_POST);

        if(isset($_POST['nombre_mascota'])){


            /*=============================================
            Edición Mascota
            =============================================*/
            if(isset($_POST['idMascota'])){

                if($resultadoValidacion !== true){

                    echo '<script>
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "' . $resultadoValidacion . '",
                                confirmButtonColor: "#EF1400"
                            });
                        </script>';

                }else{

                    if(isset($_FILES['imagen_mascota']['tmp_name']) && !empty($_FILES['imagen_mascota']['tmp_name'])){

                        $url_image = TemplateController::generateUrl($_POST['nombre_mascota']);
    
                        $image = $_FILES['image_new'];
                        $folder = "assets/images/noticias/";
                    
                        // Generar un número aleatorio de 6 dígitos
                        $randomNumber = rand(100000, 999999);
                        $name = $randomNumber."_".$url_image."_".trim($_POST['id_tutor_mascota']);
                    
                        $width = 1000;
                        $height = 600;
                        
                    
                        unlink("views/assets/images/mascotas/".$_POST['old_imagen_mascota']); 

                        $saveImageMascota = TemplateController::saveImage($image, $folder, $name, $width, $height);
    
                    }else{
    
                        $saveImageMascota = $_POST['old_imagen_mascota'];
                    }
                    
                    
                    $fields = "nombre_mascota=".trim(TemplateController::capitalize($_POST['nombre_mascota']))."&id_tutor_mascota=".
                    $_POST['id_tutor_mascota']."&id_especie_mascota=".$_POST['id_especie_mascota']."&raza_mascota=".$_POST['raza_mascota'].
                    "&edad_mascota=".$_POST['edad_mascota']."&sexo_mascota=".$_POST['sexo_mascota']."&color_mascota=".$_POST['color_mascota'].
                    "&imagen_mascota=".$saveImageMascota;
    
                
                    $url = "mascotas?id=".base64_decode($_POST['idMascota'])."&nameId=id_mascota&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "PUT";
    
                    $updateData = CurlController::request($url,$method,$fields);
    
                    // echo '<pre>';print_r($updateData);echo '</pre>';
                    // return;
                    if($updateData->status == 200){
    
                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "EDICION MASCOTA", null);
    
                        echo '
                            <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Correcto",
                                        icon: "success",
                                        text: "Mascota editada con éxito",
                                        confirmButtonColor: "#074A1F"
                                    }).then((result) => {
                                        // Redirige al usuario después de cerrar la alerta
                                        if (result.isConfirmed) {
                                            window.location.href = "/admin/salud_animal/mascotas";
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
            Creación Mascota
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
                }else{

                    /*=============================================
                    Validar y Guardar Imagen
                    =============================================*/
                    if(isset($_FILES['imagen_mascota']['tmp_name']) && !empty($_FILES['imagen_mascota']['tmp_name'])){

                        $url_image = TemplateController::generateUrl($_POST['nombre_mascota']);

                        $image = $_FILES['imagen_mascota'];
                        $folder = "assets/images/mascotas/";

                        // Generar un número aleatorio de 6 dígitos
                        $randomNumber = rand(100000, 999999);
                        $name = $randomNumber."_".$url_image."_".trim($_POST['id_tutor_mascota']);

                        $width = 1000;
                        $height = 600;

                        $saveImageMascota = TemplateController::saveImage($image, $folder, $name, $width, $height);

                    }

                    /*=============================================
                    Validar y Guardar Datos
                    =============================================*/
                    $fields = array (

                        "nombre_mascota" => trim(TemplateController::capitalize($_POST['nombre_mascota'])),
                        "id_tutor_mascota" => $_POST['id_tutor_mascota'],
                        "id_especie_mascota" => $_POST['id_especie_mascota'],
                        "raza_mascota" => $_POST['raza_mascota'],
                        "edad_mascota" => $_POST['edad_mascota'],
                        "sexo_mascota" => $_POST['sexo_mascota'],
                        "color_mascota" => $_POST['color_mascota'],
                        "imagen_mascota" => $saveImageMascota,
                        "date_created_mascota" => date("Y-m-d")
                    );

                    //echo '<pre>'; print_r($fields);echo '</pre>';

                    $url = "mascotas?token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "POST";

                    $createData = CurlController::request($url,$method,$fields);

                    if($createData->status == 200){

                        $log = new ControllerLog();
                        $log->register($_SESSION['administrador']->email_admin, "CREACION MASCOTA", null);

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
                                        window.location.href = "/admin/salud_animal/mascotas";
                                    }
                                });
                            }
                            showAlertSuccess("Éxito","success","Nueva mascota creada");

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