<?php

class AdminsController{

    /*=============================================
    Login de Administradores
    =============================================*/
    public function login(){

        if(isset($_POST['loginAdminEmail'])){

            $url = "admins?login=true&suffix=admin";
            $method = "POST";
            $fields = array(

                "email_admin" => trim($_POST["loginAdminEmail"]),
                "password_admin" => trim($_POST['passwordAdmin'])

            );

            $login = CurlController::request($url,$method,$fields);

            if($login->status == 200){

                //echo'<pre>';print_r($login);echo'</pre>';
                $_SESSION['administrador'] = $login->results[0];
                
                echo '
                    <script>
                        location.reload();
                    </script>
                ';

            }

        }
    }

}