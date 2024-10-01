<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5"
    style="background-image: url()">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px"
                    data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    Trámites Online</h1>
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
    <div class="container">
        <div class="row align-items-center"
            data-anime='{ "el": "childs", "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 150, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-xl-3 col-lg-4 col-md-12 tab-style-05 md-mb-30px sm-mb-20px">
                <!-- start tab navigation -->
                <ul class="nav nav-tabs justify-content-center border-0 text-left fw-500 fs-18 alt-font">
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four1"
                            class="nav-link d-flex align-items-center active"><i
                                class="feather icon-feather-credit-card icon-extra-medium text-dark-gray"></i><span>TGI</span></a></li>
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four2"
                            class="nav-link d-flex align-items-center"><i
                                class="feather icon-feather-shopping-bag icon-extra-medium text-dark-gray"></i><span>TGR</span></a></li>
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four3"
                            class="nav-link d-flex align-items-center"><i
                                class="feather icon-feather-file-text icon-extra-medium text-dark-gray"></i><span>CEMENTERIO</span></a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four4"><i
                                class="feather icon-feather-calendar icon-extra-medium text-dark-gray"></i><span>DREI</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four5"><i
                                class="feather icon-feather-calendar icon-extra-medium text-dark-gray"></i><span>PATENTES</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four6"><i
                                class="fa-solid fa-car-burst icon-extra-medium text-dark-gray"></i><span>API</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four7"><i
                            class="fa-solid fa-car-burst icon-extra-medium text-dark-gray"></i><span>INFRACCIONES</span></a>
                    </li>
                </ul>
                <!-- end tab navigation -->
            </div>
            <script>
                $(document).ready(function() {
                    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                        var target = $(e.target).attr("href"); 
                        var iframe = $(target).find('iframe');
                        iframe.attr('src', iframe.attr('src')); // recarga el iframe
                    });
                });
            </script>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="tab-content">
                    <!-- start tab content for TGI -->
                    <div class="tab-pane fade in active show" id="tab_four1">
                        <div class="d-flex">
                            <!-- Contenido de texto o elementos adicionales -->
                            <div class="flex-fill">
                                <!-- Aquí podrías añadir otros elementos o contenido que quieras mostrar al lado del iframe -->
                            </div>
                            <!-- Iframe para TGI -->
                            <div class="flex-shrink-1" style="flex-basis: 600px;">
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px">Ingrese su Tasa de TGI</h5>
                                <iframe class="tramites" frameborder="0" scrolling="no" src="https://funesonline.funes.gob.ar:4443/cgi-bin/menuurbanos.exe?ingreso" width="100%" height="300px"></iframe>
                            </div>
                        </div>
                    </div>
                    <!-- end tab content -->
                    
                    <!-- start tab content for TGR -->
                    <div class="tab-pane fade" id="tab_four2">
                        <!-- Content for TGR -->
                        <div class="d-flex">
                            <!-- Contenido de texto o elementos adicionales -->
                            <div class="flex-fill">
                                <!-- Aquí podrías añadir otros elementos o contenido que quieras mostrar al lado del iframe -->
                            </div>
                            <!-- Iframe para TGI -->
                            <div class="flex-shrink-1" style="flex-basis: 600px;">
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px">Ingrese su Tasa de TGR</h5>
                                <iframe class="tramites" frameborder="0" scrolling="no" src="https://funesonline.funes.gob.ar:4443/cgi-bin/menururales.exe?ingreso" width="100%" height="300px"></iframe>
                            </div>
                        </div>
                    </div>
                    <!-- end tab content for TGR -->

                    
                    <!-- start tab content for CEMENTERIO -->
                    <div class="tab-pane fade" id="tab_four3">
                        <!-- Content for CEMENTERIO -->
                        <div class="d-flex">
                            <!-- Contenido de texto o elementos adicionales -->
                            <div class="flex-fill">
                                <!-- Aquí podrías añadir otros elementos o contenido que quieras mostrar al lado del iframe -->
                            </div>
                            <!-- Iframe para TGI -->
                            <div class="flex-shrink-1" style="flex-basis: 600px;">
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px">Ingrese su Tasa de Cementerio</h5>
                                <iframe class="tramites" frameborder="0" scrolling="no" src="https://funesonline.funes.gob.ar:4443/cgi-bin/menucementerio.exe?ingreso" width="100%" height="300px"></iframe>
                            </div>
                        </div>
                    </div>
                    <!-- end tab content for CEMENTERIO -->
                    
                    <!-- start tab content for DREI -->
                    <div class="tab-pane fade" id="tab_four4">
                        <!-- Content for DREI -->

                        <div class="d-flex">
                            <!-- Contenido de texto o elementos adicionales -->
                            <div class="flex-fill">
                                <!-- Aquí podrías añadir otros elementos o contenido que quieras mostrar al lado del iframe -->
                            </div>
                            <!-- Iframe para TGI -->
                            <div class="flex-shrink-1" style="flex-basis: 600px;">
                                <span style="color:#FF0000"><strong>NO SE ACEPTAN MÁS TRANSFERENCIAS BANCARIAS</strong></span></span></strong><br />
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px">Ingrese su DREI</h5>
                                <iframe class="tramites" frameborder="0" scrolling="no" src="https://funesonline.funes.gob.ar:4443/cgi-bin/menucomercio.exe?ingreso" width="100%" height="300px"></iframe>
                            </div>
                        </div>

                    </div>
                    <!-- end tab content for DREI -->
                    
                    
                    <!-- start tab content for PATENTES -->
                    <div class="tab-pane fade" id="tab_four5">
                        <!-- Content for PATENTES -->
                       <div class="flex-fill">
                                <!-- Aquí podrías añadir otros elementos o contenido que quieras mostrar al lado del iframe -->
                            </div>
                            <!-- Iframe para TGI -->
                            <div class="flex-shrink-1" style="flex-basis: 600px;">
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px">Patentes</h5>
                                <iframe class="tramites" frameborder="0" scrolling="no" src="https://www.funes.gob.ar/patente.php" width="100%" height="700px"></iframe>
                            </div>
                    </div>
                    <!-- end tab content for PATENTES -->

                    <!-- start tab content for API -->
                    <div class="tab-pane fade" id="tab_four6">
                        <!-- Content for API -->
                        <div class="flex-fill">
                                <!-- Aquí podrías añadir otros elementos o contenido que quieras mostrar al lado del iframe -->
                            </div>
                            <!-- Iframe para TGI -->
                            <div class="flex-shrink-1" style="flex-basis: 600px;">
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px">API</h5>
                                <iframe class="tramites" frameborder="0" scrolling="no" src="https://www.funes.gob.ar/api.php" width="100%" height="700px"></iframe>
                            </div>
                    </div>
                    <!-- end tab content for API -->

                    <!-- start tab content for INFRACCIONES -->
                    <div class="tab-pane fade" id="tab_four7">
                        <!-- Content for INFRACCIONES -->
                        <div class="flex-fill">
                                <!-- Aquí podrías añadir otros elementos o contenido que quieras mostrar al lado del iframe -->
                            </div>
                            <!-- Iframe para TGI -->
                            <div class="flex-shrink-1" style="flex-basis: 600px;">
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px">INFRACCIONES</h5>
                                <iframe class="tramites" frameborder="0" scrolling="no" src="https://funesonline.funes.gob.ar:4443/cgi-bin/menuvehiculo.exe?ingreso" width="100%" height="300px"></iframe>
                            </div>
                    </div>
                    <!-- end tab content for INFRACCIONES -->
                    
                </div>
            </div>
        </div>
    </div>
</section>
