<?php

if (isset($_GET['registro'])) {
$select = "*";
$url = "registros?linkTo=id_registro&equalTo=" . base64_decode($_GET['registro']);
$method = "GET";
$fields = array();

$registro = CurlController::request($url, $method, $fields);

if ($registro->status == 200) {
$registro = $registro->results[0];
} else {
$registro = null;
}
} else {
$registro = null;
}

?>

<script>
$(document).ready(function() {
    $('#summernote').summernote();
});
</script>

<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <?php if (!empty($registro)): ?>
                <input type="hidden" name="idRegistro" value="<?php echo  base64_encode($registro->id_registro) ?>">
                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <?php if (!empty($registro)): ?>
                                <h4 class="mt-3">Editar Registro</h>
                                    <?php else: ?>
                                    <h4 class="mt-3">Agregar Registro</h4>
                                    <?php endif ?>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/inclusion_social"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/inclusion_social"
                                        class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>

                                <div><button type="submit"
                                        class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar
                                        Información</button></div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="card-body">

                    <?php 
                    require_once 'controllers/controller.registro.php';
                    $manage = new RegistroController;
                    $manage->registroManage();
                    ?>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="id_restado_registro">Estado <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_restado_registro" class="form-control required">
                                            <option value="" <?php if (!empty($registro) && $registro->id_restado_registro == ""): ?>
                                                selected <?php endif ?>>Seleccione Estado</option>

                                            <?php 
                                                $url = "restados?select=id_restado,descripcion_restado";
                                                $method = "GET";
                                                $fields = array();
                                                $estado = CurlController::request($url,$method,$fields);

                                                if($estado->status == 200){

                                                $estado = $estado->results;

                                                foreach ($estado as $value) {
                                                echo '<option value="'.$value->id_restado.'" ' . 
                                                (($registro && $registro->id_restado_registro == $value->id_restado) ? 'selected' : '') . 
                                                '>'.$value->descripcion_restado.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="id_prioridad_registro">Prioridad <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_prioridad_registro" class="form-control required">
                                            <option value="" <?php if (!empty($registro) && $registro->id_prioridad_registro == ""): ?>
                                                selected <?php endif ?>>Seleccione Prioridad</option>

                                            <?php 
                                                $url = "prioridades?select=id_prioridad,descripcion_prioridad";
                                                $method = "GET";
                                                $fields = array();
                                                $prioridad = CurlController::request($url,$method,$fields);

                                                if($prioridad->status == 200){

                                                $prioridad = $prioridad->results;

                                                foreach ($prioridad as $value) {
                                                echo '<option value="'.$value->id_prioridad.'" ' . 
                                                (($registro && $registro->id_prioridad_registro == $value->id_prioridad) ? 'selected' : '') . 
                                                '>'.$value->descripcion_prioridad.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="nombre_registro">Nombre y Apellido <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar nombre y apellido" id="nombre_registro" name="nombre_registro"
                                            value="<?php echo !empty($registro) ? $registro->nombre_registro : ''; ?>" required>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="dni_registro">DNI <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar DNI" id="dni_registro" name="dni_registro"
                                            value="<?php echo !empty($registro) ? $registro->dni_registro : ''; ?>" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        
                            <div class="card mb-3">

                                <div class="card-body">
                                        
                                    <div class="form-group pb-3">
                                        <label for="id_rzona_registro">Zona <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_rzona_registro" class="form-control required">
                                            <option value="" <?php if (!empty($registro) && $registro->id_rzona_registro == ""): ?>
                                                selected <?php endif ?>>Seleccione Zona</option>

                                            <?php 
                                                $url = "rzonas?select=id_rzona,descripcion_rzona";
                                                $method = "GET";
                                                $fields = array();
                                                $zona = CurlController::request($url,$method,$fields);

                                                if($zona->status == 200){

                                                $zona = $zona->results;

                                                foreach ($zona as $value) {
                                                echo '<option value="'.$value->id_rzona.'" ' . 
                                                (($registro && $registro->id_rzona_registro == $value->id_rzona) ? 'selected' : '') . 
                                                '>'.$value->descripcion_rzona.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="direccion_registro">Dirección <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar Dirección" id="direccion_registro" name="direccion_registro"
                                            value="<?php echo !empty($registro) ? $registro->direccion_registro : ''; ?>" required>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="telefono_registro">Teléfono <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar Teléfono" id="telefono_registro" name="telefono_registro"
                                            value="<?php echo !empty($registro) ? $registro->telefono_registro : ''; ?>" required>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="observacion_registro">Observación <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar Observación" id="observacion_registro" name="observacion_registro"
                                            value="<?php echo !empty($registro) ? $registro->observacion_registro : ''; ?>" required>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">
                        
                        <div class="col-md-6">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="id_equipo_registro">Equipo <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_equipo_registro" class="form-control required">
                                            <option value="" <?php if (!empty($registro) && $registro->id_equipo_registro == ""): ?>
                                                selected <?php endif ?>>Seleccione Equipo</option>

                                            <?php 
                                                $url = "equipos?select=id_equipo,descripcion_equipo";
                                                $method = "GET";
                                                $fields = array();
                                                $equipo = CurlController::request($url,$method,$fields);

                                                if($equipo->status == 200){

                                                $equipo = $equipo->results;

                                                foreach ($equipo as $value) {
                                                echo '<option value="'.$value->id_equipo.'" ' . 
                                                (($registro && $registro->id_equipo_registro == $value->id_equipo) ? 'selected' : '') . 
                                                '>'.$value->descripcion_equipo.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="id_trabajo_registro">Trabajo <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_trabajo_registro" class="form-control required">
                                            <option value="" <?php if (!empty($registro) && $registro->id_trabajo_registro == ""): ?>
                                                selected <?php endif ?>>Seleccione Trabajo</option>

                                            <?php 
                                                $url = "trabajos?select=id_trabajo,descripcion_trabajo";
                                                $method = "GET";
                                                $fields = array();
                                                $trabajo = CurlController::request($url,$method,$fields);

                                                if($trabajo->status == 200){

                                                $trabajo = $trabajo->results;

                                                foreach ($trabajo as $value) {
                                                echo '<option value="'.$value->id_trabajo.'" ' . 
                                                (($registro && $registro->id_trabajo_registro == $value->id_trabajo) ? 'selected' : '') . 
                                                '>'.$value->descripcion_trabajo.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="bancarizacion_registro">Situación Bancaria <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar Situación Bancaria" id="bancarizacion_registro" name="bancarizacion_registro"
                                            value="<?php echo !empty($registro) ? $registro->bancarizacion_registro : ''; ?>" required>
                                    </div>

                                </div>

                            </div>
                                
                        </div>

                        <div class="col-md-6">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="acceso_registro">Acceso a Información <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar Acceso a Información" id="acceso_registro" name="acceso_registro"
                                            value="<?php echo !empty($registro) ? $registro->acceso_registro : ''; ?>" required>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="utrabajo_registro">Último Trabajo <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar Último Trabajo" id="utrabajo_registro" name="utrabajo_registro"
                                            value="<?php echo !empty($registro) ? $registro->utrabajo_registro : ''; ?>" required>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group pb-3">
                                        <label for="informe_registro">Informe <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <textarea class="form-control required summernote" name="informe_registro"
                                            required><?php echo !empty($registro) ? urldecode($registro->informe_registro) : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <label class="font-weight-light"><sup class="text-danger">*</sup> Campos
                                    obligatorios</label>
                                <button type="submit"
                                    class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>
                                <a href="/admin/inclusion_social"
                                    class="btn btn-default py-2 px-3 btn-sm rounded-pill ml-2">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
