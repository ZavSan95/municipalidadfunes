<?php

if (isset($_GET['area'])) {
$select = "id_area,nombre_area";
$url = "areas?linkTo=id_area&equalTo=" . base64_decode($_GET['area']);
$method = "GET";
$fields = array();

$area = CurlController::request($url, $method, $fields);

if ($area->status == 200) {
$area = $area->results[0];
} else {
$area = null;
}
} else {
$area = null;
}

?>

<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <?php if (!empty($area)): ?>
                <input type="hidden" name="idArea" value="<?php echo  base64_encode($area->id_area) ?>">
                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <?php if (!empty($area)): ?>
                                <h4 class="mt-3">Editar Área</h>
                                    <?php else: ?>
                                    <h4 class="mt-3">Agregar Área</h4>
                                    <?php endif ?>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/areas"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/areas"
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
                    require_once 'controllers/controller.area.php';
                    $manage = new AreaController;
                    $manage->areaManage();
                    ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group pb-3">
                                        <label for="nombre_area">Nombre <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar el título" id="nombre_area" name="nombre_area"
                                            value="<?php echo !empty($area) ? $area->nombre_area : ''; ?>" required>
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
                                <a href="/admin/areas"
                                    class="btn btn-default py-2 px-3 btn-sm rounded-pill ml-2">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
