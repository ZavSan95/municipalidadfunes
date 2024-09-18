<?php 

if(isset($_GET['admin'])){

	$select = "id_admin,name_admin,email_admin,password_admin,rol_admin";
	$url = "admins?linkTo=id_admin&equalTo=".base64_decode($_GET['admin']);
	$method = "GET";
	$fields = array();

	$admin = CurlController::request($url,$method,$fields);

	if($admin->status == 200){

		$admin = $admin->results[0];
	}else{

		$admin = null;
	}

}else{

	$admin = null;
}

?>

<div class="content">

    <div class="container">

        <div class="card">

            <form method="post" class="needs-validation" novalidate>

                <?php if(!empty($admin)): ?>

                <input type="hidden" name="idAdmin" value="<?php echo base64_encode($admin->id_admin) ?>">
                <input type="hidden" name="oldPassword" value="<?php echo $admin->password_admin ?>">

                <?php endif ?>

                <div class="card-header">

                    <div class="container">

                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">

                                <?php if (!empty($admin)): ?>
                                	<h4 class="mt-3">Editar Administrador</h>
                                <?php else: ?>
                                	<h4 class="mt-3">Agregar Administrador</h4>
                                <?php endif ?>

                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">

                                <button type="submit"
                                    class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar
                                    Información</button>

                                <a href="/admin/administradores"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/administradores"
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
                    require_once 'controllers/controller.admin.php';
                    $manage = new AdminsController();
                    $manage->adminManage();
                    ?>

                    <div class="row row-cols-1 row-cols-md-2">

                        <div class="col">

                            <div class="card">

                                <div class="card-body">

                                    <div class="form-group pb-3">

                                        <label for="name_admin">Nombre <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="text" class="form-control required"
                                            placeholder="Ingresar el nombre" id="name_admin" name="name_admin"
                                            value="<?php if (!empty($admin)): ?><?php echo $admin->name_admin ?><?php endif ?>"
                                            required>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="rol_admin">Rol <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <select name="rol_admin" id="rol_admin" class="form-control required" required>

                                            <option value="" <?php if (!empty($admin) && $admin->rol_admin == ""): ?>
                                                selected <?php endif ?>>Elije Rol</option>
                                            <option value="admin"
                                                <?php if (!empty($admin) && $admin->rol_admin == "admin"): ?> selected
                                                <?php endif ?>>Administrador</option>
                                            <option value="st"
                                                <?php if (!empty($admin) && $admin->rol_admin == "st"): ?> selected
                                                <?php endif ?>>Servicio Tecnico</option>
                                            <option value="prensa"
                                                <?php if (!empty($admin) && $admin->rol_admin == "prensa"): ?> selected
                                                <?php endif ?>>Prensa</option>
                                            <option value="saludanimal"
                                                <?php if (!empty($admin) && $admin->rol_admin == "saludanimal"): ?>
                                                selected <?php endif ?>>Salud Animal</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col pl-3">

                            <div class="card">

                                <div class="card-body">

                                    <div class="form-group pb-3">

                                        <label for="email_admin">Email <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="email" class="form-control required"
                                            placeholder="Ingresar el email" id="email_admin" name="email_admin"
                                            value="<?php if (!empty($admin)): ?><?php echo $admin->email_admin ?><?php endif ?>"
                                            required>

                                    </div>

                                    <div class="form-group pb-3">

                                        <label for="email_admin">Contraseña <sup
                                                class="text-danger font-weight-bold">*</sup></label>

                                        <input type="password" class="form-control required"
                                            placeholder="Ingresar la contraseña" id="password_admin"
                                            name="password_admin" <?php if (empty($admin)): ?> required <?php endif ?>>

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

                                <a href="/admin/administradores"
                                    class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>

                            </div>

                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">

                                <div><a href="/admin/administradores"
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