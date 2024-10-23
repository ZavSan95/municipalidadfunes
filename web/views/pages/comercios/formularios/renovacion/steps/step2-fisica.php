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
