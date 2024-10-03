
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mascotas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/salud_animal">Salud Animal</a></li>
                        <li class="breadcrumb-item active">Mascotas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<?php 
    if(isset($routesArray[3]) && !empty($routesArray[3])){

        if($routesArray[3] == "gestion"){

            include 'modules/gestion.php';

        }else if($routesArray[3] == "historias"){

            include 'modules/historias.php';
            
        }else{

            echo '
                <script>
                    window.location = "'.$path.'404";
                </script>
            ';
        }

    }else{

        // Si no hay un cuarto parámetro en la URL, incluye listado.php
        include 'modules/listado.php'; 
    }
?>

    
</div>