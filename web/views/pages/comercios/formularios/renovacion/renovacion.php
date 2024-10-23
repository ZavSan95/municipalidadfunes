<div class="row">
    <div class="col-12 px-0 position-relative">
        <div class="container">

            <!-- Botón para iniciar el trámite -->
            <button id="startFormButton" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0 pe-50px appear">Iniciar Trámite</button>

            <!-- Formulario principal (oculto inicialmente) -->
            <form id="multiStepForm" style="display: none;">

                <!-- Paso 1 - Tipo de Contribuyente -->
                <div class="form-step form-step-active" id="step-1">
                    <h3>PASO 1 - Selección de Tipo de Contribuyente</h3>

                    <div style="margin-bottom:16px;">
                        <label for="rubro">Rubro*</label>
                        <select name="id_rubro" class="form-control required">
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

                    <div style="margin-bottom:16px;">
                        <label for="cuenta_drei">Número Cuenta DREI*</label>
                        <input id="cuenta_drei" type="number" name="cuenta_drei" class="form-control required" placeholder="Número Cuenta DREI*" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="fecha_inicio">Fecha Inicio de la Actividad</label>
                        <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control required" placeholder="Fecha Inicio de la Actividad" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="nombre_fantasia">Nombre de Fantasía*</label>
                        <input id="nombre_fantasia" type="text" name="nombre_fantasia" class="form-control required" placeholder="Nombre de Fantasía*" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="tipo_contribuyente">Tipo de Contribuyente*</label>
                        <select id="tipo_contribuyente" name="tipo_contribuyente" class="form-control required">
                            <option value="0" disabled selected>Elija una opción*</option>
                            <option value="1">Persona Física</option>
                            <option value="2">Persona Jurídica</option>
                        </select>
                    </div>

                    <h4>DATOS DEL LOCAL</h4>

                    <div style="margin-bottom:16px;">
                        <label for="direccion">Dirección</label>
                        <input id="direccion" type="text" name="direccion" class="form-control required" placeholder="Ingrese dirección" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="piso">Piso</label>
                        <input id="piso" type="text" name="piso" class="form-control" placeholder="Piso">
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="departamento">Departamento/Oficina/Local</label>
                        <input id="departamento" type="text" name="departamento" class="form-control" placeholder="Número Departamento/Oficina/Local">
                    </div> 

                    <button type="button" class="btn btn-dark-gray" disabled id="next-1">Siguiente</button>
                </div>


                <!-- Paso 2 - Datos de la Persona Física -->
                <div class="form-step" id="step-2-fisica">
                    <h3>PASO 2 - Datos de la Persona Física</h3>

                    <div style="margin-bottom:16px;">
                        <label for="nombre">Nombre*</label>
                        <input id="nombre" type="text" name="nombre" class="form-control required" placeholder="Ingrese Nombre del Titular" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="apellido">Apellido*</label>
                        <input id="apellido" type="text" name="apellido" class="form-control required" placeholder="Ingrese Apellido del Titular" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="fecha_nacimiento">Fecha de Nacimiento* - Formato Fecha: 00/00/0000 -</label>
                        <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" class="form-control required" placeholder="Ingrese día/mes/año" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="cuit">CUIT*</label>
                        <input id="cuit" type="text" name="cuit" class="form-control required" placeholder="Ingrese CUIT" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="condicion_iva">Condición de IVA*</label>
                        <select id="condicion_iva" name="condicion_iva" class="form-control required">
                            <option value="" disabled selected>Elija una opción</option>
                            <option value="1">Responsable Inscripto</option>
                            <option value="2">Monotributista</option>
                            <option value="3">Exento</option>
                        </select>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="tipo_documento">Tipo de Documento*</label>
                        <select id="tipo_documento" name="tipo_documento" class="form-control required">
                            <option value="" disabled selected>Elija una opción</option>
                            <option value="1">DNI</option>
                            <option value="2">Pasaporte</option>
                            <option value="3">Cédula</option>
                        </select>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="numero_documento">Número de Documento del Titular*</label>
                        <input id="numero_documento" type="text" name="numero_documento" class="form-control required" placeholder="Ingrese Número de Documento del Titular" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="telefono_contacto">Teléfono de Contacto*</label>
                        <input id="telefono_contacto" type="tel" name="telefono_contacto" class="form-control required" placeholder="Ingrese Teléfono de Contacto" required>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label for="email">E-mail*</label>
                        <input id="email" type="email" name="email" class="form-control required" placeholder="Ingrese E-mail" required>
                    </div>


                    <button type="button" class="btn btn-dark-gray" id="back-1-fisica">Atrás</button>
                    <button type="button" class="btn btn-dark-gray" id="submit-fisica" disabled>Enviar</button>

                </div>

                <!-- Paso 2 - Datos de la Persona Jurídica -->
                <div class="form-step" id="step-2-juridica">
                    <h3>PASO 2 - Datos de la Persona Jurídica</h3>

                        <!-- Datos de la Persona Jurídica -->
                        <h4>DATOS DE LA PERSONA JURIDICA</h4>
                        
                        <div style="margin-bottom:16px;">
                            <label for="razon_social">Nombre de la Sociedad *</label>
                            <input id="razon_social" type="text" name="razon_social" class="form-control required" placeholder="Ingrese Razón Social" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="cuit">CUIT *</label>
                            <input id="cuit" type="text" name="cuit" class="form-control required" placeholder="Ingrese CUIT" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="tipo_sociedad">Tipo de Sociedad *</label>
                            <select id="tipo_sociedad" name="tipo_sociedad" class="form-control required">
                                <option value="" disabled selected>Elija una opción</option>
                                <option value="S.A.">S.A.</option>
                                <option value="S.R.L.">S.R.L.</option>
                                <option value="Cooperativa">Cooperativa</option>
                            </select>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="telefono_contacto">Teléfono de Contacto *</label>
                            <input id="telefono_contacto" type="text" name="telefono_contacto" class="form-control required" placeholder="Ingrese Teléfono de Contacto" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="email">E-mail</label>
                            <input id="email" type="email" name="email" class="form-control" placeholder="Ingrese E-mail">
                        </div>

                        <!-- Inscripción de la Sociedad -->
                        <h4>INSCRIPCION DE LA SOCIEDAD</h4>

                        <div style="margin-bottom:16px;">
                            <label for="tomo">Tomo *</label>
                            <input id="tomo" type="text" name="tomo" class="form-control required" placeholder="Ingrese Tomo" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="folio">Folio *</label>
                            <input id="folio" type="text" name="folio" class="form-control required" placeholder="Ingrese Folio" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="numero_inscripcion">Número *</label>
                            <input id="numero_inscripcion" type="text" name="numero_inscripcion" class="form-control required" placeholder="Ingrese Número" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="fecha_inscripcion">Fecha *</label>
                            <input id="fecha_inscripcion" type="date" name="fecha_inscripcion" class="form-control required" placeholder="Ingrese día/mes/año" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="localidad_registro">Localidad del Registro *</label>
                            <input id="localidad_registro" type="text" name="localidad_registro" class="form-control required" placeholder="Ingrese Localidad del Registro" required>
                        </div>

                        <!-- Domicilio Real -->
                        <h4>DOMICILIO REAL</h4>

                        <div style="margin-bottom:16px;">
                            <label for="domicilio_real">Calle *</label>
                            <input id="domicilio_real" type="text" name="domicilio_real" class="form-control required" placeholder="Ingrese Domicilio Real" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="numero_domicilio">Número *</label>
                            <input id="numero_domicilio" type="text" name="numero_domicilio" class="form-control required" placeholder="Ingrese Número" required>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="piso">Piso</label>
                            <input id="piso" type="text" name="piso" class="form-control" placeholder="Ingrese Piso">
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="departamento">Departamento</label>
                            <input id="departamento" type="text" name="departamento" class="form-control" placeholder="Ingrese Departamento">
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="codigo_postal">C.P. *</label>
                            <input id="codigo_postal" type="text" name="codigo_postal" class="form-control required" value="2132" readonly>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label for="localidad">Localidad *</label>
                            <input id="localidad" type="text" name="localidad" class="form-control required" placeholder="Ingrese Localidad" value="Funes" readonly required>
                        </div>


                    <button type="button" class="btn btn-dark-gray" id="back-1">Atrás</button>
                    <button type="button" class="btn btn-dark-gray" disabled id="next-2-juridica">Siguiente</button>
                </div>

                <!-- Paso 3 - Integrantes de la Persona Jurídica -->
                <div class="form-step" id="step-3">
                    <h3>PASO 3 - Datos de la Persona Integrante de la Sociedad</h3>

                    <div>
                        <label for="nombre_integrante">Nombre del Integrante *</label>
                        <input id="nombre_integrante" type="text" name="nombre_integrante" class="form-control required" placeholder="Ingrese el nombre del integrante" required>
                    </div>

                    <button type="button" class="btn btn-dark-gray" id="back-2">Atrás</button>
                    <button type="submit" class="btn btn-success" disabled id="submit">Finalizar</button>
                </div>

            </form>
            <!-- Fin del formulario principal -->

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const startButton = document.getElementById("startFormButton");
    const multiStepForm = document.getElementById("multiStepForm");
    const formSteps = Array.from(document.querySelectorAll(".form-step"));
    const nextButtons = Array.from(document.querySelectorAll('[id^="next-"]'));
    const backButtons = Array.from(document.querySelectorAll('[id^="back-"]'));
    const submitButtons = Array.from(document.querySelectorAll('[id^="submit-"]'));

    // Mostrar el formulario al hacer clic en "Iniciar Trámite"
    startButton.addEventListener("click", function () {
        multiStepForm.style.display = "block";
        showStep(0); // Mostrar el primer paso
    });

    // Función para mostrar un paso específico del formulario
    function showStep(stepIndex) {
        formSteps.forEach((step, index) => {
            step.style.display = index === stepIndex ? "block" : "none";
        });

        // Validar campos en el paso actual
        validateCurrentStep(stepIndex);
    }

    // Función para validar los campos del paso actual
    function validateCurrentStep(stepIndex) {
        const requiredFields = formSteps[stepIndex].querySelectorAll(".required");
        const nextButton = nextButtons[stepIndex];
        const isValid = Array.from(requiredFields).every(field => {
            if (field.value.trim() === "") {
                field.classList.add("is-invalid");
                return false;
            } else {
                field.classList.remove("is-invalid");
                return true;
            }
        });

        nextButton.disabled = !isValid;
    }

    // Manejar los eventos de los botones "Siguiente"
    nextButtons.forEach((button, index) => {
        button.addEventListener("click", function () {
            showStep(index + 1); // Mostrar el siguiente paso
        });
    });

    // Manejar los eventos de los botones "Atrás"
    backButtons.forEach((button, index) => {
        button.addEventListener("click", function () {
            showStep(index); // Mostrar el paso anterior
        });
    });

    // Manejar el envío del formulario
    submitButtons.forEach((button, index) => {
        button.addEventListener("click", function () {
            // Aquí puedes agregar la lógica para enviar el formulario
            alert("Formulario enviado!");
        });
    });

    // Validar los campos cuando se cambian
    formSteps.forEach((step, index) => {
        const inputs = step.querySelectorAll("input, select");
        inputs.forEach(input => {
            input.addEventListener("input", () => validateCurrentStep(index));
        });
    });
});

</script>





