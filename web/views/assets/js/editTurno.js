async function apiRequest(url, method, fields) {
    try {
        const options = {
            method: method,
            headers: {
                'Authorization': 'SSDFzdg235dsgsdfAsa44SDFGDFDadg',
                'Content-Type': 'application/json',
            }
        };
        if (method !== 'GET') {
            options.body = JSON.stringify(fields);
        }
        const response = await fetch(`http://testfunes.online/${url}`, options);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

/*=============================================
Funciones para Fechas
=============================================*/
function obtenerFechasHabiles() {
    const fechasHabiles = [];
    const hoy = new Date();
    const diasMaximos = 30;

    for (let i = 0; i < diasMaximos; i++) {
        const fecha = new Date(hoy);
        fecha.setDate(hoy.getDate() + i);

        // Obtener el día de la semana (0=Domingo, 1=Lunes, ..., 6=Sábado)
        const diaSemana = fecha.getDay();

        // Solo agregar si es entre Lunes (1) y Viernes (5)
        if (diaSemana >= 1 && diaSemana <= 5) {
            // Formatear la fecha como "YYYY-MM-DD"
            const dia = String(fecha.getDate()).padStart(2, '0');
            const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // Los meses son 0-indexados
            const anio = fecha.getFullYear();
            const fechaFormateada = `${anio}-${mes}-${dia}`;
            
            fechasHabiles.push(fechaFormateada);
        }
    }
    return fechasHabiles;
}

function cargarFechasHabiles() {
    const selectFecha = document.getElementById('fecha_turno');
    const fechasHabiles = obtenerFechasHabiles();

    // Limpiar el select antes de cargar nuevas opciones
    selectFecha.innerHTML = '<option value="">Seleccione una fecha</option>';

    // Agregar las fechas como opciones del select
    fechasHabiles.forEach(fecha => {
        const opcion = document.createElement('option');
        opcion.value = fecha;
        opcion.textContent = fecha;
        selectFecha.appendChild(opcion);

        // Verifica si la fecha coincide con la de turnoInfo
        if (turnoInfo && fecha === turnoInfo.fecha_turno) {
            opcion.selected = true; // Selecciona la opción si coincide
        }
    });
}



/*=============================================
Obtengo ID de la URL
=============================================*/
const params = new URLSearchParams(window.location.search);
const idBase64 = params.get('turno');
const id = atob(idBase64);

//console.log(id);

/*=============================================
Variable Turno
=============================================*/
let turnoInfo = null;


/*=============================================
Obtengo datos del turno
=============================================*/
const turnoData = async () => {
    try {
        let url = `turnos?linkTo=id_turno&equalTo=${id}&select=*`;
        let method = 'GET';
        let fields = [];

        const response = await apiRequest(url, method, fields); 
        //console.log(response); 

        // Almacena la respuesta en la variable turnoInfo
        if (response.results && response.results.length > 0) { // Verifica que haya resultados
            turnoInfo = response.results[0]; // Almacena el primer resultado
            //console.log(turnoInfo); // Imprime el objeto almacenado para verificar

        } else {
            console.error('No se encontraron resultados en la respuesta del API:', response);
        }
    } catch (error) {
        console.error('Error al cargar:', error);
    }
};

/*=============================================
Cargar Horarios
=============================================*/
async function loadHorarios(dependenciaId, servicioId, fecha) {
    const urlDependencia = `dependencias?linkTo=id_dependencia&equalTo=${dependenciaId}`;
    const urlTurnos = `turnos?linkTo=id_dependencia_turno,id_servicio_turno,fecha_turno&equalTo=${dependenciaId},${servicioId},${fecha}`;

    try {
        const dependencia = await apiRequest(urlDependencia, 'GET', []);
        const { inicio_dependencia, fin_dependencia, duracion_dependencia } = dependencia.results[0];

        if (!inicio_dependencia || !fin_dependencia || !duracion_dependencia) {
            throw new Error('Horarios o duración no válidos.');
        }

        const horariosPosibles = [];
        let current = new Date(`1970-01-01T${inicio_dependencia}`);
        const end = new Date(`1970-01-01T${fin_dependencia}`);
        const duracionEnMinutos = duracion_dependencia;

        if (isNaN(duracionEnMinutos) || duracionEnMinutos <= 0) {
            throw new Error('La duración de la dependencia es inválida.');
        }

        while (current < end) {
            horariosPosibles.push(current.toTimeString().substring(0, 5));
            current.setMinutes(current.getMinutes() + duracionEnMinutos);
        }

        // Obtener los turnos
        try {
            const turnos = await apiRequest(urlTurnos, 'GET', []);
            const horariosOcupados = turnos.results.map(turno => turno.inicio_turno.slice(0, 5));

            // Filtrar los horarios disponibles
            const horarioTurnoActual = turnoInfo.inicio_turno.slice(0, 5); // Obtener solo HH:MM
            if (!horariosOcupados.includes(horarioTurnoActual) && fecha === turnoInfo.fecha_turno) {
                horariosOcupados.push(horarioTurnoActual); // Agregar el horario del turno actual a los ocupados si no está ya
            }

            const horariosDisponibles = horariosPosibles.filter(horario => !horariosOcupados.includes(horario));

            const select = document.getElementById('horario_turno');
            select.innerHTML = '<option value="">Seleccione Horario</option>';
            horariosDisponibles.forEach(horario => {
                const option = document.createElement('option');
                option.value = horario;
                option.textContent = horario;
                select.appendChild(option);
            });

            // Seleccionar el horario del turno actual si coincide
            if (fecha === turnoInfo.fecha_turno) {
                const option = document.createElement('option');
                option.value = horarioTurnoActual;
                option.textContent = horarioTurnoActual;
                select.appendChild(option);
                option.selected = true; // Selecciona la opción si coincide
            }

        } catch (error) {
            console.error('Error al cargar los turnos:', error);
            const select = document.getElementById('horario_turno');
            select.innerHTML = '<option value="">Seleccione Horario</option>';
            horariosPosibles.forEach(horario => {
                const option = document.createElement('option');
                option.value = horario;
                option.textContent = horario;
                select.appendChild(option);

                // Selecciona el horario si coincide con el de turnoInfo (sin segundos)
                const horarioSinSegundos = turnoInfo.inicio_turno.slice(0, 5); // Obtener solo HH:MM
                if (turnoInfo && horario === horarioSinSegundos && fecha === turnoInfo.fecha_turno) {
                    option.selected = true; // Selecciona la opción si coincide
                }
            });
        }

    } catch (error) {
        console.error('Error al cargar la dependencia:', error);
    }
}


/*=============================================
Cargar Horarios Cuando Cambio la Fecha
=============================================*/
function handleFechaChange() {
    const dependenciaId = document.getElementById('id_dependencia_turno').value;
    const servicioId = document.getElementById('id_servicio_turno').value;
    const fecha = document.getElementById('fecha_turno').value;
    if (dependenciaId && servicioId && fecha) {
        loadHorarios(dependenciaId, servicioId, fecha);
    }
}

/*=============================================
Cargo Dependencias, Servicios y Fechas
=============================================*/
let dependenciasInfo = null;
let serviciosInfo = null;
let fechasInfo = null;

let dependenciaSelect = document.getElementById('id_dependencia_turno');
let servicioSelect = document.getElementById('id_servicio_turno');
let fechaSelect = document.getElementById('fecha_turno');

dependenciaSelect.disabled = true;
servicioSelect.disabled = true;
//fechaSelect.disabled = true;

/*=============================================
Selecciono la data que viene en el turno a editar
=============================================*/
const selectData  = async () => {

    try{

        try{

            let url = `dependencias?select=id_dependencia,descripcion_dependencia`;
            let method = 'GET';
            let fields = [];
    
            const response = await apiRequest(url, method, fields); 
            //console.log(response); 

            
            if (response.results && response.results.length > 0) {

                // Limpia las opciones existentes
                dependenciaSelect.innerHTML = '<option value="">Seleccione Dependencia</option>';

                // Itera sobre los resultados y crea las opciones
                response.results.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id_dependencia; // Establece el valor
                    option.textContent = item.descripcion_dependencia; // Establece el texto visible
                    dependenciaSelect.appendChild(option); // Agrega la opción al select
                    
                    // Verifica si el id coincide con el de turnoInfo
                    if (turnoInfo && item.id_dependencia == turnoInfo.id_dependencia_turno) {
                        option.selected = true; // Selecciona la opción si coincide
                    }
                });

            } else {
                console.error('No se encontraron resultados en la respuesta del API:', response);
            }

        }catch(error){

            console.error('Error al cargar dependencias: ', error);
        }


        try{

            let url = `servicios?select=id_servicio,descripcion_servicio`;
            let method = 'GET';
            let fields = [];
    
            const response = await apiRequest(url, method, fields); 
            //console.log(response); 
            if (response.results && response.results.length > 0) {

                
                servicioSelect.innerHTML = '<option value="">Seleccione Servicio</option>';

                
                response.results.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id_servicio; 
                    option.textContent = item.descripcion_servicio; 
                    servicioSelect.appendChild(option); 

                    // Verifica si el id coincide con el de turnoInfo
                    if (turnoInfo && item.id_servicio == turnoInfo.id_servicio_turno) {
                        option.selected = true; // Selecciona la opción si coincide
                    }
                });

            } else {
                console.error('No se encontraron resultados en la respuesta del API:', response);
            }

        }catch(error){

            console.error('Error al cargar servicios: ', error);
        }

        try{

            cargarFechasHabiles();

        }catch(error){

            console.error('Error al cargar fechas: ', error);
        }

        document.getElementById('nombre_turno').value = turnoInfo.nombre_turno;
        document.getElementById('dni_turno').value = turnoInfo.dni_turno;
        document.getElementById('telefono_turno').value = turnoInfo.telefono_turno;
        document.getElementById('direccion_turno').value = turnoInfo.direccion_turno;
        document.getElementById('correo_turno').value = turnoInfo.correo_turno;

    }
    catch(error){

        console.error('Error al cargar datos: ', error);

    }
}


/*=============================================
Cargo métodos
=============================================*/
turnoData();
selectData();

document.addEventListener("DOMContentLoaded", () => {
    const dependenciaId = turnoInfo.id_dependencia_turno;
    const servicioId = turnoInfo.id_servicio_turno;
    const fecha = turnoInfo.fecha_turno;

    loadHorarios(dependenciaId, servicioId, fecha).then(() => {
        const selectHorario = document.getElementById('horario_turno');
        const horarioSinSegundos = turnoInfo.inicio_turno.slice(0, 5); // Obtener solo HH:MM

        // Verificar si hay opciones en el select y seleccionar la opción que coincide
        const options = Array.from(selectHorario.options);
        options.forEach(option => {
            if (option.value  === horarioSinSegundos && fecha === turnoInfo.fecha_turno) {
                option.selected = true; // Selecciona la opción si coincide
            }
        });
    });
});


// Llamada a cargar horarios al seleccionar una fecha
fechaSelect.addEventListener('change', handleFechaChange);







