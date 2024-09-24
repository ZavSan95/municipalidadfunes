<?php

if (isset($_GET['new'])) {
$select = "id_new,title_new,category_new,intro_new,body_new,image_new";
$url = "news?linkTo=id_new&equalTo=" . base64_decode($_GET['new']);
$method = "GET";
$fields = array();

$new = CurlController::request($url, $method, $fields);

if ($new->status == 200) {
$new = $new->results[0];
} else {
$new = null;
}
} else {
$new = null;
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

                <?php if (!empty($new)): ?>
                <input type="hidden" name="idNew" value="<?php echo  base64_encode($new->id_new) ?>">
                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <?php if (!empty($new)): ?>
                                <h4 class="mt-3">Editar Noticia</h>
                                    <?php else: ?>
                                    <h4 class="mt-3">Agregar Noticia</h4>
                                    <?php endif ?>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/prensa"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/prensa"
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
                    require_once 'controllers/controller.new.php';
                    $manage = new NewController();
                    $manage->newsManage();
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group pb-3">
                                        <label for="title_new">Título <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar el título" id="title_new" name="title_new"
                                            value="<?php echo !empty($new) ? $new->title_new : ''; ?>" required>
                                    </div>
                                    <div class="form-group pb-3">
                                        <label for="id_category_new">Categoría <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_category_new" class="form-control required">
                                            <option value="" <?php if (!empty($new) && $new->id_category_new == ""): ?>
                                                selected <?php endif ?>>Seleccione Categoría</option>

                                            <?php 
                                                $url = "categories?select=id_category,name_category";
                                                $method = "GET";
                                                $fields = array();
                                                $category = CurlController::request($url,$method,$fields);

                                                if($category->status == 200){

                                                $category = $category->results;

                                                foreach ($category as $value) {
                                                echo '<option value="'.$value->id_category.'" ' . 
                                                (($new && $new->id_category_new == $value->id_category) ? 'selected' : '') . 
                                                '>'.$value->name_category.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group pb-3">
                                        <label for="intro_new">Introducción</label>
                                        <textarea class="form-control" id="intro_new" name="intro_new"
                                            placeholder="Ingresar la introducción"
                                            required><?php echo !empty($new) ? $new->intro_new : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                <div class="form-group pb-3 text-center">
										
										<label class="pb-3 float-left">Imagen de la Noticia<sup class="text-danger">*</sup></label>

										<label for="image_new">
											
											
											<?php if (!empty($new)): ?>

												<input type="hidden" value="<?php echo $new->image_new ?>" name="old_image_new">

												<img src="/views/assets/images/noticias/<?php echo $new->image_new ?>" class="img-fluid changeImage">

											<?php else: ?>

												<img src="/views/pages/admin/prensa/assets/img/default/default-image.jpg" class="img-fluid changeImage">
												
											<?php endif ?>
											

											<p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>

										</label>

										 <div class="custom-file">
										 	
										 	<input 
										 	type="file"
										 	class="custom-file-input"
										 	id="image_new"
										 	name="image_new"
										 	accept="image/*"
										 	maxSize="2000000"
										 	onchange="validateImageJS(event,'changeImage')"
										 	<?php if (empty($new)): ?>
										 	required	
										 	<?php endif ?>
										 	>

										 	<div class="valid-feedback">Válido.</div>
	            							<div class="invalid-feedback">Por favor llena este campo correctamente.</div>

					                        <label class="custom-file-label" for="image_new">Buscar Archivo</label>

										 </div>

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
                                        <label for="body_new">Cuerpo <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <textarea class="form-control required summernote" name="body_new"
                                            placeholder="Ingresar el cuerpo del artículo"
                                            required><?php echo !empty($new) ? htmlspecialchars($new->body_new) : ''; ?></textarea>
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
