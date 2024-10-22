<?php

if (isset($_GET['turno'])) {
$select = "id_turno";
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
//echo '<pre>';print_r($turno);echo '</pre>';

?>

<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data" id="formTurnos">

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

                                    <div class="form-group pb-3">
                                        <label for="id_dependencia_turno">Dependencia <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="id_dependencia_turno" name="id_dependencia_turno" class="form-control required">
                                            <option value="">Seleccione Dependencia</option>
                                        </select>
                                        <input type="hidden" id="dependenciaHidden" name="dependencia">
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="id_servicio_turno">Servicio <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="id_servicio_turno" name="id_servicio_turno" class="form-control required">
                                            <option value="">Seleccione Servicio</option>
                                        </select>
                                        <input type="hidden" id="servicioHidden" name="servicio">
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="fecha_turno">Fecha <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="fecha_turno" name="fecha_turno" class="form-control required" onchange="handleFechaChange()">
                                            <option value="">Seleccione una fecha</option>
                                        </select>
                                    </div>


                                    <div class='form-group pb-3'>
                                        <label for='horario_turno'>Horario <sup class='text-danger font-weight-bold'>*</sup></label>
                                        <select id='horario_turno' name='horario_turno' class='form-control required'>
                                        <option value=''>Seleccione Horario</option>
                                        
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

                </div>
            </form>
        </div>
    </div>
</div>


<?php

 if($turno == null){

    echo '<script type="text/javascript" src="' . $path . '/views/assets/js/crearTurno.js"></script>';

 }else{

    echo '<script type="text/javascript" src="' . $path . '/views/assets/js/editTurno.js"></script>';

 }

?>

