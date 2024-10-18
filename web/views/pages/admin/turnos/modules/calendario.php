<?php
// Realiza la consulta a la API
$url = "relations?rel=turnos,dependencias,servicios&type=turno,dependencia,servicio&select=nombre_turno,descripcion_servicio,inicio_turno,fin_turno,fecha_turno";
$method = "GET";
$fields = array();
$responseData = CurlController::request($url, $method, $fields);

//echo '<pre>'; print_r($responseData); echo '</pre>';

$data = $responseData; // Asignamos la respuesta a $data

$turnos = []; // Arreglo para almacenar los eventos

if ($data->status === 200 && $data->total > 0) {
    foreach ($data->results as $turno) {
        $event = [
            'title' => $turno->nombre_turno . ' - ' . $turno->descripcion_servicio, // Combina nombre y descripción para el título
            'start' => $turno->fecha_turno . 'T' . $turno->inicio_turno, // Formato ISO 8601
            'end' => $turno->fecha_turno . 'T' . $turno->fin_turno, // Formato ISO 8601
        ];
        $turnos[] = $event; // Agrega el evento al arreglo
    }
}
?>

<div class="content">

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    <a href="/admin/turnos/gestion" class="btn btn-info py-2 px-3 btn-sm rounded-pill">Agregar Turno</a>
                </h3>

            </div>

            <div class="card-body">

                <h1>Calendario de Turnos</h1>            
                <div id="calendar"></div>

            </div>

        </div>

    </div>

</div>

<style>
#calendar {
    max-width: 900px;
    margin: 0 auto;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth,listYear'
            },
            views: {
                listDay: { buttonText: 'Día' },
                listWeek: { buttonText: 'Semana' },
                listMonth: { buttonText: 'Mes' },
                listYear: { buttonText: 'Año' }
            },
            events: <?php echo json_encode($turnos); ?> // Pasa los turnos desde PHP a JavaScript
        });

        calendar.render();
    });
</script>

