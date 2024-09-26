        <!-- Sliders -->
        <section class="section-dark p-0 bg-dark-gray"> 
            <div class="swiper lg-no-parallax magic-cursor  full-screen md-h-600px sm-h-500px ipad-top-space-margin swiper-light-pagination" data-slider-options='{ "slidesPerView": 1, "loop": true, "parallax": true, "speed": 1000, "pagination": { "el": ".swiper-pagination-bullets", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 4000, "disableOnInteraction": false },  "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
                <div class="swiper-wrapper">

                    <?php 

                        require_once 'controllers/controller.curl.php';

                        $select = "id_slide,title_slide,intro_slide,image_slide,date_created_slide";
                        $url = "slides?select=".$select;
                        $method = "GET";
                        $fields = array();

                        $slides = CurlController::request($url,$method,$fields);
                        if($slides-> status == 200){

                            $slides = $slides->results;

                        }else{

                            $slides = array();
                        }


                        foreach($slides as $slide){

                    ?>

                            <!-- start slider item -->
                            <div class="swiper-slide overflow-hidden">
                                <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" 
                                    style="background-image:url('<?php echo $path ?>/views/assets/images/slides/<?php echo $slide->image_slide ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                                    <div class="opacity-light bg-gradient-sherpa-blue-black"></div>
                                    <div class="container h-100" data-swiper-parallax="-500">
                                        <div class="row align-items-center h-100">
                                            <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-white text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                                <div>
                                                    <span class="fs-20 opacity-6 mb-25px sm-mb-15px d-inline-block fw-300"><?php echo $slide->intro_slide ?></span>
                                                </div>
                                                <h1 class="alt-font w-90 xl-w-100 text-shadow-double-large ls-minus-2px"><span class="fw-600"><?php echo $slide->title_slide ?></span></h1>
                                                <a href="index.html" target="_blank" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Ver más<span class="bg-white text-base-color"><i class="fas fa-arrow-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end slider item -->

                    
                    <?php

                        }
                        
                    ?>
                    
                    <!-- start slider item -->
                    <!-- <div class="swiper-slide overflow-hidden">
                        <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" style="background-image:url('<?php echo $path ?>/views/assets/images/DSC_1369.jpg');">
                            <div class="opacity-light bg-gradient-sherpa-blue-black"></div>
                            <div class="container h-100" data-swiper-parallax="-500">
                                <div class="row align-items-center h-100">
                                    <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-white text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                        <div>
                                            <span class="fs-20 opacity-6 mb-25px sm-mb-15px d-inline-block fw-300">Funes, el jardín de la provincia</span>
                                        </div>
                                        <h1 class="alt-font w-90 xl-w-100 text-shadow-double-large ls-minus-2px">Descubre la <span class="fw-600">mejor ciudad para vivir.</span></h1>
                                        <a href="index.html" target="_blank" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Conoce más<span class="bg-white text-base-color"><i class="fas fa-arrow-right"></i></span></a>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-minus-45px" data-anime='{ "translateY": [150, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'><span class="alt-font number text-base-color opacity-3 fs-190 fw-600 ls-minus-5px">01</span></div>
                            </div>
                        </div>
                    </div> -->
                    <!-- end slider item -->

                    <!-- start slider item -->
                    <!-- <div class="swiper-slide overflow-hidden">
                        <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" style="background-image:url('<?php echo $path ?>/views/assets/images/DSC_1599.jpg');">
                            <div class="opacity-light bg-gradient-sherpa-blue-black"></div>
                            <div class="container h-100" data-swiper-parallax="-500">
                                <div class="row align-items-center h-100">
                                    <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-white text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                        <div>
                                            <span class="fs-20 opacity-6 mb-25px sm-mb-15px d-inline-block fw-300">Vive el encanto de Funes</span>
                                        </div>
                                        <h1 class="alt-font w-90 xl-w-100 text-shadow-double-large ls-minus-2px">Actividades y <span class="fw-600">eventos para todos.</span></h1>
                                        <a href="index.html" target="_blank" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Participa ahora<span class="bg-white text-base-color"><i class="fa-solid fa-arrow-right"></i></span></a>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-minus-45px" data-anime='{ "translateY": [150, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'><span class="alt-font number text-base-color opacity-3 fs-190 fw-600 ls-minus-5px">02</span></div>
                            </div>
                        </div>
                    </div> -->
                    <!-- end slider item -->

                    <!-- start slider item -->
                    <!-- <div class="swiper-slide overflow-hidden">
                        <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" style="background-image:url('<?php echo $path ?>/views/assets/images/DSC_3795.jpg');">
                            <div class="opacity-light bg-gradient-sherpa-blue-black"></div>
                            <div class="container h-100" data-swiper-parallax="-500">
                                <div class="row align-items-center h-100">
                                    <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-white text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                        <div>
                                            <span class="fs-20 opacity-6 mb-25px sm-mb-15px d-inline-block fw-300">Una ciudad para disfrutar</span>
                                        </div>
                                        <h1 class="alt-font w-90 xl-w-100 text-shadow-double-large ls-minus-2px">Experiencia única en <span class="fw-600">cada rincón.</span></h1>
                                        <a href="index.html" target="_blank" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Visítanos<span class="bg-white text-base-color"><i class="fa-solid fa-arrow-right"></i></span></a>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-minus-45px" data-anime='{ "translateY": [150, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'><span class="alt-font number text-base-color opacity-3 fs-190 fw-600 ls-minus-5px">03</span></div>
                            </div>
                        </div>
                    </div> -->                    
                    <!-- end slider item -->
                </div>
                <!-- start slider pagination -->
                <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
                <!-- end slider pagination -->
                <!-- start slider navigation -->
                <!--<div class="slider-one-slide-prev-1 icon-extra-large text-white swiper-button-prev slider-navigation-style-06 d-none d-sm-inline-block"><i class="line-icon-Arrow-OutLeft"></i></div>
                    <div class="slider-one-slide-next-1 icon-extra-large text-white swiper-button-next slider-navigation-style-06 d-none d-sm-inline-block"><i class="line-icon-Arrow-OutRight"></i></div>-->
                <!-- end slider navigation -->
            </div>
        </section>
        <!-- end section -->