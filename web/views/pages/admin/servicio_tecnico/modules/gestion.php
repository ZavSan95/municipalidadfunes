<?php

if (isset($_GET['ticket'])) {
$select = "id_ticket,title_ticket,id_ticketcategory_ticket,descripcion_ticket,image_ticket";
$url = "tickets?linkTo=id_ticket&equalTo=" . base64_decode($_GET['ticket']);
$method = "GET";
$fields = array();

$ticket = CurlController::request($url, $method, $fields);

if ($ticket->status == 200) {
$ticket = $ticket->results[0];
} else {
$ticket = null;
}
} else {
$ticket = null;
}

//echo '<pre>';print_r($_SESSION['administrador']);echo '</pre>';
?>
<script>
$(document).ready(function() {
    $('#summernote').summernote();
});
</script>

<div class="content">
    <div class="container">
        <?php
            require_once 'controllers/controller.ticket.php';
            $manage = new TicketController();
            $manage->ticketManage();
        ?>
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <input type="hidden" name="id_admin_ticket" value="<?php echo $_SESSION['administrador']->id_admin ?>">
                <?php if (!empty($ticket)): ?>
                <input type="hidden" name="idTicket" value="<?php echo  base64_encode($ticket->id_ticket) ?>">
                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <?php if (!empty($ticket)): ?>
                                <h4 class="mt-3">Editar Ticket</h>
                                    <?php else: ?>
                                    <h4 class="mt-3">Agregar Ticket</h4>
                                    <?php endif ?>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/servicio_tecnico"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/servicio_tecnico"
                                        class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>

                                <div><button type="submit"
                                        class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar
                                        Información</button></div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="id_ticketcategory_ticket">Categoría <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_ticketcategory_ticket" class="form-control required">
                                            <option value="" <?php if (!empty($ticket) && $ticket->id_ticketcategory_ticket == ""): ?>
                                                selected <?php endif ?>>Seleccione Categoría</option>

                                            <?php 
                                                $url = "ticketcategories?select=id_ticketcategory,descripcion_ticketcategory&orderBy=descripcion_ticketcategory&orderMode=ASC";
                                                $method = "GET";
                                                $fields = array();
                                                $category = CurlController::request($url,$method,$fields);

                                                if($category->status == 200){

                                                $category = $category->results;

                                                foreach ($category as $value) {
                                                echo '<option value="'.$value->id_ticketcategory.'" ' . 
                                                (($ticket && $ticket->id_ticketcategory_ticket == $value->id_ticketcategory) ? 'selected' : '') . 
                                                '>'.$value->descripcion_ticketcategory.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="title_ticket">Título <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar el título" id="title_ticket" name="title_ticket"
                                            value="<?php echo !empty($ticket) ? $ticket->title_ticket : ''; ?>" required>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="id_tarea_ticket">Área <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_tarea_ticket" class="form-control required">
                                            <option value="" <?php if (!empty($ticket) && $ticket->id_tarea_ticket == ""): ?>
                                                selected <?php endif ?>>Seleccione Área</option>

                                            <?php 
                                                $url = "tareas?select=id_tarea,descripcion_tarea&orderBy=descripcion_tarea&orderMode=ASC";
                                                $method = "GET";
                                                $fields = array();
                                                $category = CurlController::request($url,$method,$fields);

                                                if($category->status == 200){

                                                $category = $category->results;

                                                foreach ($category as $value) {
                                                echo '<option value="'.$value->id_tarea.'" ' . 
                                                (($ticket && $ticket->id_tarea_ticket == $value->id_tarea) ? 'selected' : '') . 
                                                '>'.$value->descripcion_tarea.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="id_estado_ticket">Estado <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select name="id_estado_ticket" class="form-control required">
                                            <option value="" <?php if (!empty($ticket) && $ticket->id_estado_ticket == ""): ?>
                                                selected <?php endif ?>>Seleccione Estado</option>

                                            <?php 
                                                $url = "estados?select=id_estado,descripcion_estado&orderBy=descripcion_estado&orderMode=ASC";
                                                $method = "GET";
                                                $fields = array();
                                                $category = CurlController::request($url,$method,$fields);

                                                if($category->status == 200){

                                                $category = $category->results;

                                                foreach ($category as $value) {
                                                echo '<option value="'.$value->id_estado.'" ' . 
                                                (($ticket && $ticket->id_estado_ticket == $value->id_estado) ? 'selected' : '') . 
                                                '>'.$value->descripcion_estado.'</option>';
                                                }
                                                }
                                            ?>

                                        </select>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                <div class="form-group pb-3 text-center">
										
										<label class="pb-3 float-left">Imagen<sup class="text-danger">*</sup></label>

										<label for="image_ticket">
											
											
											<?php if (!empty($ticket)): ?>

												<input type="hidden" value="<?php echo $ticket->image_ticket ?>" name="old_image_ticket">

												<img src="/views/assets/images/tickets/<?php echo $ticket->image_ticket ?>" class="img-fluid changeImage">

											<?php else: ?>

												<img src="/views/pages/admin/prensa/assets/img/default/default-image.jpg" class="img-fluid changeImage">
												
											<?php endif ?>
											

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
										 	<?php if (empty($ticket)): ?>
										 	required	
										 	<?php endif ?>
										 	>

										 	<div class="valid-feedback">Válido.</div>
	            							<div class="invalid-feedback">Por favor llena este campo correctamente.</div>

					                        <label class="custom-file-label" for="image_ticket">Buscar Archivo</label>

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
                                        <label for="descripcion_ticket">Descripción <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <textarea class="form-control required summernote" name="descripcion_ticket"
                                            placeholder="Ingresar la descripción del problema"
                                            required><?php echo !empty($ticket) ? htmlspecialchars($ticket->descripcion_ticket) : ''; ?></textarea>
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
