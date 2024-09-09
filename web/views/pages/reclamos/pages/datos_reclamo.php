<div class="mb-16px">
    <select name="categoria_reclamo" class="form-control required">
        <option value="0" disabled selected>Seleccione Categoría*</option>
        <option value="1">Categoria 1</option>
    </select>
</div>

<!-- Contenedor Dropzone dentro del formulario principal -->
<div class="dropzone mb-16px" id="myDropzone">
    <!-- Fallback input aquí para cuando Dropzone no esté disponible -->
    <div class="fallback">
        <input name="img_reclamo" type="file" multiple />
    </div>
</div>

<div class="mb-16px">
    <textarea name="detalle_reclamo" class="form-control required" placeholder="Ingrese el detalle de su reclamo aquí."></textarea>
</div>

<script src="<?php echo $path ?>/views/assets/js/dropzone.js"></script>
