<?php

if (isset($_GET['reclamo'])) {
$select = "id_reclamo,codigo_reclamo,nombre_reclamo,apellido_reclamo,dni_reclamo,celular_reclamo,correo_reclamo,cuenta_reclamo,deuda_reclamo,zona_reclamo,estado_reclamo,".
"estado_reclamo,direccion_reclamo,categoria_reclamo,img_reclamo,detalle_reclamo,date_created_reclamo";
$url = "reclamos?linkTo=id_reclamo&equalTo=" . base64_decode($_GET['reclamo']);
$method = "GET";
$fields = array();

$reclamo = CurlController::request($url, $method, $fields);

if ($reclamo->status == 200) {
$reclamo = $reclamo->results[0];
} else {
$reclamo = null;
}
} else {
$reclamo = null;
}

?>

<div class="content">
    <div class="container">
        <form method="POST">

        <input type="hidden" name="idReclamo" value="<?php echo !empty($reclamo) ? $reclamo->id_reclamo : ''; ?>">
        <input type="hidden" name="codigoReclamo" value="<?php echo !empty($reclamo) ? $reclamo->codigo_reclamo : ''; ?>">
        <?php 
        
        require_once 'controllers/controller.reclamo.php';
        $manage = new ReclamoController();
        $manage->reclamoManage();

        ?>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPersonalData">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePersonalData" aria-expanded="true"
                            aria-controls="collapsePersonalData">
                            Datos Reclamo
                        </button>
                    </h2>

                    <div id="collapsePersonalData" class="accordion-collapse collapse show"
                        aria-labelledby="headingPersonalData" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="id_estado_reclamo">Estado <sup
                                            class="text-danger font-weight-bold">*</sup></label>
                                    <select name="id_estado_reclamo" class="form-control required">
                                        <option value=""
                                            <?php if (!empty($reclamo) && $reclamo->id_estado_reclamo == ""): ?>
                                            selected <?php endif ?>>Seleccione Estado</option>
                                        <?php 
$url = "estados?select=id_estado,descripcion_estado";
$method = "GET";
$fields = array();
$category = CurlController::request($url,$method,$fields);
if($category->status == 200){
$category = $category->results;
foreach ($category as $value) {
echo '<option value="'.$value->id_estado.'" ' . 
(($reclamo && $reclamo->id_estado_reclamo == $value->id_estado) ? 'selected' : '') . 
'>'.$value->descripcion_estado.'</option>';
}
}
?>
                                    </select>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="id_rcategory_reclamo">Categoría <sup
                                            class="text-danger font-weight-bold">*</sup></label>
                                    <select name="id_rcategory_reclamo" class="form-control required">
                                        <option value=""
                                            <?php if (!empty($reclamo) && $reclamo->id_rcategory_reclamo == ""): ?>
                                            selected <?php endif ?>>Seleccione Categoría</option>
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

                                <div class="col-md-12 mt-3">
                                    <label for="img_reclamo">Imágenes <sup
                                            class="text-danger font-weight-bold">*</sup></label>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="form-group pb-3 text-center">

                                                <div class="dropzone mb-16px" id="myDropzoneReclamo">
                                                    <?php if(!empty($reclamo->img_reclamo)): ?>
                                                        <?php foreach (json_decode($reclamo->img_reclamo,true)  as $index => $item): ?>
                                                            <div class="dz-preview dz-file-preview">
                                                                <div class="dz-image">
                                                                    <img class="img-fluid" src="<?php echo "/views/assets/images/reclamos/".$item ?>">
                                                                </div>
                                                                <a class="dz-remove" data-dz-remove remove="<?php echo $item ?>" onclick="removeGallery(this)">Eliminar Archivo</a>
                                                            </div>  
                                                        <?php endforeach ?>
                                                    <?php endif; ?>
                                                </div>

                                                    <input type="hidden" name="img_reclamo" class="galleryReclamo">

                                                    <input type="hidden" name="galleryOldReclamo" class="galleryOldReclamo" value='<?php echo $reclamo->img_reclamo ?>'>

                                                    <input type="hidden" name="deleteGalleryReclamo" class="deleteGalleryProduct" value='[]'>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPropertyData">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePropertyData" aria-expanded="false"
                            aria-controls="collapsePropertyData">
                            Datos Inmueble
                        </button>
                    </h2>
                    <div id="collapsePropertyData" class="accordion-collapse collapse"
                        aria-labelledby="headingPropertyData" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="cuenta_reclamo">Cuenta</label>
                                        <input type="text" class="form-control" id="cuenta_reclamo"
                                            name="cuenta_reclamo" placeholder="Ingresar la cuenta"
                                            value="<?php echo !empty($reclamo) ? $reclamo->cuenta_reclamo : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="deuda_reclamo">Deuda</label>
                                        <input type="text" class="form-control" id="deuda_reclamo" name="deuda_reclamo"
                                            placeholder="Ingresar la deuda"
                                            value="<?php echo !empty($reclamo) ? $reclamo->deuda_reclamo : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="id_zona_reclamo">Zona <sup
                                            class="text-danger font-weight-bold">*</sup></label>
                                    <select name="id_zona_reclamo" class="form-control required">
                                        <option value=""
                                            <?php if (!empty($reclamo) && $reclamo->id_zona_reclamo == ""): ?> selected
                                            <?php endif ?>>Seleccione Categoría</option>
                                        <?php 
