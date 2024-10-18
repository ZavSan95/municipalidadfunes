<?php

if(!isset($routesArray[2]) && empty($routesArray[2])){

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Salud Animal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Salud Animal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
</div>


<?php    
} else if (!empty($routesArray[2]) && ($routesArray[2] == "mascotas" || (isset($routesArray[2]) && $routesArray[2] == "tutores"))) {

    if($routesArray[2] == "mascotas"){

        include 'mascotas/mascotas.php';

    } else if($routesArray[2] == "tutores"){

        include 'tutores/tutores.php';

    } else {

        echo '<script>
        window.location = "'.$path.'404";
     </script>';
    }
}else{

    echo '<script>
        window.location = "'.$path.'404";
     </script>';
}
?>