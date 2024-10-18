<?php

if (isset($_GET['turno'])) {
$select = "id_turno,id_dependencia_turno,id_servicio_turno,fecha_turno,inicio_turno,fin_turno,".
"nombre_turno,dni_turno,telefono_turno,direccion_turno,correo_turno";
$url = "turnos?linkTo=id_turno&equalTo=" . base64_decode($_GET['turno']);
$method = "GET";
$fields = array();

$turno = CurlController::request($url, $method, $fields);

if ($turno->status == 200) {
$turno = $turno->results[0];
} else {
$turno = null;
}
} else {
$turno = null;
}
echo '<pre>';print_r($turno);echo '</pre>'
?>


<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <?php if (!empty($turno)): ?>
                <input type="hidden" name="idTurno" value="<?php echo base64_encode($turno->id_turno) ?>">
                <?php endif ?>

                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 text-center text-lg-left">
                                <?php if (!empty($turno)): ?>
                                <h4 class="mt-3">Editar Turno</h4>
                                <?php else: ?>
                                <h4 class="mt-3">Agregar Turno</h4>
                                <?php endif ?>
                            </div>
                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
                                <button type="submit" class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
                                <a href="/admin/turnos/calendario" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
                            </div>
                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                                <div><a href="/admin/turnos/calendario" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>
                                <div><button type="submit" class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar Información</button></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php 
                    require_once 'controllers/controller.turno.php';
                    $manage = new TurnoController;
                    $manage->turnoManage();
                    ?>
                    <div class="row">
                        <!-- Dependencia y Servicio -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                <form method="POST" action="">
                                    <div class="form-group pb-3">
                                        <label for="id_dependencia_turno">Dependencia <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="id_dependencia_turno" name="id_dependencia_turno" class="form-control required" onchange="updateServicios()">
                                            <option value="">Seleccione Dependencia</option>
                                            <?php 
                                            $url = "dependencias?select=id_dependencia,descripcion_dependencia";
                                            $method = "GET";
                                            $fields = array();
                                            $dependencias = CurlController::request($url, $method, $fields);

                                            if ($dependencias->status == 200) {
                                                foreach ($dependencias->results as $value) {
                                                    echo '<option value="'.$value->id_dependencia.'" '.((isset($_POST['id_dependencia_turno']) && $_POST['id_dependencia_turno'] == $value->id_dependencia) ? 'selected' : '').'>'.$value->descripcion_dependencia.'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="id_servicio_turno">Servicio <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="id_servicio_turno" name="id_servicio_turno" class="form-control required">
                                            <option value="">Seleccione Servicio</option>
                                            <?php 
                                            // Solo carga servicios si se ha seleccionado una dependencia
                                            if (isset($_POST['id_dependencia_turno']) && $_POST['id_dependencia_turno'] != '') {
                                                $dependenciaId = $_POST['id_dependencia_turno'];
                                                $url = "servicios?dependencia_id=" . $dependenciaId; // Ajusta la URL según tu API
                                                $method = "GET";
                                                $fields = array();
                                                $servicios = CurlController::request($url, $method, $fields);

                                                if ($servicios->status == 200) {

                                                    $servicios = $servicios->results;

                                                    foreach ($servicios as $value) {
                                                        echo '<option value="'.$value->id_servicio.'" ' . 
                                                        (($turno && $turno->id_servicio_turno == $value->id_servicio) ? 'selected' : '') . 
                                                        '>'.$value->descripcion_servicio.'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="fecha_turno">Fecha <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="fecha_turno" name="fecha_turno" class="form-control required" onchange="updateHorarios()">
                                            <option value="">Seleccione una fecha</option>
                                            <?php 
                                                $turnoController = new TurnoController();
                                                $fechasHabiles = $turnoController->obtenerFechasHabiles();
                                                foreach ($fechasHabiles as $fecha) {
                                                    echo '<option value="'.$fecha.'" '.((isset($_POST['fecha_turno']) && $_POST['fecha_turno'] == $fecha) ? 'selected' : '').'>'.$fecha.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                </form>

<script>
function updateServicios() {
    const dependenciaId = document.getElementById('id_dependencia_turno').value;

    // Crear un formulario oculto
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';

    // Agregar el campo de dependencia al formulario
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'id_dependencia_turno';
    input.value = dependenciaId;
    form.appendChild(input);

    // Agregar un campo oculto para el submit
    const submitInput = document.createElement('input');
    submitInput.type = 'hidden';
    submitInput.name = 'fetch_servicios'; // Cambia el nombre si es necesario
    form.appendChild(submitInput);

    // Enviar el formulario
    document.body.appendChild(form);
    form.submit();
}

function updateHorarios() {
    const dependenciaId = document.getElementById('id_dependencia_turno').value;
    const servicioId = document.getElementById('id_servicio_turno').value;
    const fecha = document.getElementById('fecha_turno').value;

    // Verificar que todos los valores necesarios están seleccionados
    if (dependenciaId && servicioId && fecha) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '';

        // Agregar campos ocultos al formulario
        const inputDependencia = document.createElement('input');
        inputDependencia.type = 'hidden';
        inputDependencia.name = 'id_dependencia_turno';
        inputDependencia.value = dependenciaId;
        form.appendChild(inputDependencia);

        const inputServicio = document.createElement('input');
        inputServicio.type = 'hidden';
        inputServicio.name = 'id_servicio_turno';
        inputServicio.value = servicioId;
        form.appendChild(inputServicio);

        const inputFecha = document.createElement('input');
        inputFecha.type = 'hidden';
        inputFecha.name = 'fecha_turno';
        inputFecha.value = fecha;
        form.appendChild(inputFecha);

        const submitInput = document.createElement('input');
        submitInput.type = 'hidden';
        submitInput.name = 'submit_turno';
        form.appendChild(submitInput);

        // Enviar el formulario
        document.body.appendChild(form);
        form.submit();
    } else {
        alert("Por favor, asegúrese de que la dependencia y el servicio estén seleccionados.");
    }
}

</script>

                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta donde se mostrarán los horarios -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                <div class='form-group pb-3'>
                                    <label for='horario_turno'>Horario <sup class='text-danger font-weight-bold'>*</sup></label>
                                    <select id='horario_turno' name='horario_turno' class='form-control required'>
                                    <option value=''>Seleccione un horario</option>
                                    <?php
                                    // Mostrar los horarios disponibles en un select
                                    if (isset($_POST['submit_turno'])) {
                                        // Obtener los valores seleccionados
                                        $id_dependencia = $_POST['id_dependencia_turno'];
                                        $id_servicio = $_POST['id_servicio_turno'];
                                        $fecha_turno = $_POST['fecha_turno']; // Obtener la fecha seleccionada

                                        // Verificar si se seleccionaron dependencia, servicio y fecha
                                        if ($id_dependencia && $id_servicio && $fecha_turno) {
                                            // Obtener el horario de la dependencia
                                            $url = "dependencias?linkTo=id_dependencia&equalTo=".$id_dependencia."&select=inicio_dependencia,fin_dependencia,duracion_dependencia";
                                            $method = "GET";
                                            $fields = array();
                                            $horarios = CurlController::request($url, $method, $fields);

                                            // Obtener turnos ya asignados para esa fecha
                                            $urlTurnos = "turnos?linkTo=id_dependencia_turno,fecha_turno&equalTo={$id_dependencia},{$fecha_turno}&select=inicio_turno";
                                            $turnos = CurlController::request($urlTurnos, $method, $fields);

                                            $turnosOcupados = [];
                                            if ($turnos->status == 200) {
                                                foreach ($turnos->results as $turno) {
                                                    // Asegúrate de tener el formato correcto
                                                    $turnosOcupados[] = date('H:i', strtotime($turno->inicio_turno)); // Convertir a formato 'H:i'
                                                }
                                            }

                                            if ($horarios->status == 200) {
                                                $horarios = $horarios->results;

                                                // Obtener inicio, fin y duración
                                                $inicio = new DateTime($horarios[0]->inicio_dependencia);
                                                $fin = new DateTime($horarios[0]->fin_dependencia);
                                                $duracion = $horarios[0]->duracion_dependencia; // Duración en minutos

                                                // Calcular horarios disponibles
                                                $horariosDisponibles = [];
                                                while ($inicio < $fin) {
                                                    $horaFormato = $inicio->format('H:i');
                                                    // Solo agregar si no está ocupado
                                                    if (!in_array($horaFormato, $turnosOcupados)) {
                                                        $horariosDisponibles[] = $horaFormato; // Agregar formato de hora
                                                    }
                                                    // Sumar la duración al horario actual
                                                    $inicio->modify("+{$duracion} minutes");
                                                }

                                                // Mostrar el select con horarios disponibles
                                                foreach ($horariosDisponibles as $horario) {
                                                    echo '<option value="'.$horario.'">'.$horario.'</option>';
                                                }
                                            } else {
                                                echo "<option value=''>Sin Turnos Disponibles</option>";
                                            }
                                        } else {
                                            echo "<p>Por favor, seleccione tanto una dependencia como un servicio y una fecha.</p>";
                                        }
                                    }
                                    ?>
                                    
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="container">
                            <div class="card-header">
                                    <h4>Datos Personales</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card mb-3">

                            <div class="card-body">
                                <!-- Campos adicionales -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nombre_turno">Nombre <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" id="nombre_turno" name="nombre_turno" class="form-control required" required placeholder="Ingrese su nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="dni_turno">DNI <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="numeros" id="dni_turno" name="dni_turno" class="form-control required" required placeholder="Ingrese su DNI" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="telefono_turno">Teléfono <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="numeros" id="telefono_turno" name="telefono_turno" class="form-control required" required placeholder="Ingrese su teléfono" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="direccion_turno">Dirección <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" id="direccion_turno" name="direccion_turno" class="form-control required" required placeholder="Ingrese su dirección" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="correo_turno">Correo <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="email" id="correo_turno" name="correo_turno" class="form-control required" required placeholder="Ingrese su correo" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="" class="btn btn-info">Guardar</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

