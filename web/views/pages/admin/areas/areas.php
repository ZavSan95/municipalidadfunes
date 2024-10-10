
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Áreas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Áreas</li>
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

            }else{

                echo '
                    <script>
                        window.location = "'.$path.'404";
                    </script>
                ';
            }

        }else{

            include 'modules/listado.php'; 
        }
    
    ?>

    
</div>