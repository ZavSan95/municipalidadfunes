<?php

class ReclamoController{

    public function reclamoManage(){

        if(isset($_POST['cuenta_reclamo']) && !empty($_POST['cuenta_reclamo'])){

            /*=============================================
            Generar random number para el nombre
            =============================================*/
            $randomNumber = rand(100000, 999999);

            $codigoReclamo = $randomNumber."_".trim($_POST['cuenta_reclamo']);

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
                    "&correo_reclamo=".trim($_POST['correo_reclamo'])."&date_created_reclamo=".date("Y-m-d");

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
                                            window.location.href = "/admin/gestor_reclamos";
                                        }
                                    });
                                }
                                showAlert();
                        </script>';
                        
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
