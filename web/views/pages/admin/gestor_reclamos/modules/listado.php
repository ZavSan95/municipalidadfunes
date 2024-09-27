<div class="content">
	
	<div class="container-fluid">
		
		<div class="card">
			
			<div class="card-header">
				
				<h3 class="card-title">
					<a href="/admin/gestor_reclamos/gestion" class="btn btn-info py-2 px-3 btn-sm rounded-pill">Agregar Reclamo</a>
				</h3>

			</div>

			<div class="card-body">
				
				<table id="tables" class="table table-bordered table-striped reclamosTable">
					
					<thead>
						<tr>
							<th>#</th>
                            <th>Categoría</th>
                            <th>DNI</th>
							<th>Cuenta TGI</th>
                            <th>Deuda</th>
                            <th>Zona</th>
                            <th>Estado</th>
							<th>Acciones</th>
						</tr>
						
					</thead>
					<tbody>

					</tbody>


				</table>


			</div>

		</div>

	</div>	


</div>


<!-- Modal Structure -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mapModalLabel">Reclamo Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Inicialización del mapa
    function initMap() {
        
            var lat = <?php echo !empty($reclamo) ? $reclamo->latitud_reclamo : '0'; ?>;
            var lng = <?php echo !empty($reclamo) ? $reclamo->longitud_reclamo : '0'; ?>;
            var location = { lat: parseFloat(lat), lng: parseFloat(lng) };

            // Creando el mapa
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });

            // Usar Marker para mostrar la ubicación
            const marker = new google.maps.Marker({
                position: location,
                map: map,
                title: "Ubicación del reclamo"
            });
    }

    
</script>

<!-- API de Google Maps cargada correctamente con async y defer -->
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaRnCKVVSWGR159MyTF6rV7NMIPsW960c&callback=initMap"></script>


<style>
    .map-container {
        position: relative; /* Posicionamiento relativo para el contenedor del mapa */
        width: 100%;
        height: 400px; /* Altura fija para el contenedor del mapa */
    }

    #map {
        width: 100%;
        height: 100%;
    }
</style>

<script>
function loadMap(latitude, longitude) {
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
        zoom: 15,
    });

    // Add a marker at the location
    new google.maps.Marker({
        position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
        map: map,
    });
}

// Load Google Maps API
function initMap() {
    // This function is required for Google Maps API to load correctly
}

// Ensure to load the Google Maps script with your API key
// <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
</script>

