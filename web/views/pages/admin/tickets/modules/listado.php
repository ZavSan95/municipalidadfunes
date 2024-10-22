<?php
// Obtener el id de la mascota desde la URL (GET)
if (isset($_SESSION['administrador']->id_admin)) {
    $idUsuario = $_SESSION['administrador']->id_admin;

    // Consulta a la API
    $url = "relations?rel=tickets,ticketcategories,estados&type=ticket,ticketcategory,estado&linkTo=id_admin_ticket&equalTo=" . $idUsuario;
    $method = "GET";
    $fields = array();

    // Realizar la solicitud Curl
    $response = CurlController::request($url, $method, $fields);

    if ($response->status == 200) {
        $tickets = $response->results;
    } else {
        $tickets = [];
    }
} else {
    // Si no se ha proporcionado una mascota en la URL, redirigir o mostrar un mensaje
    echo "No se ha proporcionado una mascota válida.";
    exit;
}
?>

<script>
$(document).ready(function() {
    $('#misTicketsTable').DataTable({
        "paging": true,  // Habilita la paginación
        "lengthChange": false, // Habilita la opción para cambiar el número de registros por página
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

    // Abrir modal y cargar datos
    $('#ticketModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var ticketId = button.data('id'); // Extraer el ID del ticket del atributo data-id

        // Aquí deberías hacer una solicitud para obtener los detalles del ticket usando el ID
        // Por ejemplo, usando AJAX o trayendo los datos ya en el HTML de alguna forma
        // Para este ejemplo, asumimos que ya tienes los detalles del ticket en el front-end

        // Extraer la fila del ticket y los datos que necesites
        var row = button.closest('tr');
        var title = row.find('td:eq(1)').text();
        var category = row.find('td:eq(2)').text();
        var status = row.find('td:eq(3)').text();
        var technician = row.find('td:eq(4)').text();
        var update = row.find('td:eq(5)').text();

        // Asignar los datos al modal
        var modal = $(this);
        modal.find('#modalTitle').text(title);
        modal.find('#modalCategory').text(category);
        modal.find('#modalStatus').text(status);
        modal.find('#modalTechnician').text(technician);
        modal.find('#modalUpdate').text(update);
    });

});
</script>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="/admin/tickets/gestion" class="btn btn-info py-2 px-3 btn-sm rounded-pill">Nuevo Ticket</a>
                </h3>
            </div>
            <div class="card-body">
                <table id="misTicketsTable" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
							<th>#</th>
							<th>Titulo</th>
							<th>Categoria</th>
							<th>Estado</th>
                            <th>Técnico</th>
                            <th>Última Actualización</th>
                            <th>Acciones</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tickets)): ?>
                            <?php foreach ($tickets as $key => $ticket): ?>

                                <?php
                                $actions = "
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-info border-0 rounded-pill mr-2 btn-sm' data-toggle='modal' data-target='#ticketModal' data-id='" . base64_encode($ticket->id_ticket) . "'>
                                        <i class='fa-regular fa-eye text-white mr-1'></i>
                                    </button>
                                </div>
                                ";
                                $actions = TemplateController::htmlClean($actions);
                                ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $ticket->title_ticket; ?></td>
                                    <td><?php echo $ticket->descripcion_ticketcategory; ?></td>
                                    <td><?php echo $ticket->descripcion_estado; ?></td>
                                    <td><?php echo $ticket->tecnico_ticket; ?></td>
                                    <td><?php echo $ticket->date_updated_ticket; ?></td>
                                    <td><?php echo $actions; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron tickets para esta usuario.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ticketModalLabel">Detalles del Ticket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí se mostrarán los detalles del ticket -->
        <p><strong>Título:</strong> <span id="modalTitle"></span></p>
        <p><strong>Categoría:</strong> <span id="modalCategory"></span></p>
        <p><strong>Estado:</strong> <span id="modalStatus"></span></p>
        <p><strong>Técnico:</strong> <span id="modalTechnician"></span></p>
        <p><strong>Última Actualización:</strong><span id="modalUpdate"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>





