
<?php
if(isset($routesArray[1]) && !empty($routesArray[1])){

    // echo '<pre>';print_r($routesArray);echo '</pre>';
    $urlNew = $routesArray[1];

    $select = "title_new,url_new,intro_new,body_new,image_new,date_created_new,name_category";
    $url = "relations?rel=news,categories&type=new,category&linkTo=url_new&equalTo=".$urlNew."&select=".$select;
    $method = "GET";
    $fields = array();

    $new = CurlController::request($url,$method,$fields);
    // echo'<pre>';print_r($new);echo'</pre>';
    // return;
    if($new->status == 200){

        $new = $new->results[0];
    }else{

        echo '
        <script>
            window.location = "'.$path.'404";
        </script>
        ';
    }
}


?>

    <section class="one-fourth-screen bg-dark-gray ipad-top-space-margin sm-mb-50px" 
    data-parallax-background-ratio="0.5" 
    style="background-image: url('<?php echo !empty($new->image_new) ? "/views/assets/images/noticias/{$new->image_new}" : "https://via.placeholder.com/125x125"; ?>');">
    </section>


        <section class="p-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 overlap-section text-center">
                        <div class="p-10 box-shadow-extra-large border-radius-4px bg-white text-center">
                            <a href="demo-business-blog.html" 
                            class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-500 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-3 sm-mb-15px">
                            <?php echo $new ? htmlspecialchars($new->name_category) : 'Categoría no disponible'; ?>   
                            </a>
                            <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px mb-15px">
                            <?php echo $new ? htmlspecialchars($new->title_new) : 'Título no disponible'; ?>
                            </h3>
                            <div class="lg-20px sm-mb-0">
                            <span><?php echo $new ? date('d F Y', strtotime($new->date_created_new)) : 'Fecha no disponible'; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="overlap-section text-center p-0 sm-pt-30px">
            <img class="rounded-circle box-shadow-extra-large w-130px h-130px border border-8 border-color-white" 
            src="<?php echo $new ? '/views/assets/images/noticias/' . ($new->image_new) : 'https://via.placeholder.com/125x125'; ?>" 
            alt=""> 
        </section>

        <section class="pb-0 pt-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 dropcap-style-01" 
                    data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <p class="mb-6"><?php echo $new ? $new->body_new : 'Contenido no disponible.'; ?></p>
                    </div>
                </div>
            </div>
        </section>


        <?php include "views/pages/home/modules/news.php"; ?>