$url = "zonas?select=id_zona,nombre_zona";
$method = "GET";
$fields = array();
$category = CurlController::request($url,$method,$fields);
if($category->status == 200){
$category = $category->results;
foreach ($category as $value) {
echo '<option value="'.$value->id_zona.'" ' . 
(($reclamo && $reclamo->id_zona_reclamo == $value->id_zona) ? 'selected' : '') . 
'>'.$value->nombre_zona.'</option>';
}
}
?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="direccion">Dirección</label>
                                        <input type="all" id="direccion" class="form-control required"
                                            name="direccion_reclamo"
                                            value="<?php echo !empty($reclamo) ? $reclamo->direccion_reclamo : ''; ?>"
                                            required placeholder="Dirección*">
                                    </div>
                                </div>
                                <div id="map-container" class="col-md-12">
                                    <iframe id="map-iframe" width="100%" height="400px" frameborder="0" style="border:0"
                                        allowfullscreen
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAaRnCKVVSWGR159MyTF6rV7NMIPsW960c&q=Funes,Argentina"></iframe>
                                        <input type="hidden" name="latitud_reclamo" id="latitud_reclamo" value="<?php echo !empty($reclamo) ? $reclamo->latitud_reclamo : ''; ?>">
                                        <input type="hidden" name="longitud_reclamo" id="longitud_reclamo" value="<?php echo !empty($reclamo) ? $reclamo->longitud_reclamo : ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingClaimData">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseClaimData" aria-expanded="false" aria-controls="collapseClaimData">
                            Datos Personales
                        </button>
                    </h2>
                    <div id="collapseClaimData" class="accordion-collapse collapse" aria-labelledby="headingClaimData"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="nombre_reclamo">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_reclamo"
                                            name="nombre_reclamo" placeholder="Ingresar el nombre"
                                            value="<?php echo !empty($reclamo) ? $reclamo->nombre_reclamo : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="apellido_reclamo">Apellido</label>
                                        <input type="text" class="form-control" id="apellido_reclamo"
                                            name="apellido_reclamo" placeholder="Ingresar el apellido"
                                            value="<?php echo !empty($reclamo) ? $reclamo->apellido_reclamo : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="dni_reclamo">DNI</label>
                                        <input type="text" class="form-control" id="dni_reclamo" name="dni_reclamo"
                                            placeholder="Ingresar el DNI"
                                            value="<?php echo !empty($reclamo) ? $reclamo->dni_reclamo : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="celular_reclamo">Celular</label>
                                        <input type="text" class="form-control" id="celular_reclamo"
                                            name="celular_reclamo" placeholder="Ingresar el celular"
                                            value="<?php echo !empty($reclamo) ? $reclamo->celular_reclamo : ''; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pb-3">
                                        <label for="correo_reclamo">Correo</label>
                                        <input type="email" class="form-control" id="correo_reclamo"
                                            name="correo_reclamo" placeholder="Ingresar el correo"
                                            value="<?php echo !empty($reclamo) ? $reclamo->correo_reclamo : ''; ?>"
                                            required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <label class="font-weight-light"><sup class="text-danger">*</sup> Campos
                                    obligatorios</label>
                                <button type="submit"
                                    class="btn border-0 btn-info py-2 px-3 btn-sm rounded-pill saveBtn">Guardar
                                    Información</button>
                                <a href="/admin/gestor_reclamos"
                                    class="btn btn-default py-2 px-3 btn-sm rounded-pill ml-2">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>

        </form>
    </div>
</div>
</div>

<script>

/*=============================================
Edición Galería DropZone
=============================================*/
function removeGallery(elem) {
    // Remover el elemento visualmente
    $(elem).parent().remove();

    // Convertir el valor de la galería vieja en un array
    var arrayFilesEdit = JSON.parse($(".galleryOldReclamo").val());

    // Mostrar el array antes de eliminar el archivo
    console.log("Array antes de eliminar: ", arrayFilesEdit);

    // Obtener el archivo que se desea eliminar
    var fileToRemove = $(elem).attr("remove");

    // Buscar el índice correcto del archivo en el array
    var index = arrayFilesEdit.indexOf(fileToRemove);

    if (index !== -1) {
        // Si el archivo existe en el array, lo eliminamos
        arrayFilesEdit.splice(index, 1);

        // Actualizar el valor del campo hidden con el nuevo array
        $(".galleryOldReclamo").val(JSON.stringify(arrayFilesEdit));

        // Si también tienes que agregar el archivo eliminado a la lista de eliminados
        var deleteArray = JSON.parse($(".deleteGalleryProduct").val());
        deleteArray.push(fileToRemove);
        $(".deleteGalleryProduct").val(JSON.stringify(deleteArray));

 
    } else {
        console.log("El archivo no se encontró en el array.");
    }
}


