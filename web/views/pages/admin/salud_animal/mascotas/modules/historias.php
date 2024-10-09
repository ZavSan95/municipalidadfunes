<?php
// Obtener el id de la mascota desde la URL (GET)
if (isset($_GET['mascota'])) {
    $idMascota = base64_decode($_GET['mascota']);

    // Consulta a la API
    $url = "relations?rel=historias,veterinarios,tipoconsultas&type=historia,veterinario,tipoconsulta&linkTo=id_mascota_historia&equalTo=" . $idMascota;
    $method = "GET";
    $fields = array();

    // Realizar la solicitud Curl
    $response = CurlController::request($url, $method, $fields);

    if ($response->status == 200) {
        $historias = $response->results;
    } else {
        $historias = [];
    }
} else {
    // Si no se ha proporcionado una mascota en la URL, redirigir o mostrar un mensaje
    echo "No se ha proporcionado una mascota válida.";
    exit;
}
?>

<script>
$(document).ready(function() {
    $('#historiasTable').DataTable({
        "paging": true,  // Habilita la paginación
        "lengthChange": true, // Habilita la opción para cambiar el número de registros por página
        "searching": true, // Habilita el campo de búsqueda
        "ordering": true, // Habilita la ordenación de columnas
        "info": true, // Muestra información sobre los resultados
        "autoWidth": false, // Ajusta automáticamente el ancho de las columnas
        "language": {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
          },
      },
    });
});
</script>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="/admin/salud_animal/mascotas/gestion_historia?mascota=<?php echo base64_encode($idMascota) ?>" class="btn btn-info py-2 px-3 btn-sm rounded-pill">Agregar Historia</a>
                </h3>
            </div>
            <div class="card-body">
                <table id="historiasTable" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha - Hora</th>
                            <th>Motivo Consulta</th>
                            <th>Peso</th>
                            <th>Veterinario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($historias)): ?>
                            <?php foreach ($historias as $key => $historia): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $historia->fecha_hora_historia; ?></td>
                                    <td><?php echo $historia->descripcion_tipoconsulta; ?></td>
                                    <td><?php echo $historia->peso_historia; ?></td>
                                    <td><?php echo $historia->nombre_veterinario; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron historias para esta mascota.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

