$(document).ready(function() {

    $("#tables").DataTable({
        "responsive":true,
        // "aLengthMenu":[[10, 25, 50, 100],[10, 25, 50, 100]],
        "order":[[0,"desc"]],
        "lengthChange": true, 
        "autoWidth": false,
        "processing":true,
        "serverSide": true,
        "ajax":{
            "url":$("#urlPath").val()+"ajax/data-admins.ajax.php",
            "type": "POST"
        },
        "columns":[
           {"data":"id_admin"},
           {"data":"name_admin"},
           {"data":"email_admin"},
           {"data":"rol_admin"},
           {"data":"date_updated_admin"},
           {"data":"actions", "orderable":false, "searchable":false}
        ],
        "language":{
        
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
              },
              "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
            }
        
        });
        

});