<!-- DropZone -->
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

<section id="down-section">
    <div class="container">
        <div class="row">
            <div class="col-12 px-0 position-relative">
                <div class="container">
                    <!-- Formulario principal -->
                    <form id="main-form" action="" method="post">
                        <input type="hidden" name="id_estado_reclamo" value="1">
                        <input type="hidden" name="deuda_reclamo" value="0">
                        <input type="hidden" name="redirec_reclamo" value="/reclamos">
                        <?php
                            require_once('controllers/controller.reclamo.php');
                            $manage = new ReclamoController();
                            $manage->reclamoManage();
                        ?>
                        <!-- Paso 1 -->
                        <div id="page-1" class="form-step active">
                            <!-- Contenido del paso 1 -->
                            <?php include 'datos_personales.php'; ?>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="next"
                                    data-target="page-2">Siguiente</button>
                            </div>
                        </div>

                        <!-- Paso 2 -->
                        <div id="page-2" class="form-step d-none">
                            <!-- Contenido del paso 2 -->
                            <?php include 'datos_propiedad.php'; ?>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="prev"
                                    data-target="page-1">Atrás</button>
                                <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="next"
                                    data-target="page-3">Siguiente</button>
                            </div>
                        </div>

                        <!-- Paso 3 -->
                        <div id="page-3" class="form-step d-none">
                            <!-- Contenido del paso 3 -->
                            <?php include 'datos_reclamo.php'; ?>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="prev"
                                    data-target="page-2">Atrás</button>
                                <button type="button" class="btn btn-dark-gray btn-box-shadow" id="submit-button">Enviar</button>
                            </div>
                        </div>
                    </form>
                    <!-- Fin del formulario principal -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ReCaptcha V3 -->
<script src="https://www.google.com/recaptcha/api.js?render=6Lfwo1UqAAAAAEk7jHzIZyzrHY0TMowxO5x4Z8pM"></script>

<script>
    document.getElementById('submit-button').addEventListener('click', function() {
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lfwo1UqAAAAAEk7jHzIZyzrHY0TMowxO5x4Z8pM', {action: 'submit'}).then(function(token) {
                // Añade el token al formulario antes de enviarlo
                let form = document.getElementById('main-form');
                let input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'g-recaptcha-response');
                input.setAttribute('value', token);
                form.appendChild(input);

                // Envía el formulario
                form.submit();
            });
        });
    });
</script>
