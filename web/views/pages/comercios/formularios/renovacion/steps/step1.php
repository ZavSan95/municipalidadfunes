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
                echo '<option value="'.$value->id_rubro.'" ' .'>'.$value->descripcion_rubro.'</option>';
            }
        }
    ?>
    </select>
</div>

<div style="margin-bottom:16px;">
    <label for="cuenta_drei">Numero Cuenta DREI*</label>
    <input id="cuenta_drei" type="number" name="cuenta_drei" class="form-control required" placeholder="Numero Cuenta DREI*"
        required>
</div>

<div style="margin-bottom:16px;">
    <label for="fecha_inicio">Fecha Inicio de la Actividad</label>
    <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control required"
        placeholder="Fecha Inicio de la Actividad" required>
</div>

<div style="margin-bottom:16px;">
    <label for="nombre_fantasia">Nombre de Fantasía*</label>
    <input id="nombre_fantasia" type="text" name="nombre_fantasia" class="form-control required"
        placeholder="Nombre de Fantasía*" required>
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
    <input id="direccion" type="all" name="direccion" class="form-control required" placeholder="Ingrese dirección" required>
</div>

<div style="margin-bottom:16px;">
    <label for="piso">Piso</label>
    <input id="piso" type="all" name="piso" class="form-control" placeholder="Piso" >
</div>

<div style="margin-bottom:16px;">
    <label for="departamento">Departamento/Oficina/Local</label>
    <input id="departamento" type="all" name="departamento" class="form-control" placeholder="Número Departamento/Oficina/Local" >
</div