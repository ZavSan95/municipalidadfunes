<?php 

if(isset($_GET['tutor'])){

	$select = "id_tutor,dni_tutor,nombre_tutor,apellido_tutor";
	$url = "tutores?linkTo=id_tutor&equalTo=".base64_decode($_GET['tutor']);
	$method = "GET";
	$fields = array();

	$tutor = CurlController::request($url,$method,$fields);

	if($tutor->status == 200){

		$tutor = $tutor->results[0];
	}else{

		$tutor = null;
	}

}else{

	$tutor = null;
}

?>

<div class="content">

    <div class="container">

        <div class="card">

            <form method="post" class="needs-validation" novalidate>

                <?php if(!empty($tutor)): ?>

                <input type="hidden" name="idTutor" value="<?php echo base64_encode($tutor->id_tutor) ?>">

                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <?php if (!empty($tutor)): ?>
                                <h4 class="mt-3">Editar Tutor</h>
                                    <?php else: ?>
                                    <h4 class="mt-3">Agregar Tutor</h4>
                                    <?php endif ?>

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

                <div class="card-body">

                    <?php 
                    require_once 'controllers/controller.tutor.php';
                    $manage = new TutorController();
                    $manage->tutorManage();
                    ?>

                    <div class="row row-cols-1 row-cols-md-2">

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <div class="form-group pb-3">

                                        <label for="nombre_tutor">Nombre <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="text" class="form-control required"
                                            placeholder="Ingresar el nombre" id="nombre_tutor" name="nombre_tutor"
                                            value="<?php if (!empty($tutor)): ?><?php echo $tutor->nombre_tutor ?><?php endif ?>"
                                            required>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="apellido_tutor">Apellido <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="text" class="form-control required"
                                            placeholder="Ingresar el nombre" id="apellido_tutor" name="apellido_tutor"
                                            value="<?php if (!empty($tutor)): ?><?php echo $tutor->apellido_tutor ?><?php endif ?>"
                                            required>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="dni_tutor">DNI <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="number" class="form-control required"
                                            placeholder="Ingresar el nombre" id="dni_tutor" name="dni_tutor"
                                            value="<?php if (!empty($tutor)): ?><?php echo $tutor->dni_tutor ?><?php endif ?>"
                                            required>

                                    </div>

                                    
                                </div>

                            </div>

                        </div>

                        <div class="col pl-3">

                            <div class="card">

                                <div class="card-body">
                                    <div class="form-group pb-3">

                                        <label for="mail_tutor">Correo Electrónico <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="email" class="form-control required"
                                            placeholder="Ingresar el nombre" id="mail_tutor" name="mail_tutor"
                                            value="<?php if (!empty($tutor)): ?><?php echo $tutor->mail_tutor ?><?php endif ?>"
                                            required>

                                        </div>

                                        <div class="form-group pb-3">

                                        <label for="celular_tutor">Celular <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="number" class="form-control required"
                                            placeholder="Ingresar el nombre" id="celular_tutor" name="celular_tutor"
                                            value="<?php if (!empty($tutor)): ?><?php echo $tutor->celular_tutor ?><?php endif ?>"
                                            required>

                                        </div>

                                        <div class="form-group pb-3">

                                        <label for="direccion_tutor">Dirección <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="all" class="form-control required"
                                            placeholder="Ingresar el nombre" id="direccion_tutor" name="direccion_tutor"
                                            value="<?php if (!empty($tutor)): ?><?php echo $tutor->direccion_tutor ?><?php endif ?>"
                                            required>

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