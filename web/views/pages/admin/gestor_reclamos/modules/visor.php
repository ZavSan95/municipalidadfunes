<?php

if (isset($_GET['reclamo'])) {
    $select = "id_reclamo,nombre_reclamo,apellido_reclamo,dni_reclamo,celular_reclamo,correo_reclamo,cuenta_reclamo,deuda_reclamo,zona_reclamo,estado_reclamo,direccion_reclamo,categoria_reclamo,img_reclamo,detalle_reclamo,date_created_reclamo,latitud_reclamo,longitud_reclamo";
    $url = "reclamos?linkTo=id_reclamo&equalTo=" . base64_decode($_GET['reclamo']);
    $method = "GET";
    $fields = array();

    $reclamo = CurlController::request($url, $method, $fields);

    if ($reclamo->status == 200) {
        $reclamo = $reclamo->results[0];
    } else {
        $reclamo = null;
    }
} else {
    $reclamo = null;
}

?>

<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="mt-3 text-center">Detalle del Reclamo</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="nombre_reclamo">Nombre</label>
                            <input type="text" class="form-control" id="nombre_reclamo" name="nombre_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->nombre_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Apellido -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="apellido_reclamo">Apellido</label>
                            <input type="text" class="form-control" id="apellido_reclamo" name="apellido_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->apellido_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- DNI -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="dni_reclamo">DNI</label>
                            <input type="text" class="form-control" id="dni_reclamo" name="dni_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->dni_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Celular -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="celular_reclamo">Celular</label>
                            <input type="text" class="form-control" id="celular_reclamo" name="celular_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->celular_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Correo -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="correo_reclamo">Correo</label>
                            <input type="text" class="form-control" id="correo_reclamo" name="correo_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->correo_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Cuenta -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="cuenta_reclamo">Cuenta</label>
                            <input type="text" class="form-control" id="cuenta_reclamo" name="cuenta_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->cuenta_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Deuda -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="deuda_reclamo">Deuda</label>
                            <input type="text" class="form-control" id="deuda_reclamo" name="deuda_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->deuda_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Zona -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="zona_reclamo">Zona</label>
                            <input type="text" class="form-control" id="zona_reclamo" name="zona_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->zona_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Estado -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="estado_reclamo">Estado</label>
                            <input type="text" class="form-control" id="estado_reclamo" name="estado_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->estado_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Dirección -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="direccion_reclamo">Dirección</label>
                            <?php $direccion = explode(",", $reclamo->direccion_reclamo) ?>
                            <input type="text" class="form-control" id="direccion_reclamo" name="direccion_reclamo"
                                value="<?php echo !empty($reclamo) ? $direccion[0] : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Categoría -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="categoria_reclamo">Categoría</label>
                            <input type="text" class="form-control" id="categoria_reclamo" name="categoria_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->categoria_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Imagen -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="img_reclamo">Imagen</label>
                            <img src="<?php echo !empty($reclamo) ? $reclamo->img_reclamo : ''; ?>" alt="Imagen del reclamo" class="img-fluid">
                        </div>
                    </div>
                    <!-- Fecha de Creación -->
                    <div class="col-md-6">
                        <div class="form-group pb-3">
                            <label for="date_created_reclamo">Fecha de Creación</label>
                            <input type="text" class="form-control" id="date_created_reclamo" name="date_created_reclamo"
                                value="<?php echo !empty($reclamo) ? $reclamo->date_created_reclamo : ''; ?>" readonly>
                        </div>
                    </div>
                    <!-- Detalle -->
                    <div class="col-md-12">
                        <div class="form-group pb-3">
                            <label for="detalle_reclamo">Detalle</label>
                            <textarea class="form-control" id="detalle_reclamo" name="detalle_reclamo" readonly><?php echo !empty($reclamo) ? $reclamo->detalle_reclamo : ''; ?></textarea>
                        </div>
                    </div>

                    <!-- Google Maps -->
                    <div class="col-md-12">
                        <div class="form-group pb-3">
                            <label>Ubicación en Google Maps</label>
                            <div class="map-container">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="/admin/gestor_reclamos" class="btn btn-default py-2 px-3 btn-sm rounded-pill ml-2">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



