<div class="mb-16px">
    <select name="id_rcategory_reclamo" class="form-control required">
        <option value="" <?php if (!empty($reclamo) && $reclamo->id_rcategory_reclamo == ""): ?> selected
            <?php endif ?>>Seleccione Categoría</option>
        <?php 
        $url = "rcategories?select=id_rcategory,descripcion_rcategory";
        $method = "GET";
        $fields = array();
        $category = CurlController::request($url,$method,$fields);
        if($category->status == 200){
            $category = $category->results;
            foreach ($category as $value) {
                echo '<option value="'.$value->id_rcategory.'" ' . 
                (($reclamo && $reclamo->id_rcategory_reclamo == $value->id_rcategory) ? 'selected' : '') . 
                '>'.$value->descripcion_rcategory.'</option>';
            }
        }
    ?>
    </select>
</div>

<!-- Contenedor Dropzone dentro del formulario principal -->
<div class="dropzone mb-16px" id="myDropzoneReclamo">
    <div class="dz-preview dz-file-preview">

    </div>
</div>

<input type="hidden" name="img_reclamo" class="galleryReclamo">

<div class="mb-16px">
    <textarea name="detalle_reclamo" class="form-control required"
        placeholder="Ingrese el detalle de su reclamo aquí."></textarea>
</div>

