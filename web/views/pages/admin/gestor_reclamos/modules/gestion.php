<?php

if (isset($_GET['reclamo'])) {
$select = "id_reclamo,nombre_reclamo,apellido_reclamo,dni_reclamo,celular_reclamo,correo_reclamo,cuenta_reclamo,deuda_reclamo,zona_reclamo,estado_reclamo,".
"estado_reclamo,direccion_reclamo,categoria_reclamo,img_reclamo,detalle_reclamo,date_created_reclamo";
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
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <?php if (!empty($reclamo)): ?>
                <input type="hidden" name="idReclamo" value="<?php echo  base64_encode($reclamo->id_reclamo) ?>">
                <?php endif ?>
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 text-center text-lg-left">
                            <?php if (!empty($reclamo)): ?>
                                <h4 class="mt-3">Editar Reclamo</h>
                                    <?php else: ?>
                                    <h4 class="mt-3">Agregar Reclamo</h4>
                                    <?php endif ?>
                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
                                <button type="submit" class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
                                <a href="/admin/gestor_reclamos" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                                <div><a href="/admin/gestor_reclamos" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>
                                <div><button type="submit" class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar Información</button></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Nombre y Apellido -->
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="nombre_reclamo">Nombre</label>
                                <input type="text" 
                                class="form-control" 
                                id="nombre_reclamo" 
                                name="nombre_reclamo" 
                                placeholder="Ingresar el nombre" 
                                value="<?php echo !empty($reclamo) ? $reclamo->nombre_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="apellido_reclamo">Apellido</label>
                                <input type="text" 
                                class="form-control" 
                                id="apellido_reclamo" 
                                name="apellido_reclamo" 
                                placeholder="Ingresar el apellido" 
                                value="<?php echo !empty($reclamo) ? $reclamo->apellido_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>

                        <!-- DNI y Celular -->
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="dni_reclamo">DNI</label>
                                <input type="text" 
                                class="form-control" 
                                id="dni_reclamo" 
                                name="dni_reclamo" 
                                placeholder="Ingresar el DNI" 
                                value="<?php echo !empty($reclamo) ? $reclamo->dni_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="celular_reclamo">Celular</label>
                                <input type="text" 
                                class="form-control" 
                                id="celular_reclamo" 
                                name="celular_reclamo" 
                                placeholder="Ingresar el celular" 
                                value="<?php echo !empty($reclamo) ? $reclamo->celular_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>

                        <!-- Correo y Cuenta -->
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="correo_reclamo">Correo</label>
                                <input type="email" 
                                class="form-control" 
                                id="correo_reclamo" 
                                name="correo_reclamo" 
                                placeholder="Ingresar el correo" 
                                value="<?php echo !empty($reclamo) ? $reclamo->correo_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="cuenta_reclamo">Cuenta</label>
                                <input type="text" 
                                class="form-control" 
                                id="cuenta_reclamo" 
                                name="cuenta_reclamo" 
                                placeholder="Ingresar la cuenta" 
                                value="<?php echo !empty($reclamo) ? $reclamo->cuenta_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>

                        <!-- Deuda y Zona -->
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="deuda_reclamo">Deuda</label>
                                <input type="text" 
                                class="form-control" 
                                id="deuda_reclamo" 
                                name="deuda_reclamo" 
                                placeholder="Ingresar la deuda" 
                                value="<?php echo !empty($reclamo) ? $reclamo->deuda_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="zona_reclamo">Zona</label>
                                <input type="text" 
                                class="form-control" 
                                id="zona_reclamo" 
                                name="zona_reclamo" 
                                placeholder="Ingresar la zona" 
                                value="<?php echo !empty($reclamo) ? $reclamo->zona_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="direccion_reclamo">Dirección</label>
                                <input type="text" 
                                class="form-control" 
                                id="direccion_reclamo" 
                                name="direccion_reclamo" 
                                placeholder="Ingresar la dirección"
                                value="<?php echo !empty($reclamo) ? $reclamo->direccion_reclamo : ''; ?>" 
                                required>
                            </div>
                        </div>

                        <!-- Latitud y Longitud -->
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="latitud_reclamo">Latitud</label>
                                <input type="text" 
                                class="form-control" 
                                id="latitud_reclamo" 
                                name="latitud_reclamo" 
                                placeholder="Ingresar la latitud" 
                                value="<?php echo !empty($reclamo) ? $reclamo->latitud_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="longitud_reclamo">Longitud</label>
                                <input type="text" 
                                class="form-control" 
                                id="longitud_reclamo" 
                                name="longitud_reclamo" 
                                placeholder="Ingresar la longitud" 
                                value="<?php echo !empty($reclamo) ? $reclamo->longitud_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>

                        <!-- Categoría -->
                        <div class="col-md-6">
                            <div class="form-group pb-3">
                                <label for="categoria_reclamo">Categoría</label>
                                <input type="text" 
                                class="form-control" 
                                id="categoria_reclamo" 
                                name="categoria_reclamo" 
                                placeholder="Ingresar la categoría" 
                                value="<?php echo !empty($reclamo) ? $reclamo->categoria_reclamo : ''; ?>"
                                required>
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                <div class="form-group pb-3 text-center">
										
										<label class="pb-3 float-left">Imagenes del Reclamo<sup class="text-danger">*</sup></label>

										<label for="img_reclamo">
											
											
											<?php if (!empty($reclamo)): ?>

												<input type="hidden" value="<?php echo $reclamo->img_reclamo ?>" name="old_image_reclamo">

												<img src="/views/assets/images/reclamos/<?php echo $reclamo->img_reclamo ?>" class="img-fluid changeImage">

											<?php else: ?>

												<img src="/views/pages/admin/gestor_reclamos/assets/img/default/default-image.jpg" class="img-fluid changeImage">
												
											<?php endif ?>
											

											<p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>

										</label>

										 <div class="custom-file">
										 	
										 	<input 
										 	type="file"
										 	class="custom-file-input"
										 	id="img_reclamo"
										 	name="img_reclamo"
										 	accept="image/*"
										 	maxSize="15000000"
										 	onchange="validateSlideJS(event,'changeImage')"
										 	<?php if (empty($reclamo)): ?>
										 	required	
										 	<?php endif ?>
										 	>

										 	<div class="valid-feedback">Válido.</div>
	            							<div class="invalid-feedback">Por favor llena este campo correctamente.</div>

					                        <label class="custom-file-label" for="img_reclamo">Buscar Archivo</label>

										 </div>

									</div>
                                </div>
                            </div>
                        </div>

                        <!-- Detalle -->
                        <div class="col-md-12">
                            <div class="form-group pb-3">
                                <label for="detalle_reclamo">Detalle</label>
                                <textarea class="form-control" id="detalle_reclamo" name="detalle_reclamo" placeholder="Ingresar los detalles del reclamo"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <label class="font-weight-light"><sup class="text-danger">*</sup> Campos obligatorios</label>
                                <button type="submit" class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
                                <a href="/admin/reclamos" class="btn btn-default py-2 px-3 btn-sm rounded-pill ml-2">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
