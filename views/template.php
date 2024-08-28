<?php

/*=============================================
Inicio variables de sesión
=============================================*/
ob_start();
session_start();

/*=============================================
Variable Path
=============================================*/
$path = TemplateController::path();

/*=============================================
Capturar las rutas de la URL 
(para esto previamente necesitamos 
crear y modificar el .htaccess)
=============================================*/
$routesArray = explode("/", trim($_SERVER["REQUEST_URI"], "/"));

foreach($routesArray as $key => $value){

    if(is_string($value) && strlen($value) > 0){
        // Separar el valor de la ruta si contiene parámetros de consulta
        $routesArray[$key] = explode("?", $value)[0];
    } else {
        $routesArray[$key] = "";
    }
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Gobierno de la Ciudad de Funes - Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="ThemeZaa">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description"
        content="Elevate your online presence with Crafto - a modern, versatile, multipurpose Bootstrap 5 responsive HTML5, SCSS template using highly creative 52+ ready demos.">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="<?php echo $path ?>/views/assets/images/favicon.png">
    <link rel="apple-touch-icon" href="images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style sheets and font icons -->
    <script src="https://kit.fontawesome.com/7ec756f6f3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/vendors.min.css" />
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/icon.min.css" />
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/responsive.css" />
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/demos/business/business.css" />
</head>

<body data-mobile-nav-style="classic">

<!-- Nav -->
<?php include "views/pages/home/modules/nav.php"; ?>

    <?php
    
        if(!empty($routesArray[0])){

            if($routesArray[0] == "turnos"){

                
                include 'pages/turnos/turnos.php';

            }

            if($routesArray[0] == "noticias"){

                include 'views/pages/noticias/noticias.php';
            }

            if($routesArray[0] == "home"){

                include 'views/pages/home/home.php';
            }

        }else{

            include 'pages/home/home.php';

        }

    ?>

<!-- Footer -->
<?php include "views/pages/home/modules/footer.php"; ?>

<!-- Stickys -->
<?php include "views/pages/home/modules/stickys.php"; ?>

    <!-- javascript libraries -->
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/vendors.min.js"></script>
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/main.js"></script>

</body>

</html>