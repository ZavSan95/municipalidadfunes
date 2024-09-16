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
                    echo '<pre>';print_r($updatePassword);echo '</pre>';

                    if($updatePassword->status == 200){

                        // REGISTRO FALLO INICIO SESIÓN
                        $log = new ControllerLog();
                        $log->register($_POST['loginAdminEmail'], "RESET PASSWORD");

                        echo '<pre>';print_r($newPassword);echo '</pre>';
                        echo '<pre>';print_r($crypt);echo '</pre>';
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

}