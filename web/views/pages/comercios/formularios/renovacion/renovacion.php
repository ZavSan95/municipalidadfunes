<div class="row">
    <div class="col-12 px-0 position-relative">
        <div class="container">
            <h3 style="text-align:center;">Formulario para renovación comercial</h3>

            <!-- Formulario principal -->
            <form id="form-renovacion" action="" method="post">

                <!-- Paso 1 -->
                <div id="page-1" class="form-step active">
                    <!-- Contenido del paso 1 -->
                    <?php include 'steps/step1.php'; ?>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="next"
                            data-target="page-2" id="btnPersona">Siguiente</button>
                    </div>
                </div>

                <!-- Paso 2 -->
                <div id="page-2" class="form-step d-none">
                    <!-- Contenido del paso 2 -->

                    <div id="paso2Fisica">
                        <?php include 'steps/step2-fisica.php'; ?>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="prev"
                            data-target="page-1">Atrás</button>
                            <button type="submit" class="btn btn-dark-gray btn-box-shadow">Enviar</button>
                        </div>
                    </div>

                    <div id="paso2Juridica">
                        <?php include 'steps/step2-juridica.php'; ?>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="prev"
                                data-target="page-1">Atrás</button>
                            <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="next"
                                data-target="page-3">Siguiente</button>
                        </div>
                    </div>
                    
                </div>


                <!-- Paso 3 -->
                <div id="paso3Juridica">
                    <div id="page-3" class="form-step d-none">
                        <!-- Contenido del paso 3 -->
                        <?php include 'steps/step3-juridica.php'; ?>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-dark-gray btn-box-shadow" data-action="prev"
                                data-target="page-2">Atrás</button>
                            <button type="submit" class="btn btn-dark-gray btn-box-shadow">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Fin del formulario principal -->

        </div>
    </div>
</div>






