<link rel="stylesheet" href="<?php echo $path ?>/views/assets/css/styles/preloader_spinner.css">
<script type="text/javascript" src="<?php echo $path ?>/views/assets/js/api.js"></script>
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5"
    style="background-image: url('<?php echo $path ?>/views/assets/images/turnos/banner_turnos.jpeg')">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px"
                    data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    Turnos Online</h1>
            </div>
            <div class="down-section text-center"
                data-anime='{ "translateY": [-15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <a href="#down-section" aria-label="scroll down" class="section-link">
                    <div
                        class="d-flex justify-content-center align-items-center mx-auto rounded-circle fs-30 text-white">
                        <i class="feather icon-feather-chevron-down"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<!-- start section -->
<section id="down-section">
    <div class="container">
        <div class="row">
            <div class="col-12 px-0 position-relative">
                <!-- start preloader -->
                <div id="preloader" class="preloader-iframe">
                    <div class="spinner"></div>
                </div>
                <!-- end preloader -->

                <div class="col-md-8 layout__turnos">
                    
                    <?php
                    require_once 'controllers/controller.turno.php';
                    $manage = new TurnoController();
                    $manage->turnoManage();
                    ?>
                    <form action="" method="post">
                        <input type="hidden" name="redirec_turno" value="/turnos">
                        <div class="card mb-3">

                            <div id="datosTurno">

                                <div class="row" >
                                    <div class="container">
                                        <div class="card-header">
                                            <h4>Datos Turno</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="id_dependencia_turno">Dependencia <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select id="id_dependencia_turno" name="id_dependencia_turno"
                                            class="form-control required">
                                            <option value="">Seleccione Dependencia</option>
                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="id_servicio_turno">Servicio <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select id="id_servicio_turno" name="id_servicio_turno"
                                            class="form-control required">
                                            <option value="">Seleccione Servicio</option>
                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="fecha_turno">Fecha <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <select id="fecha_turno" name="fecha_turno" class="form-control required"
                                            onchange="handleFechaChange()">
                                            <option value="">Seleccione una fecha</option>
                                        </select>
                                    </div>


                                    <div class='form-group pb-3'>
                                        <label for='horario_turno'>Horario <sup
                                                class='text-danger font-weight-bold'>*</sup></label>
                                        <select id='horario_turno' name='horario_turno' class='form-control required'>
                                            <option value=''>Seleccione Horario</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 text-center d-flex justify-content-between align-items-center">
                                                <label class="font-weight-light mb-3"><sup class="text-danger">*</sup> Campos obligatorios</label>
                                                <button class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill" id="btn_1">SIGUIENTE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="datosPersonales">

                                <div class="row">
                                    <div class="container">
                                        <div class="card-header">
                                            <h4>Datos Personales</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">


                                    <div class="form-group">
                                        <label for="nombre_turno">Nombre <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" id="nombre_turno" name="nombre_turno"
                                            class="form-control required" required placeholder="Ingrese su nombre">
                                    </div>


                                    <div class="form-group">
                                        <label for="dni_turno">DNI <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="numeros" id="dni_turno" name="dni_turno"
                                            class="form-control required" required placeholder="Ingrese su DNI">
                                    </div>


                                    <div class="form-group">
                                        <label for="telefono_turno">Teléfono <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="numeros" id="telefono_turno" name="telefono_turno"
                                            class="form-control required" required placeholder="Ingrese su teléfono">
                                    </div>


                                    <div class="form-group">
                                        <label for="direccion_turno">Dirección <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" id="direccion_turno" name="direccion_turno"
                                            class="form-control required" required placeholder="Ingrese su dirección">
                                    </div>


                                    <div class="form-group">
                                        <label for="correo_turno">Correo <sup
                                                class="text-danger font-weight-bold">*</sup></label>
                                        <input type="email" id="correo_turno" name="correo_turno"
                                            class="form-control required" required placeholder="Ingrese su correo">
                                    </div>


                                </div>

                                <div class="card-footer">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 text-center d-flex justify-content-between align-items-center">
                                                <button class="btn border-0 btn-secondary py-2 px-3 btn-sm rounded-pill" id="btn_atras2">ATRÁS</button>
                                                <label class="font-weight-light mb-3"><sup class="text-danger">*</sup> Campos obligatorios</label>
                                                <button class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill" id="btn_2">SIGUIENTE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Resumen de datos -->
                            <div id="datosResumen">
                                <div class="card-header">
                                    <h4>Resumen de Datos</h4>
                                </div>
                                <div class="card-body">
                                    <p><strong>Dependencia:</strong> <span id="res_dependencia"></span></p>
                                    <p><strong>Servicio:</strong> <span id="res_servicio"></span></p>
                                    <p><strong>Fecha:</strong> <span id="res_fecha"></span></p>
                                    <p><strong>Horario:</strong> <span id="res_horario"></span></p>
                                    <p><strong>Nombre:</strong> <span id="res_nombre"></span></p>
                                    <p><strong>DNI:</strong> <span id="res_dni"></span></p>
                                    <p><strong>Teléfono:</strong> <span id="res_telefono"></span></p>
                                    <p><strong>Dirección:</strong> <span id="res_direccion"></span></p>
                                    <p><strong>Correo:</strong> <span id="res_correo"></span></p>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Enviar</button>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
