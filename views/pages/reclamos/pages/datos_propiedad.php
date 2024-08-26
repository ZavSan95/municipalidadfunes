<!-- Carga asíncrona de la API de Google Maps -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&libraries=places&callback=initialize">
</script>
<script>
function initialize() {
    var input = document.getElementById('direccion');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (place.geometry) {
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            console.log('Latitud: ' + lat + ', Longitud: ' + lng);
            // Puedes enviar las coordenadas al servidor o usarlas para mostrar un mapa, etc.
        } else {
            console.log('No se encontró ninguna ubicación.');
        }
    });
}
</script>




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
    <!-- Asegúrate de añadir el ID aquí para el campo de autocompletado -->
    <input type="text" id="direccion" name="direccion" class="form-control required" placeholder="Dirección*">
</div>