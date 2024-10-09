<?php
// Obtener el id de la mascota desde la URL (GET)
if (isset($_GET['mascota'])) {
    $idMascota = base64_decode($_GET['mascota']);

} else {
    $idMascota = null;
}

?>

<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <h4 class="mt-3">Agregar Historia</h4>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/salud_animal/mascotas/historias?mascota=<?php echo $_GET['mascota'] ?>"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/salud_animal/mascotas/historias?mascota=<?php echo $_GET['mascota'] ?>"
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
                    require_once 'controllers/controller.historia.php';
                    $manage = new HistoriaController;
                    $manage->historiaManage();
                    ?>

                    <!-- ID MASCOTA -->
                    <input type="hidden" name="id_mascota_historia" value="<?php echo $idMascota ?>">

                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <!-- VETERINARIO -->
                                    <div class="form-group pb-3">
                                        <label for="id_veterinario_historia">Veterinario <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_veterinario_historia" class="form-control required">
                                            <option value="" >Seleccione Veterinario</option>

                                            <?php 
                                                $url = "veterinarios?select=id_veterinario,nombre_veterinario";
                                                $method = "GET";
                                                $fields = array();
                                                $veterinario = CurlController::request($url,$method,$fields);

                                                if($veterinario->status == 200){

                                                $veterinario = $veterinario->results;

                                                foreach ($veterinario as $value) {
                                                echo '<option value="'.$value->id_veterinario.'" ' .'>'.$value->nombre_veterinario.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <!-- MOTIVO CONSULTA -->
                                    <div class="form-group pb-3">
                                        <label for="id_tipoconsulta_historia">Motivo de Consulta <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_tipoconsulta_historia" class="form-control required">
                                            <option value="" >Seleccione Motivo Consulta</option>

                                            <?php 
                                                $url = "tipoconsultas?select=id_tipoconsulta,descripcion_tipoconsulta";
                                                $method = "GET";
                                                $fields = array();
                                                $tipoconsulta = CurlController::request($url,$method,$fields);

                                                if($tipoconsulta->status == 200){

                                                $tipoconsulta = $tipoconsulta->results;

                                                foreach ($tipoconsulta as $value) {
                                                echo '<option value="'.$value->id_tipoconsulta.'" ' .'>'.$value->descripcion_tipoconsulta.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <!-- PESO -->
                                    <div class="form-group pb-3">
                                        <label for="intro_new">Peso</label>
                                        <input class="form-control required" type="number" name="peso_historia" id="peso_historia">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!-- DETALLE HISTORIA -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group pb-3">
                                        <label for="detalle_historia">Detalle de la Consulta<sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <textarea class="form-control required summernote" name="detalle_historia" required></textarea>
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
                                <a href="/admin/salud_animal/mascotas/historias?mascota=<?php echo $_GET['mascota'] ?>"
                                    class="btn btn-default py-2 px-3 btn-sm rounded-pill ml-2">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>