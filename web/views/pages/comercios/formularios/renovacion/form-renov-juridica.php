<form action="/generar-pdf" method="post" id="form-renov-juridica">
    <div class="card">
        <div class="card-header">
            <h4>Renovación de Habilitación Comercial - Persona Jurídica</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rubro">Rubro*</label>
                    <select name="id_rubro" class="form-control">
                        <option value="">Seleccione Rubro</option>
                        <?php 
                        $url = "rubros?select=id_rubro,descripcion_rubro&orderBy=descripcion_rubro&orderMode=ASC";
                        $method = "GET";
                        $fields = array();
                        $rubros = CurlController::request($url,$method,$fields);
                        if($rubros->status == 200){
                            $rubros = $rubros->results;
                            foreach ($rubros as $value) {
                                echo '<option value="'.$value->id_rubro.'">'.$value->descripcion_rubro.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cuenta_drei">Número Cuenta DREI*</label>
                    <input id="cuenta_drei" type="numeros" name="cuenta_drei" class="form-control" placeholder="Número Cuenta DREI*">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha_inicio">Fecha Inicio de la Actividad</label>
                    <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control" placeholder="Fecha Inicio de la Actividad">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nombre_fantasia">Nombre de Fantasía*</label>
                    <input id="nombre_fantasia" type="all" name="nombre_fantasia" class="form-control" placeholder="Nombre de Fantasía*">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tipo_contribuyente">Tipo de Contribuyente*</label>
                    <input type="text" class="form-control" name="tipo_contribuyente" id="tipo_contribuyente" value="Persona Jurídica" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="direccion">Dirección</label>
                    <input id="direccion" type="all" name="direccion" class="form-control" placeholder="Ingrese dirección">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="piso">Piso</label>
                    <input id="piso" type="all" name="piso" class="form-control" placeholder="Piso">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="departamento">Departamento/Oficina/Local</label>
                    <input id="departamento" type="all" name="departamento" class="form-control" placeholder="Número Departamento/Oficina/Local">
                </div>
            </div>

            <div class="card-header mb-3">

            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="razon_social">Nombre de la Sociedad *</label>
                    <input id="razon_social" type="all" name="razon_social" class="form-control" placeholder="Ingrese Razón Social">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cuit">CUIT *</label>
                    <input id="cuit" type="numeros" name="cuit" class="form-control" placeholder="Ingrese CUIT">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tipo_sociedad">Tipo de Sociedad *</label>
                    <select id="tipo_sociedad" name="tipo_sociedad" class="form-control">
                        <option value="" disabled selected>Elija una opción</option>
                        <option value="S.A.">S.A.</option>
                        <option value="S.R.L.">S.R.L.</option>
                        <option value="Cooperativa">Cooperativa</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telefono_contacto">Teléfono de Contacto *</label>
                    <input id="telefono_contacto" type="numeros" name="telefono_contacto" class="form-control" placeholder="Ingrese Teléfono de Contacto">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="Ingrese E-mail">
                </div>
            </div>

            <div class="card-header mb-3">

            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tomo">Tomo *</label>
                    <input id="tomo" type="all" name="tomo" class="form-control" placeholder="Ingrese Tomo">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="folio">Folio *</label>
                    <input id="folio" type="all" name="folio" class="form-control" placeholder="Ingrese Folio">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numero_inscripcion">Número *</label>
                    <input id="numero_inscripcion" type="numeros" name="numero_inscripcion" class="form-control" placeholder="Ingrese Número">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fecha_inscripcion">Fecha *</label>
                    <input id="fecha_inscripcion" type="date" name="fecha_inscripcion" class="form-control" placeholder="Ingrese día/mes/año">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="localidad_registro">Localidad del Registro *</label>
                    <input id="localidad_registro" type="text" name="localidad_registro" class="form-control" placeholder="Ingrese Localidad del Registro">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="domicilio_real">Calle *</label>
                    <input id="domicilio_real" type="text" name="domicilio_real" class="form-control" placeholder="Ingrese Domicilio Real">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="numero_domicilio">Número *</label>
                    <input id="numero_domicilio" type="numeros" name="numero_domicilio" class="form-control" placeholder="Ingrese Número">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="piso">Piso</label>
                    <input id="piso" type="text" name="all" class="form-control" placeholder="Ingrese Piso">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="departamento">Departamento</label>
                    <input id="departamento" type="all" name="departamento" class="form-control" placeholder="Ingrese Departamento">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="codigo_postal">C.P. *</label>
                    <input id="codigo_postal" type="numeros" name="codigo_postal" class="form-control" value="2132" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="localidad">Localidad *</label>
                    <input id="localidad" type="text" name="localidad" class="form-control" placeholder="Ingrese Localidad" value="Funes" readonly>
                </div>
            </div>

            <div class="card-header mb-3">

            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre_integrante">Nombre del Integrante *</label>
                    <input id="nombre_integrante" type="text" name="nombre_integrante" class="form-control" placeholder="Ingrese el nombre del integrante">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button id="back-juridica" type="button" class="btn btn-secondary">Regresar</button>
            <button id="env-juridica" type="submit" class="btn btn-base-color">Enviar</button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        //const enviarBtnJur = document.getElementById('env-juridica');
        constFields = document.querySelectorAll('#form-renov-juridica ');

        // Función para verificar el estado de los campos
        function checkFields() {
            let allValid = true;

        Fields.forEach(field => {
                // Verificar si el campo es válido
                if (!field.value || field.classList.contains('is-invalid')) {
                    allValid = false;
                }
            });

            // Habilitar o deshabilitar el botón
            enviarBtnJur.disabled = !allValid;
        }

        // Inicializar el estado del botón
        //checkFields();

        // Escuchar eventos de input y change en campos requeridos
        //Fields.forEach(field => {
        //     field.addEventListener('input', checkFields);
        //     field.addEventListener('change', checkFields);
        // });
    });
</script>

<script>
$(document).ready(function() {
    $('#form-renov-juridica').on('submit', function(e) {
        e.preventDefault(); // Prevenir el envío del formulario por defecto

        $.ajax({
            type: 'POST',
            url: '/ajax/data-renovacion.ajax.php',
            data: $(this).serialize(), // Serializa los datos del formulario
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message + '\nDatos: ' + JSON.stringify(response.data));
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Error en la solicitud. Intenta nuevamente.');
            }
        });
    });
});



</script>
