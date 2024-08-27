<style>
#map-iframe {
    height: 400px;
    /* Ajusta la altura según tus necesidades */
    width: 100%;
    /* Asegura que el iframe ocupe todo el ancho */
    border: 0;
    /* Quita el borde del iframe */
}
</style>
<script>
// Cargador de arranque intercalado de Google Maps
(g => {
    var h, a, k, p = "The Google Maps JavaScript API",
        c = "google",
        l = "importLibrary",
        q = "__ib__",
        m = document,
        b = window;
    b = b[c] || (b[c] = {});
    var d = b.maps || (b.maps = {}),
        r = new Set,
        e = new URLSearchParams,
        u = () => h || (h = new Promise(async (f, n) => {
            await (a = m.createElement("script"));
            e.set("libraries", [...r] + "");
            for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
            e.set("callback", c + ".maps." + q);
            a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
            d[q] = f;
            a.onerror = () => h = n(Error(p + " could not load."));
            a.nonce = m.querySelector("script[nonce]")?.nonce || "";
            m.head.append(a)
        }));
    d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](
        f, ...n))
})({
    key: "AIzaSyAaRnCKVVSWGR159MyTF6rV7NMIPsW960c", // Reemplaza 'YOUR_API_KEY' con tu clave de API válida
    v: "weekly",
    libraries: ["places"]
});
</script>

<!-- Formulario -->
<div class="mb-16px">
    <input type="text" name="tgi" class="form-control required" placeholder="Número Cuenta TGI*">
</div>
<div class="mb-16px">
    <select name="zona" class="form-control required">
        <option value="0" disabled selected>Seleccione Zona*</option>
    </select>
    <span>Si no conoce su zona búsquela <b><a href="https://www.funes.gob.ar/ciudad/mapas"
                target="_blank">aquí.</a></b></span>
</div>
<div class="mb-16px">
    <input type="text" id="direccion" name="direccion" class="form-control required" placeholder="Dirección*">
</div>

<!-- Mapa de Google reemplazado por iframe -->
<div id="map-container">
    <iframe id="map-iframe" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAaRnCKVVSWGR159MyTF6rV7NMIPsW960c&q=Funes,Argentina">
    </iframe>
</div>

<!-- Campos ocultos para latitud, longitud y dirección transformada -->
<input type="hidden" name="latitud" id="latitud" name="latitud">
<input type="hidden" name="longitud" id="longitud" name="longitud">
<input type="hidden" name="direccion_transformada" id="direccion_transformada" name="direccion_transformada">

<!-- Script de inicialización -->
<script>
let direccionValue = ''; // Variable para guardar el valor del input de dirección
let lat = null; // Variable para guardar la latitud
let lng = null; // Variable para guardar la longitud
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
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            // console.log('Latitud: ' + lat + ', Longitud: ' + lng);
            // console.log('Direccion: ', direccionValue);

            // Asignar valores a los inputs ocultos
            document.getElementById('latitud').value = latValue;
            document.getElementById('longitud').value = lngValue;
            document.getElementById('direccion_transformada').value = direccionValue;

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

// Llamar a la función de inicialización
initialize();

</script>


<!-- PROCESO PHP PARA MANEJAR LA DIRECCION A APLICAR EN BACKEND -->

<!-- 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores enviados desde el formulario
    $direccion = $_POST['direccion_transformada'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];

    // Explode para transformar la dirección en un array
    $direccionArray = explode(",", $direccion);

    // Obtener la primera parte de la dirección (antes de la primera coma)
    $direccionReal = trim($direccionArray[0]);

    // Mostrar los valores obtenidos
    echo "Dirección real: " . $direccionReal . "<br>";
    echo "Latitud: " . $latitud . "<br>";
    echo "Longitud: " . $longitud;
}
    
 -->

