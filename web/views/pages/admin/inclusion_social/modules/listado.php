<div class="content">
	
	<div class="container-fluid">
		
		<div class="card">
			
			<div class="card-header">
				
				<h3 class="card-title">
					<a href="/admin/inclusion_social/gestion" class="btn btn-info py-2 px-3 btn-sm rounded-pill">Agregar Registro</a>
				</h3>

			</div>

			<div class="card-body">
				
				<table id="tables" class="table table-bordered table-striped inclusionTable">
					
					<thead>
						<tr>
							<th>#</th>
							<th>Fecha</th>
							<th>Estado</th>
							<th>Prioridad</th>
							<th>DNI</th>
							<th>Nombre</th>
							<th>Equipo</th>
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

<script>


function generatePDF(idRegistro) {
    console.log("Generando PDF para el ID de registro: ", idRegistro); // Añadir esta línea
    window.location.href = 'inclusion_social/modules/generar_pdf.php?registro=' + idRegistro;
}


</script>
