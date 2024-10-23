<h3>PASO 2 - DATOS DE LA PERSONA JURÍDICA</h3>
    <p>Campos obligatorios *</p>

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
