<!-- Scripts -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaRnCKVVSWGR159MyTF6rV7NMIPsW960c&libraries=visualization">
</script>
<style>
#map {
    height: 50vh;
    width: 100%;
}
</style>

<div class="wrapper">
    <!-- Content Wrapper-->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Estadísticas Reclamos</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div>



        <?php

        // Fecha actual
            $fechaActual = new DateTime();
            // Fecha de hace tres meses
            $fechaTresMesesAtras = (clone $fechaActual)->modify('-3 months');

            // Formatear las fechas a un formato adecuado (YYYY-MM-DD)
            $between1 = $fechaTresMesesAtras->format('Y-m-d');
            $between2 = $fechaActual->format('Y-m-d');
        
            $select = "id_reclamo,id_estado_reclamo";

            $url = "reclamos?select=".$select;
            $method = "GET";
            $fields = array();

            $rTotal = CurlController::request($url,$method,$fields);

            if($rTotal->status == 200){

                $rTotal = $rTotal->total;
            }

        ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Estadisticas generales -->
                <div class="row">

                    <!-- Totales -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo  $rTotal ?></h3>

                                <p>Total Reclamos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <?php
        
                        $select = "id_reclamo,id_estado_reclamo";

                        $url = "reclamos?select=".$select."&linkTo=id_estado_reclamo&equalTo=4";
                        $method = "GET";
                        $fields = array();

                        $rPendientes = CurlController::request($url,$method,$fields);

                        if($rPendientes->status == 200){

                            $rPendientes = $rPendientes->total;
                        }

                    ?>

                    <!-- Pendientes -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $rPendientes ?></h3>

                                <p>Reclamos Pendientes</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <?php
    
                        $select = "id_reclamo,id_estado_reclamo";

                        $url = "reclamos?select=".$select."&linkTo=id_estado_reclamo&equalTo=3";
                        $method = "GET";
                        $fields = array();

                        $rEnCurso = CurlController::request($url,$method,$fields);

                        if($rEnCurso->status == 200){

                            $rEnCurso = $rEnCurso->total;
                        }

                    ?>

                    <!-- En Curso -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $rEnCurso ?></h3>

                                <p>Reclamos en Curso</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <?php
    
                        $select = "id_reclamo,id_estado_reclamo";

                        $url = "reclamos?select=".$select."&linkTo=id_estado_reclamo&equalTo=5";
                        $method = "GET";
                        $fields = array();

                        $rFinalizado = CurlController::request($url,$method,$fields);

                        if($rFinalizado->status == 200){

                            $rFinalizado = $rFinalizado->total;
                        }

                    ?>

                    <!-- Finalizados -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $rFinalizado ?></h3>

                                <p>Reclamos Finalizados</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                </div>

                <!-- Reclamos por categoria para donut -->
                <?php 

                    $select = "id_reclamo,descripcion_rcategory";
                    $url = "relations?rel=reclamos,rcategories&type=reclamo,rcategory&linkTo=date_created_reclamo&between1=".$between1."&between2=".$between2."&select=".$select;
                    $method = "GET";
                    $fields = array();

                    $resultadoReclamos = CurlController::request($url, $method, $fields);

                    if ($resultadoReclamos->status == 200) {
                        // Inicializamos un arreglo para contar los reclamos por categoría
                        $categoryCounts = [];

                        // Recorrer los resultados
                        foreach ($resultadoReclamos->results as $reclamo) {
                            $categoria = $reclamo->descripcion_rcategory;

                            // Contar los reclamos por categoría
                            if (isset($categoryCounts[$categoria])) {
                                $categoryCounts[$categoria]++;
                            } else {
                                $categoryCounts[$categoria] = 1;
                            }
                        }

                    } else {
                        // Manejo de errores
                        echo json_encode(['error' => 'No se pudieron obtener los reclamos']);
                    }
                ?>

                    <div class="row">

                        <!-- Mapa de Calor en la columna derecha -->
                        <div class="col-md-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Mapa de Calor Reclamos</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Reclamos por Categoría -->
                        <div class="col-md-6">

                            <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Reclamos por Categoría</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="donutChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 512px;"
                                            width="512" height="250" class="chartjs-render-monitor"></canvas>
                                    </div>
                            </div>

                            <?php
                                $select= "id_reclamo,descripcion_estado,date_created_reclamo";
                                $url = "relations?rel=reclamos,estados&type=reclamo,estado&linkTo=date_created_reclamo&between1=".$between1."&between2=".$between2."&select=".$select;
                                $method = "GET";
                                $fields = array();

                                $reclamosPorEstado = CurlController::request($url,$method,$fields);
                                if($reclamosPorEstado->status == 200){
                                    $reclamosPorEstado = $reclamosPorEstado->results;
                                    
                                    $data = [];
                                    
                                    foreach ($reclamosPorEstado as $reclamo) {
                                        // Convertir la fecha a un formato de mes
                                        $month = date('Y-m', strtotime($reclamo->date_created_reclamo));
                                        
                                        // Inicializar el mes si no existe
                                        if (!isset($data[$month])) {
                                            $data[$month] = ['Ingresados' => 0, 'Finalizados' => 0];
                                        }
                                        
                                        // Contar según el estado
                                        if ($reclamo->descripcion_estado == 'Ingresado') {
                                            $data[$month]['Ingresados']++;
                                        } elseif ($reclamo->descripcion_estado == 'Finalizado') {
                                            $data[$month]['Finalizados']++;
                                        }
                                    }
                                    
                                    // Ordenar por mes
                                    ksort($data);
                                }

                                // Preparar los datos para el gráfico
                                $meses = array_keys($data);
                                $ingresados = array_column($data, 'Ingresados');
                                $finalizados = array_column($data, 'Finalizados');
                            ?>
                        
                        </div>

                        <!-- Reclamos Ingresados/Finalizados -->
                        <div class="col-md-6">

                            <!-- Reclamos Ingresados vs Finalizados -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Reclamos Ingresados/Finalizados</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="barChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 512px;"
                                            width="512" height="250" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>

                            <script>
                            const ctx = document.getElementById('barChart').getContext('2d');
                            const myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: <?php echo json_encode($meses); ?>,
                                    datasets: [{
                                            label: 'Reclamos Ingresados',
                                            data: <?php echo json_encode($ingresados); ?>,
                                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                        },
                                        {
                                            label: 'Reclamos Finalizados',
                                            data: <?php echo json_encode($finalizados); ?>,
                                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                            </script>

                            <?php

                                $select= "id_reclamo,latitud_reclamo,longitud_reclamo";
                                $url = "reclamos?select=".$select;
                                $method = "GET";
                                $fields = array();

                                $reclamosMarcados = CurlController::request($url,$method,$fields);

                                if($reclamosMarcados->status == 200){

                                    
                                // echo '<pre>';print_r($reclamosMarcados);echo '</pre>';
                                }


                            ?>
                        </div>

                    </div>

                </div>





            </div>
        </section>


    </div>

</div>

<script>
    // Inicializa el mapa
    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: {
                lat: -32.920654,
                lng: -60.809987
            } // Coordenadas de centro inicial
        });

        // Datos de puntos para el mapa de calor
        const heatmapData = [];

        // Aquí añadirás los puntos desde PHP
        const results = <?php echo json_encode($reclamosMarcados->results); ?>;

        // Añadir las coordenadas al array de datos
        results.forEach(function(reclamo) {
            heatmapData.push(new google.maps.LatLng(reclamo.latitud_reclamo, reclamo
                .longitud_reclamo));
        });

        // Crear el mapa de calor
        const heatmap = new google.maps.visualization.HeatmapLayer({
            data: heatmapData,
            map: map
        });

        // Opciones adicionales para el mapa de calor (opcional)
        heatmap.set('radius', 20); // Ajusta el radio del mapa de calor
    }

    // Llama a initMap cuando se cargue la ventana
    window.onload = initMap;
    </script>

