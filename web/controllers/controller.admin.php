<?php

require_once 'controllers/controller.log.php';

class AdminsController{

    /*=============================================
    Login de Administradores
    =============================================*/
    public function login(){

        if(isset($_POST['loginAdminEmail'])){

            if(preg_match('/^([\w\.-]+@[\w\.-]+\.[\w]{2,4})$/', $_POST['loginAdminEmail'])){

                $url = "admins?login=true&suffix=admin";
                $method = "POST";
                $fields = array(

                    "email_admin" => trim($_POST["loginAdminEmail"]),
                    "password_admin" => trim($_POST['passwordAdmin'])

                );

                $login = CurlController::request($url,$method,$fields);

                if($login->status == 200){

                    // REGISTRO LOG INICIO SESIÓN
                    $log = new ControllerLog();
                    $log->register($_POST['loginAdminEmail'], "INICIO SESION");
                
                    // Almacena los datos del administrador en sesión
                    $_SESSION['administrador'] = $login->results[0];
                
                    // Redireccionar a la misma página sin datos POST para evitar reenvíos
                    echo '
                        <script>
                            localStorage.setItem("token-admin", "'.$login->results[0]->token_admin.'");
                            window.location.href = window.location.href; // Redirige y limpia el POST
                        </script>
                    ';
                
                } else {
                
                    // REGISTRO FALLO INICIO SESIÓN
                    $log = new ControllerLog();
                    $log->register($_POST['loginAdminEmail'], "INICIO SESION FALLIDO");
                
                    $error = null;
                
                    // Verifica el tipo de error
                    if($login->results == "Wrong email") {
                        $error = "Correo Incorrecto";
                    } else if($login->results == "Wrong password") {
                        $error = "Contraseña Incorrecta";
                    }
                
                    // Muestra la alerta de error
                    echo '
                        <div class="alert alert-danger mt-3">Error al ingresar: '.$error.'</div>
                        <script>
                            fncFormatInputs();
                        </script>
                    ';
                }

            }else{

                $error = 'Error de sintaxis en los campos';
                // Muestra la alerta de error
                echo '
                <div class="alert alert-danger mt-3">Error al ingresar: '.$error.'</div>
                <script>
                    fncFormatInputs();
                </script>
                ';

            }

            
            

        }
    }

    /*=============================================
    Reset Password
    =============================================*/
    public function resetPassword(){

        if(isset($_POST['resetPassword'])){

            if(preg_match('/^([\w\.-]+@[\w\.-]+\.[\w]{2,4})$/', $_POST['resetPassword'])){

                /*=============================================
                Verificamos si el usuario esta registrado
                =============================================*/

                $url = "admins?linkTo=email_admin&equalTo=".$_POST['resetPassword']."&select=id_admin";
                $method = "GET";
                $fields = array();

                $admin = CurlController::request($url,$method,$fields);

                //echo '<pre>';print_r($admin);echo '</pre>';
                if($admin->status == 200){

                    function genPassword($length){

                        $password = '';
                        $chain = "0123456789abcdefghijklmnopqrstuvwxyz";

                        $password = substr(str_shuffle($chain),0,$length);

                        return $password;

                    }

                    $newPassword = genPassword(11);
                    $crypt = crypt($newPassword, '$2a$07$azybxcags23425sdg23sdfhsd$');

                    /*=============================================
                    Actualizar Contraseña
                    =============================================*/
                    $url = "admins?id=".$admin->results[0]->id_admin."&nameId=id_admin&token=no&except=password_admin";
                    $method = "PUT";
                    $fields = "password_admin=".$crypt;

                    $updatePassword = CurlController::request($url,$method,$fields);
                    //echo '<pre>';print_r($updatePassword);echo '</pre>';

                    if($updatePassword->status == 200){
                        
                        // REGISTRO RESET PASSWORD
                        $log = new ControllerLog();
                        $log->register($_POST['resetPassword'], "RESET PASSWORD");
                        
                        // echo '<pre>';print_r($newPassword);echo '</pre>';
                        // echo '<pre>';print_r($crypt);echo '</pre>';
                        $subject = 'Solicitud de nueva contraseña';
                        $email = $_POST["resetPassword"];
                        $title ='SOLICITUD DE NUEVA CONTRASEÑA';
						$message = '<h4 style="font-weight: 100; color:#999; padding:0px 20px"><strong>Su nueva contraseña: '.$newPassword.'</strong></h4>
							<h4 style="font-weight: 100; color:#999; padding:0px 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>';
                        $link = TemplateController::path().'admin';

                        $sendMail = TemplateController::sendMail($subject, $email, $title, $message, $link);

                        if($sendMail == "ok"){

                        }

                    }

                }else{

                    $error = 'El correo no se encuentra registrado en el sistema';

                    // Muestra la alerta de error
                    echo '
                        <div class="alert alert-danger mt-3">Error al ingresar: '.$error.'</div>
                        <script>
                            fncFormatInputs();
                        </script>
                    ';
                }

            }

        }

    }

