<?php
$endAt = 8;

if(isset($routesArray[1]) && !empty($routesArray[1])){
    
    $startAt = ($routesArray[1]-1)*$endAt;
    $currentPage = $routesArray[1];
    
}else{

    $startAt = 0;
    $currentPage = 1;

}



$url = "news";
$method = "GET";
$fields = array ();
$totalNews = CurlController::request($url, $method, $fields)->total;
// echo "<pre>"; print_r(ceil($totalNews/8)); echo "</pre>";
if($startAt > $totalNews){

    echo '<script>
        window.location = "'. $path . '404";
        </script>';

}



$select = "id_new,title_new,category_new,intro_new,image_new,date_created_new";
$url = "news?select=".$select."&startAt=".$startAt."&endAt=".$endAt
."&orderBy=date_created_new&orderMode=DESC";
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

// echo "<pre>"; print_r($noticias); echo "</pre>";
?>


<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5"
    style="background-image: url('<?php echo $path; ?>/views/assets/images/funes_noticias.jpg')">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px"
                    data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    Noticias</h1>
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
            <div class="col-12 px-0">
                <ul class="blog-classic blog-wrapper grid-loading grid grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-double-extra-large"
                    data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                    <li class="grid-sizer"></li>

                    

                    <?php
                    require_once('controllers/controller.new.php');
                    // Crear una instancia del controlador
                    $new = new NewController();

                    // Usar el método dateFormat para formatear la fecha
                    foreach ($noticias as $noticia) {
                        $fecha_formateada = $new->dateFormat($noticia->date_created_new);

                        echo '<li class="grid-item">';
                        echo '    <div class="card bg-transparent border-0 h-100">';
                        echo '        <div class="blog-image position-relative overflow-hidden border-radius-4px">';
                        echo '            <a href="demo-business-blog-single-modern.html"><img src="' . $path . '/views/assets/images/noticias/' . $noticia->image_new . '" alt=""></a>';
                        echo '        </div>';
                        echo '        <div class="card-body px-0 pt-30px pb-30px xs-pb-15px last-paragraph-no-margin">';
                        echo '            <span class="fs-14 text-uppercase"><a href="#" class="text-dark-gray fw-600 categories-text">' . $noticia->category_new . '</a><a href="#" class="blog-date">' . $fecha_formateada . '</a></span>';
                        echo '            <a href="demo-business-blog-single-modern.html" class="card-title mb-15px fw-500 fs-18 lh-30 text-dark-gray d-inline-block">' . $noticia->title_new . '</a>';
                        echo '            <p class="w-95 sm-w-100"></p>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</li>';
                    }
                    ?>


                    

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2 d-flex justify-content-center">

                <ul 
                 class="pagination"
                 data-total-pages="<?php echo ceil($totalNews/$endAt) ?>"
                 data-url-page="<?php echo $routesArray[0] ?>"
                 data-current-page="<?php echo $currentPage ?>"
                 ></ul>
                
                <!-- <ul class="pagination pagination-style-01 fs-13 fw-500 mb-0"
                    data-anime='{ "translate": [0, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 150, "easing": "easeOutQuad" }'
                    data-total-pages=""<?php echo ceil($totalNews/8) ?>
                    >
                    <li class="page-item"><a class="page-link" href="#"><i
                    class="feather icon-feather-arrow-left fs-18 d-xs-none"></i></a></li>
                    <li class="page-item"><a class="page-link" href="#">01</a></li>
                    <li class="page-item active"><a class="page-link" href="#">02</a></li>
                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                    <li class="page-item"><a class="page-link" href="#">04</a></li>
                    <li class="page-item"><a class="page-link" href="#"></a></li>
                </ul> -->
                
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<script>

var target = $('.pagination');

if(target.length > 0){

    target.each(function() {

        var el = $(this),
        totalPages = el.data("total-pages"),
        urlPage = el.data("url-page"),
        currentPage = el.data("current-page");

        console.log("totalPages", totalPages);

        el.twbsPagination({
        totalPages: totalPages,
        startPage:currentPage,
        visiblePages: 5,
        first:'<i class="feather icon-feather-arrow-left fs-18 d-xs-none"></i>',
        last: '<i class="feather icon-feather-arrow-right fs-18 d-xs-none"></i>',
        prev: 'Anterior',
        next: 'Siguiente',
        onPageClick: function (event, page) {
            applyCustomStyles();
            console.log("event", event);
            console.log("page", page);
        }
    }).on("page", function(event,page){
        window.location = "/"+urlPage+"/"+page;
    })

    })
}

function applyCustomStyles() {
        // Target the pagination container
        var pagination = $('.pagination');

        // Apply custom styles to pagination items
        pagination.find('.page-item').each(function() {
            $(this).addClass('pagination-style-01');
        });

        // Additional custom styles can be applied as needed
        pagination.find('.page-link').css({
            'border': '0',
            'padding': '0 2px',
            'margin': '0 7px',
            'background': '0 0',
            'color': 'var(--medium-gray)',
            'min-width': '45px',
            'font-size': 'inherit',
            'text-align': 'center',
            'border-radius': '100%',
            'line-height': '45px',
            'min-height': '45px'
        });
        
        pagination.find('.page-link i').css({
            'line-height': '40px'
        });

        pagination.find('.page-link:hover').css({
            'background': 'var(--white)',
            'color': 'var(--dark-gray)',
            'box-shadow': '0 0 10px rgba(23, 23, 23, 0.15) !important'
        });

        pagination.find('.page-item.active .page-link').css({
            'background': 'var(--dark-gray)',
            'color': 'var(--white)',
            'box-shadow': '0 0 10px rgba(23, 23, 23, 0.15) !important'
        });

        pagination.find('.page-item:first-child .page-link, .page-item:last-child .page-link').css({
            'background': 'transparent',
            'box-shadow': 'none !important'
        });
    }

    // Apply custom styles after the pagination has been rendered
    setTimeout(applyCustomStyles, 0); // Adjust the timeout as needed




</script>