<?php 
    // Preparar la respuesta final para reclamos por categoria
    $result = [
        'labels' => array_keys($categoryCounts),
        'data' => array_values($categoryCounts),
    ];

    // Colores para las categorías (12 colores diferentes)
    $colors = [
        'rgba(255, 99, 132)',
        'rgba(54, 162, 235)',
        'rgba(255, 206, 86)',
        'rgba(75, 192, 192)',
        'rgba(153, 102, 255)',
        'rgba(255, 159, 64)',
        'rgba(255, 99, 132)',
        'rgba(54, 162, 235)',
        'rgba(255, 206, 86)',
        'rgba(75, 192, 192)',
        'rgba(153, 102, 255)',
        'rgba(255, 159, 64)'
    ];

    ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('donutChart').getContext('2d');

    // Datos pasados dinámicamente desde PHP
    var result = <?php echo json_encode($result); ?>;
    var labels = result.labels;
    var data = result.data;

    // Colores pasados dinámicamente desde PHP
    var colors = <?php echo json_encode($colors); ?>;

    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Reclamos por Estado',
                data: data,
                backgroundColor: colors.slice(0, labels
                .length), // Limitar colores a la cantidad de etiquetas
                borderColor: colors.slice(0, labels.length).map(color => color.replace('0.2',
                    '1')), // Colores de borde más opacos
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        }
    });
});
</script>