</script>
<!-- DropZone -->
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Desactivar la autodetección de Dropzone si es necesario
    Dropzone.autoDiscover = false;

    // Inicializar Dropzone en el contenedor con el ID 'myDropzone'
    // var myDropzone = new Dropzone("#myDropzoneReclamo", {
    //     url: "/file/post", // Cambia esta URL al endpoint donde quieres subir los archivos
    //     method: "post",
    //     maxFilesize: 2, // Tamaño máximo del archivo en MB
    //     acceptedFiles: "image/jpeg, image/png", // Tipos de archivos aceptados
    //     dictDefaultMessage: "Arrastra las imágenes de tu reclamo aquí", //Mensaje Default
    //     dictRemoveFile: "Eliminar archivo", //Mensaje eliminar archivo
    //     addRemoveLinks: true // Agregar enlaces de eliminación
    // });

    $(".dropzone").dropzone({
        url: "/",
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg, image/png",
        maxFilesize: 10,
        maxFiles: 10,
        dictDefaultMessage: "Arrastra las imágenes de tu reclamo aquí",
        dictRemoveFile: "Eliminar archivo",
        init: function() {

            var elem = $(this.element);
            var arrayFiles = [];
            var countArrayFiles = 0;

            this.on("addedfile", function(file) {

                countArrayFiles++;

                setTimeout(function() {

                    arrayFiles.push({

                        "file": file.dataURL,
                        "type": file.type,
                        "width": file.width,
                        "height": file.height

                    })

                    elem.parent().children(".galleryReclamo").val(JSON.stringify(
                        arrayFiles));


                }, 500 * countArrayFiles)

            })

            this.on("removedfile", function(file) {

                countArrayFiles++;
                setTimeout(function() {

                    var index = arrayFiles.indexOf({

                        "file": file.dataURL,
                        "type": file.type,
                        "width": file.width,
                        "height": file.height

                    })

                    arrayFiles.splice(index, 1);

                    elem.parent().children(".galleryReclamo").val(JSON.stringify(
                        arrayFiles));

                }, 500 * countArrayFiles)

            })

            myDropzone = this;

            $(".saveBtn").click(function() {

                if (arrayFiles.length >= 1) {

                    myDropzone.processQueue();

                } else {

                    //Alerta errror galeria vacia
                    return;
                }
            })
        }

    });


});
</script>

<script>
let direccionValue = ''; // Variable para guardar el valor del input de dirección
let lat = null; // Variable para guardar la latitud
let lng = null;

async function initialize() {
    const {
        Autocomplete
    } = await google.maps.importLibrary("places");

    // Inicializar el autocompletado de direcciones
    var input = document.getElementById('direccion');
    var autocomplete = new Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (place.geometry) {
            direccionValue = input.value;
            lat = place.geometry.location.lat();
            lng = place.geometry.location.lng();
            console.log('Latitud: ' + lat + ', Longitud: ' + lng);
            console.log('Direccion: ', direccionValue);

            // Asignar valores a los inputs ocultos
            document.getElementById('latitud_reclamo').value = lat;
            document.getElementById('longitud_reclamo').value = lng;

            // Actualizar el iframe con las nuevas coordenadas
            updateMapIframe(lat, lng);
        } else {
            console.log('No se encontró ninguna ubicación.');
        }
    });
}

function updateMapIframe(lat, lng) {
    // Actualizar el src del iframe con las coordenadas obtenidas
    const mapIframe = document.getElementById('map-iframe');
    mapIframe.src =
        `https://www.google.com/maps/embed/v1/view?key=AIzaSyAaRnCKVVSWGR159MyTF6rV7NMIPsW960c&center=${lat},${lng}&zoom=14`;
}

// Cargar la API de Google Maps
function loadGoogleMapsApi() {
    const script = document.createElement("script");
    script.src =
        "https://maps.googleapis.com/maps/api/js?key=AIzaSyAaRnCKVVSWGR159MyTF6rV7NMIPsW960c&libraries=places&callback=initialize";
    script.async = true;
    document.head.appendChild(script);
}

// Ejecutar la carga del API al cargar la página
window.onload = loadGoogleMapsApi;
</script>

<style>
/* Estilo para el encabezado del acordeón seleccionado */
.accordion-button:not(.collapsed) {
    background-color: #074A1F;
    /* Cambia a tu color deseado */
    color: white;
    /* Cambia el color del texto */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    /* Sombra del texto */
}

/* Estilo para el encabezado del acordeón cuando está colapsado */
.accordion-button {
    font-weight: 700;
    background-color: #2E6B4E;
    /* Color de fondo predeterminado */
    color: white;
    /* Color de texto predeterminado */
    transition: background-color 0.3s ease, color 0.3s ease;
    /* Añade una transición suave */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    /* Sombra del texto */
}

/* Estilo para el encabezado del acordeón al pasar el ratón */
.accordion-button:hover {
    background-color: #074A1F;
    /* Cambia a tu color deseado al pasar el ratón */
    color: white;
    /* Cambia el color del texto al pasar el ratón */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    /* Sombra del texto */
}
</style>