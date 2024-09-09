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
    <title style="text-transform: capitalize;">Gobierno de la Ciudad de Funes - 
    <?php 
        if(!empty($routesArray[0])){

            echo ucwords($routesArray[0]);

        }else{

            echo "Home";
        }
    ?></title>
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
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/vendors.min.css" />
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/icon.min.css" />
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/responsive.css" />
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/demos/business/business.css" />

    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Paginación-->
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/plugins/pagination/pagination.min.js"></script>
    

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/eb4a62b60b.js" crossorigin="anonymous"></script>

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alerts -->
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/alerts.js"></script>




</head>

<body data-mobile-nav-style="classic">

<!-- Nav -->
<?php include "views/pages/home/modules/nav.php"; ?>

<?php

    // echo "<pre>"; var_dump($routesArray); echo "</pre>";
    
    // Si $routesArray está vacío, redirige a la página de inicio
if (empty($routesArray[0])) {
    include 'views/pages/home/home.php';
} else {
    // Si $routesArray no está vacío, verifica las posibles rutas
    if ($routesArray[0] == "admin") {

        //MODULO ADMINISTRACIÓN
        
    } elseif ($routesArray[0] == "turnos") {
        include 'pages/turnos/turnos.php';

    } elseif ($routesArray[0] == "noticias") {
        include 'views/pages/noticias/noticias.php';

    }elseif ($routesArray[0] == "ciudad") {
        include 'views/pages/ciudad/ciudad.php';

    } elseif ($routesArray[0] == "reclamos") {
        include 'views/pages/reclamos/reclamos.php';

    } elseif ($routesArray[0] == "tramites") {
        include 'views/pages/tramites/tramites.php';

    } elseif ($routesArray[0] == "contacto") {
        include 'views/pages/contacto/contacto.php';

    } elseif ($routesArray[0] == "higiene_urbana") {
        include 'views/pages/higiene/higiene_urbana.php';

    } else {
        // Si no coincide con ninguna ruta, muestra la página 404
        include 'pages/404/404.php';
    }
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