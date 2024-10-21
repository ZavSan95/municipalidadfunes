<?php

if (isset($_GET['turno'])) {
$select = "id_turno,id_dependencia_turno,id_servicio_turno,fecha_turno,inicio_turno,fin_turno,".
"nombre_turno,dni_turno,telefono_turno,direccion_turno,correo_turno";
$url = "turnos?linkTo=id_turno&equalTo=" . base64_decode($_GET['turno']);
$method = "GET";
$fields = array();

$turno = CurlController::request($url, $method, $fields);

if ($turno->status == 200) {
$turno = $turno->results[0];
} else {
$turno = null;
}
} else {
$turno = null;
}
echo '<pre>';print_r($turno);echo '</pre>'
?>


<div class="content">
    <div class="container">
        <div class="card">
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <?php if (!empty($turno)): ?>
                <input type="hidden" name="idTurno" value="<?php echo base64_encode($turno->id_turno) ?>">
                <?php endif ?>

                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 text-center text-lg-left">
                                <?php if (!empty($turno)): ?>
                                <h4 class="mt-3">Editar Turno</h4>
                                <?php else: ?>
                                <h4 class="mt-3">Agregar Turno</h4>
                                <?php endif ?>
                            </div>
                            <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
                                <button type="submit" class="btn border-0 btn-info float-right py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
                                <a href="/admin/turnos/calendario" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
                            </div>
                            <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                                <div><a href="/admin/turnos/calendario" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>
                                <div><button type="submit" class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill">Guardar Información</button></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php 
                    require_once 'controllers/controller.turno.php';
                    $manage = new TurnoController;
                    $manage->turnoManage();
                    ?>
                    <div class="row">
                        <!-- Dependencia y Servicio -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="id_dependencia_turno">Dependencia <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="id_dependencia_turno" name="id_dependencia_turno" class="form-control required" onchange="">
                                            <option value="">Seleccione Dependencia</option>
                                        </select>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="id_servicio_turno">Servicio <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="id_servicio_turno" name="id_servicio_turno" class="form-control required">
                                            <option value="">Seleccione Servicio</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="fecha_turno">Fecha <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select id="fecha_turno" name="fecha_turno" class="form-control required" onchange="handleFechaChange()">
                                            <option value="">Seleccione una fecha</option>
                                            <?php 
                                                $turnoController = new TurnoController();
                                                $fechasHabiles = $turnoController->obtenerFechasHabiles();
                                                foreach ($fechasHabiles as $fecha) {
                                                    echo '<option value="'.$fecha.'" '.((isset($_POST['fecha_turno']) && $_POST['fecha_turno'] == $fecha) ? 'selected' : '').'>'.$fecha.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>


                                    <div class='form-group pb-3'>
                                        <label for='horario_turno'>Horario <sup class='text-danger font-weight-bold'>*</sup></label>
                                        <select id='horario_turno' name='horario_turno' class='form-control required'>
                                        <option value=''>Seleccione un horario</option>
                                        
                                        </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="container">
                            <div class="card-header">
                                    <h4>Datos Personales</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card mb-3">

                            <div class="card-body">
                                <!-- Campos adicionales -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nombre_turno">Nombre <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" id="nombre_turno" name="nombre_turno" class="form-control required" required placeholder="Ingrese su nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="dni_turno">DNI <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="numeros" id="dni_turno" name="dni_turno" class="form-control required" required placeholder="Ingrese su DNI" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="telefono_turno">Teléfono <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="numeros" id="telefono_turno" name="telefono_turno" class="form-control required" required placeholder="Ingrese su teléfono" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="direccion_turno">Dirección <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="all" id="direccion_turno" name="direccion_turno" class="form-control required" required placeholder="Ingrese su dirección" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="correo_turno">Correo <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="email" id="correo_turno" name="correo_turno" class="form-control required" required placeholder="Ingrese su correo" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<script>
    async function apiRequest(url, method, fields) {
    try {
        // Define la configuración para el fetch
        const options = {
            method: method, // Método HTTP (GET, POST, PUT, etc.)
            headers: {
                'Authorization': 'SSDFzdg235dsgsdfAsa44SDFGDFDadg', // Token de autorización
                'Content-Type': 'application/json', // Encabezado para indicar JSON
            }
        };

        // Agregar el body si el método no es GET
        if (method !== 'GET') {
            options.body = JSON.stringify(fields); // Convierte los datos a JSON
        }

        // Realiza la solicitud
        const response = await fetch(`http://testfunes.online/${url}`, options);
        
        // Comprueba si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Convierte la respuesta a JSON
        const data = await response.json();
        return data; // Devuelve los datos JSON

    } catch (error) {
        console.error('Error:', error);
        throw error; // Lanza el error para manejarlo externamente si es necesario
    }
}

// Función para cargar dependencias en el select
function loadDependenciasIntoSelect(dependencias) {
    const select = document.getElementById('id_dependencia_turno');
    
    // Limpia el select antes de agregar opciones
    select.innerHTML = '<option value="">Seleccione Dependencia</option>';

    dependencias.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id_dependencia; // ID de la dependencia
        option.textContent = item.descripcion_dependencia; // Descripción como texto
        select.appendChild(option);
    });
}

