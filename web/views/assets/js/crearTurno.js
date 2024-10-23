async function loadDependenciasAndServicios() {
    const dependenciaSelect = document.getElementById('id_dependencia_turno');
    const servicioSelect = document.getElementById('id_servicio_turno');

    // Load Dependencias
    try {
        const dependenciasData = await apiRequest('dependencias?select=id_dependencia,descripcion_dependencia', 'GET', []);
        dependenciaSelect.innerHTML = '<option value="">Seleccione Dependencia</option>';
        dependenciasData.results.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id_dependencia;
            option.textContent = item.descripcion_dependencia;
            dependenciaSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar dependencias:', error);
    }

    // Add event listener for Dependencia change
    dependenciaSelect.addEventListener('change', async function() {
        const dependenciaId = this.value;
        if (dependenciaId) {
            // Load Servicios based on selected Dependencia
            const url = `servicios?select=id_servicio,descripcion_servicio&id_area_servicio=${dependenciaId}`;
            try {
                const serviciosData = await apiRequest(url, 'GET', []);
                servicioSelect.innerHTML = '<option value="">Seleccione Servicio</option>';
                serviciosData.results.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id_servicio;
                    option.textContent = item.descripcion_servicio;
                    servicioSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error al cargar servicios:', error);
            }
        } else {
            // Clear Servicios if no Dependencia is selected
            servicioSelect.innerHTML = '<option value="">Seleccione Servicio</option>';
        }
    });
}

// Call the function when the document is ready
document.addEventListener('DOMContentLoaded', loadDependenciasAndServicios);


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

        //console.log(horariosPosibles);

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
            //console.log(turnos);

            // Obtener los horarios ocupados, eliminando los segundos
            const horariosOcupados = turnos.results.map(turno => turno.inicio_turno.slice(0, 5));
            //console.log(horariosOcupados);

            // Filtrar los horarios disponibles
            const horariosDisponibles = horariosPosibles.filter(horario => !horariosOcupados.includes(horario));
            //console.log(horariosDisponibles);

            const select = document.getElementById('horario_turno');
            select.innerHTML = '<option value="">Seleccione Horario</option>';
            horariosDisponibles.forEach(horario => {
                const option = document.createElement('option');
                option.value = horario;
                option.textContent = horario;
                select.appendChild(option);
            });

        } catch (error) {

            const select = document.getElementById('horario_turno');
                select.innerHTML = '<option value="">Seleccione Horario</option>';
                horariosPosibles.forEach(horario => {
                    const option = document.createElement('option');
                    option.value = horario;
                    option.textContent = horario;
                    select.appendChild(option);
                });
        }

    } catch (error) {
        console.error('Error al cargar la dependencia:', error);
    }
}

    function handleFechaChange() {
        const dependenciaId = document.getElementById('id_dependencia_turno').value;
        const servicioId = document.getElementById('id_servicio_turno').value;
        const fecha = document.getElementById('fecha_turno').value;
        if (dependenciaId && servicioId && fecha) {
            loadHorarios(dependenciaId, servicioId, fecha);
        }
    }

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
        });
    }


    
    



