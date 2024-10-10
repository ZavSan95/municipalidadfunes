<script>
$(document).ready(function() {
    $('#summernote').summernote();
});
</script>

<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">


                                <h4 class="mt-3">Nuevo Ticket</h4>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/tickets"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/tickets"
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
                    require_once 'controllers/controller.ticket.php';
                    $manage = new TicketController;
                    $manage->ticketManage()
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <!-- Título -->
                                    <div class="form-group pb-3">
                                        <label for="title_ticket">Título <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar el título" id="title_ticket" name="title_ticket" required>
                                    </div>

                                    <!-- Categoría -->
                                    <div class="form-group pb-3">
                                        <label for="id_ticketcategory_ticket">Categoría <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_ticketcategory_ticket" class="form-control required">
                                            <option value="">Seleccione Categoría</option>

                                            <?php 
                                                $url = "ticketcategories?select=id_ticketcategory,descripcion_ticketcategory";
                                                $method = "GET";
                                                $fields = array();
                                                $category = CurlController::request($url,$method,$fields);

                                                if($category->status == 200){

                                                $category = $category->results;

                                                foreach ($category as $value) {
                                                echo '<option value="'.$value->id_ticketcategory.'" ' .'>'.$value->descripcion_ticketcategory.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <!-- Área -->
                                    <input type="hidden" name="id_area_ticket" value="<?php echo $_SESSION['administrador']->id_area_admin ?>">

                                    <!-- Usuario -->
                                    <input type="hidden" name="id_admin_ticket" value="<?php echo $_SESSION['administrador']->id_admin ?>">

                                    <!-- Estado -->
                                    <input type="hidden" name="id_estado_ticket" value="1">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                <div class="form-group pb-3 text-center">
										
										<label class="pb-3 float-left">Imagen de la Noticia<sup class="text-danger">*</sup></label>

										<label for="image_ticket">
											
                                        <img src="/views/pages/admin/prensa/assets/img/default/default-image.jpg" class="img-fluid changeImage">

										<p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>

										</label>

										 <div class="custom-file">
										 	
										 	<input 
										 	type="file"
										 	class="custom-file-input"
										 	id="image_ticket"
										 	name="image_ticket"
										 	accept="image/*"
										 	maxSize="2000000"
										 	onchange="validateImageJS(event,'changeImage')"
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
                                        <label for="descripcion_ticket">Descripción del Problema <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <textarea class="form-control required summernote" name="descripcion_ticket" required></textarea>
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
                                <a href="/admin/tickets"
                                    class="btn btn-default py-2 px-3 btn-sm rounded-pill ml-2">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
