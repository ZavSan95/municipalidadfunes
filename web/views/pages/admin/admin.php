<?php include 'modules/links.php'; ?>


<?php

if(!isset($_SESSION['administrador'])){

  include 'login/login.php';

}else{

  include 'administrador/administrador.php';

}

?>


<?php include 'modules/scripts.php'; ?>