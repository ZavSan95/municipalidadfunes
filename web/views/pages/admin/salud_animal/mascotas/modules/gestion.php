<?php 

if(isset($_GET['mascota'])){

$select = "id_mascota,nombre_mascota,nombre_tutor,apellido_tutor,descripcion_especie,raza_mascota,sexo_mascota";
$url = "relations?rel=mascotas,tutores,especies&linkTo=id_mascota&equalTo=".base64_decode($_GET['mascotas']);
$method = "GET";
$fields = array();

$mascota = CurlController::request($url,$method,$fields);

if($mascota->status == 200){

$mascota = $mascota->results[0];
}else{

$mascota = null;
}

}else{

$mascota = null;
}

?>

<div class="content">

    <div class="container">

        <div class="card">

            <form method="post" class="needs-validation" novalidate>

                <?php if(!empty($mascota)): ?>

                <input type="hidden" name="idMascota" value="<?php echo base64_encode($mascota->id_mascota) ?>">

                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <?php if (!empty($mascota)): ?>
                                <h4 class="mt-3">Editar Mascota</h4>
                                    <?php else: ?>
                                    <h4 class="mt-3">Agregar Mascota</h4>
                                    <?php endif ?>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/salud_animal/mascotas"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/salud_animal/mascotas"
                                        class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>

                                <div><button type="submit"
                                        class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar
                                        Información</button></div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="card-body mb-5">

                    <?php 
require_once 'controllers/controller.mascota.php';
$manage = new MascotaController();
$manage->mascotaManage();
?>

                    <div class="row row-cols-1 row-cols-md-2">

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <div class="form-group pb-3">

                                        <label for="nombre_mascota">Nombre <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="text" class="form-control required"
                                            placeholder="Ingresar el nombre" id="nombre_mascota" name="nombre_mascota"
                                            value="<?php if (!empty($mascota)): ?><?php echo $mascota->nombre_mascota ?><?php endif ?>"
                                            required>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="id_tutor_mascota">Tutor <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_tutor_mascota" class="form-control required">
                                            <option value=""
                                                <?php if (!empty($mascota) && $mascota->id_tutor_mascota == ""): ?>
                                                selected <?php endif ?>>Seleccione Tutor</option>
                                            <?php 
$url = "tutores?select=id_tutor,nombre_tutor,apellido_tutor,dni_tutor&orderBy=apellido_tutor&orderMode=ASC";
$method = "GET";
$fields = array();
$tutores = CurlController::request($url,$method,$fields);
if($tutores->status == 200){
$tutores = $tutores->results;
foreach ($tutores as $value) {
echo '<option value="'.$value->id_tutor.'" ' . 
(($mascota && $mascota->id_tutor_mascota == $value->id_tutor) ? 'selected' : '') . 
'>'.$value->apellido_tutor.' '.$value->nombre_tutor.' - '.$value->dni_tutor.'</option>';
}
}
?>
                                        </select>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="id_especie_mascota">Especie <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_especie_mascota" class="form-control required">
                                            <option value=""
                                                <?php if (!empty($mascota) && $mascota->id_especie_mascota == ""): ?>
                                                selected <?php endif ?>>Seleccione Especie</option>
                                            <?php 
$url = "especies?select=id_especie,descripcion_especie&orderBy=descripcion_especie&orderMode=ASC";
$method = "GET";
$fields = array();
$especies = CurlController::request($url,$method,$fields);
if($especies->status == 200){
$especies = $especies->results;
foreach ($especies as $value) {
echo '<option value="'.$value->id_especie.'" ' . 
(($mascota && $mascota->id_especie_mascota == $value->id_especie) ? 'selected' : '') . 
'>'.$value->descripcion_especie.'</option>';
}
}
?>
                                        </select>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="raza_mascota">Raza <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="all" class="form-control required" placeholder="Ingresar raza"
                                            id="raza_mascota" name="raza_mascota"
                                            value="<?php if (!empty($mascota)): ?><?php echo $mascota->raza_mascota ?><?php endif ?>"
                                            required>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="edad_mascota">Edad <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="all" class="form-control required" placeholder="Ingresar el nombre"
                                            id="edad_mascota" name="edad_mascota"
                                            value="<?php if (!empty($tutor)): ?><?php echo $tutor->edad_mascota ?><?php endif ?>"
                                            required>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="raza_mascota">Raza <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <select name="sexo_mascota" id="sexo_mascota" class="form-control required">

                                            <option value=""
                                                <?php if (!empty($mascota) && $mascota->id_especie_mascota == ""): ?>
                                                selected <?php endif ?>>Seleccione Sexo</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Indefinido">Indefinido</option>

                                        </select>

                                    </div>


                                </div>

                            </div>

                        </div>

                        <div class="col pl-3">

                            <div class="card">

                                <div class="card-body">



                                    <div class="form-group pb-3">

                                        <label for="color_mascota">Color <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="all" class="form-control required" placeholder="Ingresar color"
                                            id="color_mascota" name="color_mascota"
                                            value="<?php if (!empty($mascota)): ?><?php echo $mascota->color_mascota ?><?php endif ?>"
                                            required>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label class="pb-3 float-left">Imagen de la Mascota<sup
                                                class="text-danger">*</sup></label>

                                        <label for="imagen_mascota">


                                            <?php if (!empty($mascota)): ?>

                                            <input type="hidden" value="<?php echo $mascota->imagen_mascota ?>"
                                                name="old_imagen_mascota">

                                            <img src="/views/assets/images/mascotas/<?php echo $mascota->imagen_mascota ?>"
                                                class="img-fluid changeImage">

                                            <?php else: ?>

                                            <img src="/views/pages/admin/prensa/assets/img/default/default-image.jpg"
                                                class="img-fluid changeImage">

                                            <?php endif ?>


                                            <p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600
                                                pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>

                                        </label>

                                        <div class="custom-file">

                                            <input type="file" class="custom-file-input" id="imagen_mascota"
                                                name="imagen_mascota" accept="image/*" maxSize="2000000"
                                                onchange="validateImageJS(event,'changeImage')"
                                                <?php if (empty($new)): ?> required <?php endif ?>>

                                            <div class="valid-feedback">Válido.</div>
                                            <div class="invalid-feedback">Por favor llena este campo correctamente.
                                            </div>

                                            <label class="custom-file-label" for="imagen_mascota">Buscar Archivo</label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                    </div>


                </div>

                <div class="card-footer">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left mt-lg-3">

                                <label class="font-weight-light"><sup class="text-danger">*</sup> Campos
                                    obligatorios</label>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/salud_animal/tutores"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/salud_animal/tutores"
                                        class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>

                                <div><button type="submit"
                                        class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar
                                        Información</button></div>

                            </div>

                        </div>
                    </div>

                </div>


            </form>

        </div>

    </div>

</div>