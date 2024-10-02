
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gestión Reclamos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Reclamos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php 
    
        if(!empty($routesArray[2])){

            if($routesArray[2] == "gestion"){

                include 'modules/gestion.php';

            }else if($routesArray[2] == "visor"){

                include 'modules/visor.php';
            }
            
            else {

                echo '
                    <script>
                        window.location = "'.$path.'404";
                    </script>
                ';
            }

        }else {

            include 'modules/listado.php'; 
        }
    
    ?>

    
</div>

<!-- DropZone -->
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<script src="<?php echo $path ?>/views/assets/js/dropzone.js"></script>