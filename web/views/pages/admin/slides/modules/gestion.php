<?php

if (isset($_GET['slide'])) {
$select = "id_slide,title_slide,intro_slide,image_slide";
$url = "slides?linkTo=id_slide&equalTo=" . base64_decode($_GET['slide']);
$method = "GET";
$fields = array();

$slide = CurlController::request($url, $method, $fields);

if ($slide->status == 200) {
$slide = $slide->results[0];
} else {
$slide = null;
}
} else {
$slide = null;
}

?>


<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <?php if (!empty($slide)): ?>
                <input type="hidden" name="idSlide" value="<?php echo  base64_encode($slide->id_slide) ?>">
                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <?php if (!empty($slide)): ?>
                                <h4 class="mt-3">Editar Slide</h>
                                    <?php else: ?>
                                    <h4 class="mt-3">Agregar Slide</h4>
                                    <?php endif ?>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/slides"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/slides"
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

                require_once 'controllers/controller.slide.php';
                $manage = new SlideController();
                $manage->slidesManage();

                ?>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group pb-3">
                                        <label for="title_slide">Título <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar el título" id="title_slide" name="title_slide"
                                            value="<?php echo !empty($slide) ? $slide->title_slide : ''; ?>" required>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="intro_slide">Introducción</label>
                                        <textarea class="form-control" id="intro_slide" name="intro_slide"
                                            placeholder="Ingresar la introducción"
                                            required><?php echo !empty($slide) ? $slide->intro_slide : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                <div class="form-group pb-3 text-center">
										
										<label class="pb-3 float-left">Imagen de la Slide<sup class="text-danger">*</sup></label>

										<label for="image_slide">
											
											
											<?php if (!empty($slide)): ?>

												<input type="hidden" value="<?php echo $slide->image_slide ?>" name="old_image_slide">

												<img src="/views/assets/images/slides/<?php echo $slide->image_slide ?>" class="img-fluid changeImage">

											<?php else: ?>

												<img src="/views/pages/admin/slides/assets/img/default/default-image.jpg" class="img-fluid changeImage">
												
											<?php endif ?>
											

											<p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>

										</label>

										 <div class="custom-file">
										 	
										 	<input 
										 	type="file"
										 	class="custom-file-input"
										 	id="image_slide"
										 	name="image_slide"
										 	accept="image/*"
										 	maxSize="15000000"
										 	onchange="validateSlideJS(event,'changeImage')"
										 	<?php if (empty($slide)): ?>
										 	required	
										 	<?php endif ?>
										 	>

										 	<div class="valid-feedback">Válido.</div>
	            							<div class="invalid-feedback">Por favor llena este campo correctamente.</div>

					                        <label class="custom-file-label" for="image_slide">Buscar Archivo</label>

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
                            <div class="col-12 text-center">
                                <label class="font-weight-light"><sup class="text-danger">*</sup> Campos
                                    obligatorios</label>
                                <button type="submit"
                                    class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>
                                <a href="/admin/prensa"
                                    class="btn btn-default py-2 px-3 btn-sm rounded-pill ml-2">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
