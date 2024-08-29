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
                                        <!-- Paso 1 -->
                                        <div id="page-1" class="form-step active">
                                            <!-- Contenido del paso 1 -->
                                            <?php include 'datos_personales.php'; ?>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-dark-gray btn-box-shadow"
                                                    data-action="next" data-target="page-2">Siguiente</button>
                                            </div>
                                        </div>

                                        <!-- Paso 2 -->
                                        <div id="page-2" class="form-step d-none">
                                            <!-- Contenido del paso 2 -->
                                            <?php include 'datos_propiedad.php'; ?>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-dark-gray btn-box-shadow"
                                                    data-action="prev" data-target="page-1">Atrás</button>
                                                <button type="button" class="btn btn-dark-gray btn-box-shadow"
                                                    data-action="next" data-target="page-3">Siguiente</button>
                                            </div>
                                        </div>

                                        <!-- Paso 3 -->
                                        <div id="page-3" class="form-step d-none">
                                            <!-- Contenido del paso 3 -->
                                            <?php include 'datos_reclamo.php'; ?>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-dark-gray btn-box-shadow"
                                                    data-action="prev" data-target="page-2">Atrás</button>
                                                <button type="button" class="btn btn-dark-gray btn-box-shadow"
                                                    data-action="submit">Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Fin del formulario principal -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>