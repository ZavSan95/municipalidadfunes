        <!-- Noticias -->
        <section class="position-relative overflow-hidden sm-pb-20px"> 
            <div class="separator-line-9px bg-base-color position-absolute top-0px right-0px" data-bottom-top="width: 15%" data-center-top="width: 50%;"></div>
            <div class="container">
                <div class="row justify-content-center mb-2">
                    <div class="col-xl-7 col-lg-9 col-md-10 text-center">
                        <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Últimas Noticias</span>
                        <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Mantenete informado de las últimas novedades en la ciudad</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 px-md-0">
                        <ul class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <li class="grid-sizer"></li>

                            <?php 

                            $select = "id_new,title_new,name_category,image_new,date_created_new";
                            $url = "relations?rel=news,categories&type=new,category&select=".$select."&startAt=0&endAt=4&orderBy=date_created_new&orderMode=DESC";
                            $method = "GET";
                            $fields = array();

                            // Initialize $noticias to null or an empty array
                            $noticias = null;

                            // Make the request using the initialized $noticias variable
                            $noticias = CurlController::request($url, $method, $fields);

                            // Check if $noticias is an object and has a status property before accessing it
                            if($noticias && property_exists($noticias, 'status') && $noticias->status == 200){
                                
                                $noticias = $noticias->results;
                                
                            }else{

                                $noticias = array();

                            }

                            require_once('controllers/controller.new.php');
                            // Crear una instancia del controlador
                            $new = new NewController();
        
                            // Usar el método dateFormat para formatear la fecha
                            foreach ($noticias as $noticia) {
                                $fecha_formateada = $new->dateFormat($noticia->date_created_new);
                                ?>
        
                                <li class="news-item grid-item">
                                    <div class="news-card bg-transparent no-border h-100">
                                        <div class="image-container position-relative overflow-hidden border-radius-4">
                                            <a href="demo-business-blog-single-modern.html">
                                                <img src="<?php echo $path . '/views/assets/images/noticias/' . $noticia->image_new; ?>" alt="<?php echo htmlspecialchars($noticia->title_new); ?>" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="card-content px-3 pt-3 pb-3 xs-pb-2 no-margin">
                                            <span class="category-date fs-14 text-uppercase">
                                                <a href="#" class="category-link text-dark-gray fw-600"><?php echo htmlspecialchars($noticia->name_category); ?></a>
                                            </span>
                                            <span class="blog-date fs-14"><?php echo $fecha_formateada; ?></span>
                                            <a href="demo-business-blog-single-modern.html" class="news-title mb-2 fw-500 fs-18 lh-30 text-dark-gray d-inline-block"><?php echo htmlspecialchars($noticia->title_new); ?></a>
                                        </div>
                                    </div>
                                </li>
        
                                <?php
                            }

                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->