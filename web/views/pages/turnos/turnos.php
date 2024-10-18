<link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/styles/preloader_spinner.css">

<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5"
    style="background-image: url('<?php echo $path ?>/views/assets/images/turnos/banner_turnos.jpeg')">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px"
                    data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    Turnos Online</h1>
            </div>
            <div class="down-section text-center"
                data-anime='{ "translateY": [-15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <a href="#down-section" aria-label="scroll down" class="section-link">
                    <div
                        class="d-flex justify-content-center align-items-center mx-auto rounded-circle fs-30 text-white">
                        <i class="feather icon-feather-chevron-down"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<!-- start section -->
<section id="down-section">
    <div class="container">
        <div class="row">
            <div class="col-12 px-0 position-relative">
                <!-- start preloader -->
                <div id="preloader" class="preloader-iframe">
                    <div class="spinner"></div>
                </div>
                <!-- end preloader -->

                <iframe src="http://appointments.com/appointments/index.php" class="layout__turnos"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- end section -->




<script src="<?php echo $path ?>/views/assets/js/preloader.js"></script>