// Uso del controlador
apiRequest('dependencias?select=id_dependencia,descripcion_dependencia', 'GET', [])
    .then(data => {
        // Asegúrate de que data.results contenga los elementos que deseas
        loadDependenciasIntoSelect(data.results); // Carga las dependencias en el select
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });

    // Función para cargar servicios en el select según la dependencia seleccionada
async function loadServicios(dependenciaId) {
    const url = `servicios?select=id_servicio,descripcion_servicio&id_area_servicio=${dependenciaId}`; // Genera la URL

    try {
        const data = await apiRequest(url, 'GET', []);
        const select = document.getElementById('id_servicio_turno');
        select.innerHTML = '<option value="">Seleccione Servicio</option>'; // Limpia las opciones anteriores

        // Agrega las nuevas opciones de servicios
        data.results.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id_servicio; // ID del servicio
            option.textContent = item.descripcion_servicio; // Descripción del servicio
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar los servicios:', error);
    }
}

// Agrega el evento onchange al select de dependencias
document.getElementById('id_dependencia_turno').addEventListener('change', function() {
    const dependenciaId = this.value; // Obtiene el ID de la dependencia seleccionada
    if (dependenciaId) {
        loadServicios(dependenciaId); // Carga los servicios correspondientes
    } else {
        const selectServicios = document.getElementById('id_servicio_turno');
        selectServicios.innerHTML = '<option value="">Seleccione Servicio</option>'; // Reinicia el select de servicios
    }
});

async function loadHorarios(dependenciaId, servicioId, fecha) {
    const urlDependencia = `dependencias?linkTo=id_dependencia&equalTo=${dependenciaId}`; // Suponiendo que puedes obtener los detalles de la dependencia por ID
    const urlTurnos = `turnos?linkTo=id_dependencia_turno,id_servicio_turno,fecha_turno&equalTo=${dependenciaId},${servicioId},${fecha}`;

    try {
        // Primero, obtenemos los detalles de la dependencia
        const dependencia = await apiRequest(urlDependencia, 'GET', []);
        console.log(dependencia);
        
        // Desestructuramos los horarios de la dependencia
        const { inicio_dependencia, fin_dependencia, duracion_dependencia } = dependencia.results[0];

        // Calculamos todos los horarios posibles
        const horariosPosibles = [];
        let current = new Date(`1970-01-01T${inicio_dependencia}:00`);
        const end = new Date(`1970-01-01T${fin_dependencia}:00`);

        while (current <= end) {
            horariosPosibles.push(current.toTimeString().split(' ')[0]); // Formato HH:mm:ss
            current.setMinutes(current.getMinutes() + duracion_dependencia); // Aumentar por duración
        }

        // Obtenemos los turnos ya existentes
        const turnos = await apiRequest(urlTurnos, 'GET', []);
        console.log(turnos);
        const horariosOcupados = turnos.results.map(turno => turno.inicio_turno); // Suponiendo que 'inicio_turno' es el horario ocupado

        // Filtramos los horarios posibles para eliminar los ocupados
        const horariosDisponibles = horariosPosibles.filter(horario => !horariosOcupados.includes(horario));

        // Llenamos el select de horarios
        const select = document.getElementById('horario_turno');
        select.innerHTML = '<option value="">Seleccione Horario</option>'; // Reiniciar opciones

        horariosDisponibles.forEach(horario => {
            const option = document.createElement('option');
            option.value = horario; // Usar el horario como valor
            option.textContent = horario; // Mostrar el horario
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar los horarios:', error);
    }
}

function handleFechaChange() {
    const dependenciaId = document.getElementById('id_dependencia_turno').value;
    const servicioId = document.getElementById('id_servicio_turno').value;
    const fecha = document.getElementById('fecha_turno').value;

    // Verificamos que todos los valores necesarios estén seleccionados
    if (dependenciaId && servicioId && fecha) {
        loadHorarios(dependenciaId, servicioId, fecha);
    }
}


</script>