</section>
<!-- end section -->


<script>
const datosTurno = document.getElementById('datosTurno');
const datosPersonales = document.getElementById('datosPersonales');
const datosResumen = document.getElementById('datosResumen');
const button1 = document.getElementById('btn_1');
const button2 = document.getElementById('btn_2');
const button_atras2 = document.getElementById('btn_atras2');

// Inicialmente ocultamos los datos personales y deshabilitamos los botones
datosPersonales.style.display = 'none';
datosResumen.style.display = 'none';
button1.disabled = true;
button2.disabled = true;
button_atras2.disabled = true;

// Función para habilitar o deshabilitar el botón en la primera parte
function toggleButtonState() {
    const inputsInvalidos = document.getElementsByClassName('is-invalid');

    // Verificar si hay campos inválidos
    let hayCamposInvalidos = inputsInvalidos.length > 0;

    // Verificar si todos los selects tienen un valor seleccionado
    const selects = datosTurno.querySelectorAll('select');
    const haySelectsVacios = Array.from(selects).some(select => select.value === '');

    // El botón se deshabilita si hay campos inválidos o selects vacíos
    button1.disabled = hayCamposInvalidos || haySelectsVacios;
}

// Agregar un evento a todos los campos de entrada en la primera parte del formulario
const inputs = datosTurno.querySelectorAll('input, select, textarea');
inputs.forEach(input => {
    input.addEventListener('input', toggleButtonState);
    input.addEventListener('change', toggleButtonState);
});

// Si pasa las validaciones y da clic en "siguiente"
button1.addEventListener('click', (event) => {
    event.preventDefault();
    datosTurno.style.display = 'none';
    datosPersonales.style.display = 'block';
    button_atras2.disabled = false;
});

// Agregar un evento a todos los campos de entrada en la segunda parte del formulario
const inputsP = datosPersonales.querySelectorAll('input, select, textarea');
inputsP.forEach(inputP => {
    inputP.addEventListener('input', toggleButtonStateP);
    inputP.addEventListener('change', toggleButtonStateP);
});

// Función para habilitar o deshabilitar el botón en la segunda parte
function toggleButtonStateP() {
    const inputsInvalidos = document.getElementsByClassName('is-invalid');

    // Verificar si hay campos inválidos
    let hayCamposInvalidos = inputsInvalidos.length > 0;

    // Verificar si todos los campos requeridos (con clase 'required') tienen un valor
    const inputsRequeridos = datosPersonales.querySelectorAll('.required');
    const hayCamposVacios = Array.from(inputsRequeridos).some(input => input.value.trim() === '');

    // El botón se deshabilita si hay campos inválidos o campos vacíos
    button2.disabled = hayCamposInvalidos || hayCamposVacios;
}

// Si pasa las validaciones y da clic en "siguiente" en la segunda parte
button2.addEventListener('click', (event) => {
    event.preventDefault();
    // Aquí puedes agregar lógica para lo que sucede al hacer clic en button2
});

// Botón para volver atrás en la segunda parte
button_atras2.addEventListener('click', (event) => {
    event.preventDefault();
    datosPersonales.style.display = 'none';
    datosTurno.style.display = 'block';
});

//Si pasa la segunda validacion mostramos el display final con los datos
button2.addEventListener('click', (event) => {

    event.preventDefault();

    // Obtener datos del formulario
    const dependenciaSelect = document.getElementById('id_dependencia_turno');
    const servicioSelect = document.getElementById('id_servicio_turno');
    
    const dependencia = dependenciaSelect.options[dependenciaSelect.selectedIndex].text;
    const servicio = servicioSelect.options[servicioSelect.selectedIndex].text;

    const fecha = document.getElementById('fecha_turno').value;
    const horario = document.getElementById('horario_turno').value;
    const nombre = document.getElementById('nombre_turno').value;
    const dni = document.getElementById('dni_turno').value;
    const telefono = document.getElementById('telefono_turno').value;
    const direccion = document.getElementById('direccion_turno').value;
    const correo = document.getElementById('correo_turno').value;

    // Mostrar datos en el resumen
    document.getElementById('res_dependencia').textContent = dependencia;
    document.getElementById('res_servicio').textContent = servicio;
    document.getElementById('res_fecha').textContent = fecha;
    document.getElementById('res_horario').textContent = horario;
    document.getElementById('res_nombre').textContent = nombre;
    document.getElementById('res_dni').textContent = dni;
    document.getElementById('res_telefono').textContent = telefono;
    document.getElementById('res_direccion').textContent = direccion;
    document.getElementById('res_correo').textContent = correo;

    // Ocultar formularios y mostrar resumen
    datosTurno.style.display = 'none';
    datosPersonales.style.display = 'none';
    datosResumen.style.display = 'block';

})


</script>

<script type="text/javascript" src="<?php echo $path ?>/views/assets/js/crearTurno.js"></script>




<style>
.layout__turnos {

    margin: 0 auto;
}
</style>




<script src="<?php echo $path ?>/views/assets/js/preloader.js"></script>