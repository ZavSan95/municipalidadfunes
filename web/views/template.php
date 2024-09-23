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

<!DOCTYPE html>
<html lang="en">

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
    <meta name="author" content="DesarrolloWebSZ">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="Municipalidad de Funes, Santa Fe, Argentina">

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


    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet"
        type="text/css" />

    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo $path ?>views/assets/css/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo $path ?>views/assets/css/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo $path ?>views/assets/css/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Toast Alerts -->
    <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/toastr/toastr.min.css">

    <!-- Summernote -->


    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $path ?>/views/pages/admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/customs/customs.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- summernote -->
    <!-- https://summernote.org/getting-started/#run-summernote -->
    <link rel="stylesheet" href="<?php echo $path ?>/views/assets/summernote/summernote.min.css">



</head>



<body data-mobile-nav-style="classic" id="body-main">

    <input type="hidden" id="urlPath" value="<?php echo $path ?>">

    <!-- Nav -->
    <?php include "views/pages/home/modules/nav.php"; ?>

    <!-- jQuery -->
    <script src="<?php echo $path ?>views/assets/js/plugins/jquery/jquery.min.js"></script>

    <?php if (!empty($routesArray[0]) && $routesArray[0] == "admin"): ?>

    <!-- Bootstrap 4 -->
    <script src="<?php echo $path ?>views/assets/js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <?php else: ?>

    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php endif ?>

    <!-- JDSlider -->
    <script src="<?php echo $path ?>views/assets/js/plugins/jdSlider/jdSlider.js"></script>

    <!-- Knob -->
    <script src="<?php echo $path ?>views/assets/js/plugins/knob/knob.js"></script>

    <!-- SCRIPTS -->

    <!-- Paginación-->
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/plugins/pagination/pagination.min.js">
    </script>


    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/eb4a62b60b.js" crossorigin="anonymous"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alerts -->
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/alerts.js"></script>

    <!-- Forms -->

    <!-- Alerts -->
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/forms.js"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo $path ?>/views/pages/admin/dist/js/adminlte.js"></script>

    <!-- SummerNote -->
    <script src="<?php echo $path ?>/views/assets/summernote/summernote.min.js"></script>

    <?php

    // echo "<pre>"; var_dump($routesArray); echo "</pre>";
    
    // Si $routesArray está vacío, redirige a la página de inicio
if (empty($routesArray[0])) {
    include 'views/pages/home/home.php';
} else {
    // Si $routesArray no está vacío, verifica las posibles rutas
    if ($routesArray[0] == "admin" ||
        $routesArray[0] == "salir"
    ) {

        echo "<style>
        header, #piePagina {
            display: none;
        }
        
        </style>";
        //MODULO ADMINISTRACIÓN 
        echo "<script>  
                document.addEventListener('DOMContentLoaded', () => {

                    const nav = document.querySelector('header');
                    const footer = document.querySelector('#piePagina');

                    nav.style.display = 'none';

                });
            </script>";

        include 'pages/'.$routesArray[0].'/'.$routesArray[0].'.php';
        
    } elseif ($routesArray[0] == "saludanimal") {
        include 'pages/saludanimal/saludanimal.php';

    } elseif ($routesArray[0] == "comercios") {
        include 'pages/comercios/comercios.php';

    } elseif ($routesArray[0] == "gobierno") {
        include 'pages/gobierno/gobierno.php';

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
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/vendors.min.js"></script>
    <script type="text/javascript" src="<?php echo $path ?>/views/assets/js/main.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Toast Alerts -->
    <script src="<?php echo $path ?>views/assets/js/plugins/toastr/toastr.min.js"></script>




</body>

</html>