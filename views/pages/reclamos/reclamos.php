<link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/styles/preloader_spinner.css">
<link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/styles/paginas_reclamos.css">

<?php include 'pages/top.php'; ?>

<!-- start section -->
<section id="down-section">
    <div class="container">
        <div class="row">
            <div class="col-12 px-0 position-relative">
                
                <?php include 'pages/preloader.php'; ?>


                <?php include 'pages/paginador.php'; ?>

                <?php include 'pages/formularios.php'; ?>

            </div>
        </div>
    </div>

</section>
<!-- end section -->



<script src="<?php echo $path ?>/views/assets/js/preloader.js"></script>
<script src="<?php echo $path ?>/views/assets/js/paginas_reclamos.js"></script>