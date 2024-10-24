<form action="" method="post" id="form-renov-fisica">
    <div class="card">

        <div class="card-header">
            <h4>DATOS DEL LOCAL</h4>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="rubro">Rubro*</label>
                    <select name="id_rubro" class="form-control required">
                        <option value="">Seleccione Rubro</option>
                        <?php 
                            $url = "rubros?select=id_rubro,descripcion_rubro&orderBy=descripcion_rubro&orderMode=ASC";
                            $method = "GET";
                            $fields = array();
                            $rubros = CurlController::request($url, $method, $fields);
                            if ($rubros->status == 200) {
                                $rubros = $rubros->results;
                                foreach ($rubros as $value) {
                                    echo '<option value="'.$value->id_rubro.'">'.$value->descripcion_rubro.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="cuenta_drei">Número Cuenta DREI*</label>
                    <input id="cuenta_drei" type="number" name="cuenta_drei" class="form-control required"
                        placeholder="Número Cuenta DREI*" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha_inicio">Fecha Inicio de la Actividad</label>
                    <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control required"
                        placeholder="Fecha Inicio de la Actividad" required>
                </div>

                <div class="col-md-6">
                    <label for="nombre_fantasia">Nombre de Fantasía*</label>
                    <input id="nombre_fantasia" type="text" name="nombre_fantasia" class="form-control required"
                        placeholder="Nombre de Fantasía*" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tipo_contribuyente">Tipo de Contribuyente*</label>
                    <select id="tipo_contribuyente" name="tipo_contribuyente" class="form-control required">
                        <option value="0" disabled selected>Elija una opción*</option>
                        <option value="1">Persona Física</option>
                        <option value="2">Persona Jurídica</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="direccion">Dirección</label>
                    <input id="direccion" type="text" name="direccion" class="form-control required"
                        placeholder="Ingrese dirección" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="piso">Piso</label>
                    <input id="piso" type="text" name="piso" class="form-control" placeholder="Piso">
                </div>

                <div class="col-md-6">
                    <label for="departamento">Departamento/Oficina/Local</label>
                    <input id="departamento" type="text" name="departamento" class="form-control"
                        placeholder="Número Departamento/Oficina/Local">
                </div>
            </div>
        </div>

        <div class="card-header">
            <h4>DATOS DEL TITULAR</h4>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombre">Nombre*</label>
                    <input id="nombre" type="text" name="nombre" class="form-control required"
                        placeholder="Ingrese Nombre del Titular" required>
                </div>

                <div class="col-md-6">
                    <label for="apellido">Apellido*</label>
                    <input id="apellido" type="text" name="apellido" class="form-control required"
                        placeholder="Ingrese Apellido del Titular" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha_nacimiento">Fecha de Nacimiento*</label>
                    <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" class="form-control required"
                        placeholder="Ingrese día/mes/año" required>
                </div>

                <div class="col-md-6">
                    <label for="cuit">CUIT*</label>
                    <input id="cuit" type="text" name="cuit" class="form-control required" placeholder="Ingrese CUIT"
                        required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="condicion_iva">Condición de IVA*</label>
                    <select id="condicion_iva" name="condicion_iva" class="form-control required">
                        <option value="" disabled selected>Elija una opción</option>
                        <option value="1">Responsable Inscripto</option>
                        <option value="2">Monotributista</option>
                        <option value="3">Exento</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipo_documento">Tipo de Documento*</label>
                    <select id="tipo_documento" name="tipo_documento" class="form-control required">
                        <option value="" disabled selected>Elija una opción</option>
                        <option value="1">DNI</option>
                        <option value="2">Pasaporte</option>
                        <option value="3">Cédula</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="numero_documento">Número de Documento del Titular*</label>
                    <input id="numero_documento" type="text" name="numero_documento" class="form-control required"
                        placeholder="Ingrese Número de Documento del Titular" required>
                </div>

                <div class="col-md-6">
                    <label for="telefono_contacto">Teléfono de Contacto*</label>
                    <input id="telefono_contacto" type="tel" name="telefono_contacto" class="form-control required"
                        placeholder="Ingrese Teléfono de Contacto" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="email">E-mail*</label>
                    <input id="email" type="email" name="email" class="form-control required" placeholder="Ingrese E-mail"
                        required>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button id="back-fisica" type="button" class="btn btn-secondary">Regresar</button>
            <button type="submit" class="btn btn-base-color">Enviar</button>
        </div>
    </div>
</form>