    /*=============================================
    Gestionar Administradores
    =============================================*/
    public function adminManage(){

        if(isset($_POST['name_admin'])){

            if(preg_match( '/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email_admin"] ) 
				&& preg_match( '/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["name_admin"] )){


                if(isset($_POST['idAdmin'])){

                    if($_POST['password_admin'] != ""){

                        if(preg_match('/^[*\\$\\!\\¡\\?\\¿\\.\\_\\#\\-\\0-9A-Za-z]{1,}$/', $_POST["password_admin"] )){

							$crypt = crypt($_POST["password_admin"], '$2a$07$azybxcags23425sdg23sdfhsd$');

						}else{

							echo '    <script>
                                    // Función para mostrar una alerta de SweetAlert2
                                    function showAlert() {
                                        Swal.fire({
                                            title: "Error",
                                            icon: "error",
                                            text: "Formato de contraseña incorrecto",
                                            confirmButtonColor: "#EF1400"
                                        }).then((result) => {
                                            // Redirige al usuario después de cerrar la alerta
                                            if (result.isConfirmed) {
                                                window.location.href = "/admin/administradores";
                                            }
                                        });
                                    }
                                    showAlert();
                                </script>
                            ';
						}

                    }else{

                        $crypt = crypt($_POST['oldPassword'], '$2a$07$azybxcags23425sdg23sdfhsd$');
                    }

                    $url = "admins?id=".base64_decode($_POST['idAdmin'])."&nameId=id_admin&token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "PUT";
                    $fields = "name_admin=".trim(TemplateController::capitalize($_POST["name_admin"])).
                    "&rol_admin=".$_POST["rol_admin"]."&email_admin=".$_POST["email_admin"]."&password_admin=".$crypt;

                    $updateData = CurlController::request($url,$method,$fields);

                    if($updateData->status == 200){

                        echo '    <script>
                            // Función para mostrar una alerta de SweetAlert2
                            function showAlert() {
                                Swal.fire({
                                    title: "Correcto",
                                    icon: "success",
                                    text: "Usuario editado con éxito",
                                    confirmButtonColor: "#074A1F"
                                }).then((result) => {
                                    // Redirige al usuario después de cerrar la alerta
                                    if (result.isConfirmed) {
                                        window.location.href = "/admin/administradores";
                                    }
                                });
                            }
                            showAlert();
                        </script>
                    ';
            

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

                    if(preg_match('/^[*\\$\\!\\¡\\?\\¿\\.\\_\\#\\-\\0-9A-Za-z]{1,}$/', $_POST["password_admin"] )){

                        $crypt = crypt($_POST["password_admin"], '$2a$07$azybxcags23425sdg23sdfhsd$');

                    }else{

                        echo '    <script>
                                // Función para mostrar una alerta de SweetAlert2
                                function showAlert() {
                                    Swal.fire({
                                        title: "Error",
                                        icon: "error",
                                        text: "Formato de contraseña incorrecto",
                                        confirmButtonColor: "#EF1400"
                                    });
                                }
                                showAlert();
                            </script>
                        ';
                    }
            
                    $url = "admins?token=".$_SESSION['administrador']->token_admin."&table=admins&suffix=admin";
                    $method = "POST";

                    $fields = array(

                        "name_admin" => trim(TemplateController::capitalize($_POST['name_admin'])),
                        "rol_admin" => $_POST['rol_admin'],
                        "email_admin" => $_POST['email_admin'],
                        "password_admin" => $crypt,
                        "date_created_admin" => date("Y-m-d")

                    );

                    $createData = CurlController::request($url,$method,$fields);

                    if($createData->status == 200){

                        echo '    <script>
                            // Función para mostrar una alerta de SweetAlert2
                            function showAlert() {
                                Swal.fire({
                                    title: "Correcto",
                                    icon: "success",
                                    text: "Usuario generado con éxito",
                                    confirmButtonColor: "#074A1F"
                                }).then((result) => {
                                    // Redirige al usuario después de cerrar la alerta
                                    if (result.isConfirmed) {
                                        window.location.href = "/admin/administradores";
                                    }
                                });
                            }
                            showAlert();
                        </script>
                    ';
            

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