<div class="mb-16px">
    <select name="categoria" class="form-control required">
        <option value="0" disabled selected>Seleccione Categoría*</option>
    </select>
</div>

<!-- Contenedor Dropzone dentro del formulario principal -->
<div class="dropzone" id="myDropzone">
    <!-- Fallback input aquí para cuando Dropzone no esté disponible -->
    <div class="fallback">
        <input name="file" type="file" multiple />
    </div>
</div>

<div class="mb-16px">
    <textarea name="detalle" class="form-control required" placeholder="Ingrese el detalle de su reclamo aquí."></textarea>
</div>

<script src="<?php echo $path ?>/views/assets/js/dropzone.js"></script>
