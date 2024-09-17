<?php include 'modules/links.php'; ?>


<?php

if (!isset($_SESSION["administrador"])){

  include "login/login.php";

}else{

  include 'modules/preloader.php';

  include 'modules/navbar.php';

  include 'modules/sidebar.php';

  if(!empty($routesArray[1])){

    if($routesArray[1] == "administradores" 
      ){

      include $routesArray[1]."/".$routesArray[1].".php";

    }else{

      echo '<script>
         window.location = "'.$path.'404";
      </script>';
      
    }


  }else{

    include "tablero/tablero.php";

  }

  include 'modules/footer.php';

}

?>


<?php include 'modules/scripts.php'; ?>

<script src="<?php echo $path ?>/views/assets/js/tables.js"></script>