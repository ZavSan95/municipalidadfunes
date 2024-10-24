<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5"
    style="background-image: url()">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px"
                    data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    Comercios</h1>
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

<!-- Portal de Trámites -->
<section class="bg-solitude-blue">
    <div class="container" id="tramitesComercio">
        <div class="row align-items-center"
            data-anime='{ "el": "childs", "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 150, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-xl-3 col-lg-4 col-md-12 tab-style-05 md-mb-30px sm-mb-20px">
                <!-- start tab navigation -->
                <ul class="nav nav-tabs justify-content-center border-0 text-left fw-500 fs-18 alt-font">
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four1"
                            class="nav-link d-flex align-items-center active"><i
                                class="feather icon-feather-credit-card icon-extra-medium text-dark-gray"></i><span>RENOVACIÓN
                                HABILITACIÓN COMERCIAL</span></a></li>
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four2"
                            class="nav-link d-flex align-items-center"><i
                                class="feather icon-feather-shopping-bag icon-extra-medium text-dark-gray"></i><span>REGISTRO
                                COMERCIOS PUBLICACIÓN APP</span></a></li>
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four3"
                            class="nav-link d-flex align-items-center"><i
                                class="feather icon-feather-file-text icon-extra-medium text-dark-gray"></i><span>PREINSCRIPCIÓN
                                TRANSPORTISTAS</span></a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four4"><i
                                class="feather icon-feather-calendar icon-extra-medium text-dark-gray"></i><span>PREINSCRIPCIÓN
                                COMERCIOS</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four5"><i
                                class="feather icon-feather-calendar icon-extra-medium text-dark-gray"></i><span>REGISTRO
                                PROVEEDORES</span></a>
                    </li>
                </ul>
                <!-- end tab navigation -->
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="tab-content">
                    <!-- start tab content for TGI -->
                    <div class="tab-pane fade in active show" id="tab_four1">
                        <div class="d-flex flex-column justify-content-center align-items-center d-col">
                            <?php include 'formularios/renovacion/renovacion.php'; ?>
                        </div>
                    </div>
                    <!-- end tab content -->


                    <div class="tab-pane fade" id="tab_four2">

                    </div>

                    <div class="tab-pane fade" id="tab_four3">

                    </div>

                    <div class="tab-pane fade" id="tab_four4">

                    </div>

                    <div class="tab-pane fade" id="tab_four5">

                    </div>

                    <div class="tab-pane fade" id="tab_four6">

                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
