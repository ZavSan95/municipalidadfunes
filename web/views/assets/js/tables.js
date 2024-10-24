/*=============================================
Tabla para administradores
=============================================*/

if($(".adminsTable").length > 0){

  var url = "/ajax/data-admins.ajax.php";

  var columns = [
     {"data":"id_admin"},
     {"data":"name_admin"},
     {"data":"email_admin"},
     {"data":"rol_admin"},
     {"data":"date_updated_admin"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Tabla para Áreas
=============================================*/

if($(".areasTable").length > 0){

  var url = "/ajax/data-areas.ajax.php";

  var columns = [
     {"data":"id_area"},
     {"data":"nombre_area"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Tabla para noticias
=============================================*/

if($(".newsTable").length > 0){

  var url = "/ajax/data-news.ajax.php";

  var columns = [
     {"data":"id_new"},
     {"data":"title_new"},
     {"data":"name_category"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Tabla para Slides
=============================================*/

if($(".slidesTable").length > 0){

  var url = "/ajax/data-slides.ajax.php";

  var columns = [
     {"data":"id_slide"},
     {"data":"title_slide"},
     {"data":"intro_slide"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Tabla para Reclamos
=============================================*/

if($(".reclamosTable").length > 0){

  var url = "/ajax/data-reclamos.ajax.php";

  var columns = [
     {"data":"id_reclamo"},
     {"data":"descripcion_rcategory"},
     {"data":"dni_reclamo"},
     {"data":"cuenta_reclamo"},
     {"data":"deuda_reclamo"},
     {"data":"nombre_zona"},
     {"data":"descripcion_estado"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Tabla para Tickets
=============================================*/

if($(".ticketsTable").length > 0){

  var url = "/ajax/data-tickets.ajax.php";

  var columns = [
     {"data":"id_ticket"},
     {"data":"descripcion_ticketcategory"},
     {"data":"nombre_area"},
     {"data":"name_admin"},
     {"data":"descripcion_estado"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Tabla para Tutores
=============================================*/

if($(".tutoresTable").length > 0){

  var url = "/ajax/data-tutores.ajax.php";

  var columns = [
     {"data":"id_tutor"},
     {"data":"dni_tutor"},
     {"data":"nombre_tutor"},
     {"data":"apellido_tutor"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Tabla para Mascotas
=============================================*/

if($(".mascotasTable").length > 0){

  var url = "/ajax/data-mascotas.ajax.php";

  var columns = [
     {"data":"id_mascota"},
     {"data":"nombre_mascota"},
     {"data":"dni_tutor"},
     {"data":"descripcion_especie"},
     {"data":"sexo_mascota"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
}

/*=============================================
Tabla para Mis Tickets
=============================================*/

if($(".misTicketsTable").length > 0){

  var url = "/ajax/data-misTickets.ajax.php";

  var columns = [
     {"data":"id_ticket"},
     {"data":"title_ticket"},
     {"data":"descripcion_ticketcategory"},
     {"data":"descripcion_estado"},
     {"data":"tecnico_ticket"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
}

/*=============================================
Tabla para Registros Inclusión Social
=============================================*/

if($(".inclusionTable").length > 0){

  var url = "/ajax/data-regristros.ajax.php";

  var columns = [
     {"data":"id_registro"},
     {"data":"date_created_registro"},
     {"data":"descripcion_restado"},
     {"data":"descripcion_prioridad"},
     {"data":"dni_registro"}, 
     {"data":"nombre_registro"},
     {"data":"descripcion_equipo"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Tabla para Turnos
=============================================*/

if($(".turnosTable").length > 0){

  var url = "/ajax/data-turnos.ajax.php";

  var columns = [
     {"data":"id_turno"},
     {"data":"fecha_turno"},
     {"data":"inicio_turno"},
     {"data":"descripcion_dependencia"},
     {"data":"descripcion_servicio"}, 
     {"data":"nombre_turno"},
     {"data":"dni_turno"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}





/*=============================================
Data Table 
=============================================*/
$(document).ready(function() {
  $("#tables").DataTable({
      "responsive": true,
      "order": [[0, "desc"]],
      "lengthChange": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": url,
          "type": "POST"
      },
      "columns": columns,
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
          }
      },
      "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], 
      
      // Configuración de `dom` para incluir el selector de cantidad de filas y botones
      "dom": '<"top"lfB>rt<"bottom"ip><"clear">', // 'l' para lengthMenu, 'f' para buscar, 'B' para botones, 'i' para info, 'p' para paginación
      
      // Configuración de botones
      "buttons": [
          {
              extend: 'excelHtml5',
              text: 'Exportar a Excel',
              title: 'Nombre del archivo',
              exportOptions: {
                  columns: ':not(:last-child)'
              }
          },
          {
              extend: 'pdfHtml5',
              text: 'Exportar a PDF',
              title: 'Nombre del archivo',
              exportOptions: {
                  columns: ':not(:last-child)'
              }
          }
      ]
  });
});


/*=============================================
Eliminar Item
=============================================*/

$(document).ready(function () {

  $(document).on('click', '.deleteItem', function(){

    var idItem = $(this).attr("idItem");
    var table = $(this).attr("table");
    var column = $(this).attr("column");
    var rol = $(this).attr("rol");

    new Promise(resolve => {

      Swal.fire({
        title: "¿Estás seguro?",
        text: "No podrás revertir este cambio",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No, cancelar",
        confirmButtonText: "Si, confirmar"
      }).then((result) => {
          
        resolve(result.value); 
            
      });

    }).then(response => {

      //console.log(response); 
      
      if (response) {
        
        if(rol=="admin"){

          var token = localStorage.getItem('token-admin');
          var emailAdmin = localStorage.getItem('email-admin');
          var url = "/ajax/delete-admins.ajax.php";
        }

        if(table == "admins"){
          var reDirec = "administradores";
        }else if(table == "news"){
          var reDirec = "prensa";
        }else if(table == "slides"){
          var reDirec = "slides"
        }else if(table == "reclamos"){
          var reDirec = "gestor_reclamos"
        }else if(table == "tickets"){
          var reDirec = "servicio_tecnico"
        }else if(table == "tutores"){
          var reDirec = "salud_animal/tutores"
        }else if(table == "mascotas"){
          var reDirec = "salud_animal/mascotas"
        }else if(table == "registros"){
          var reDirec = "inclusion_social"
        }else if(table == "turnos"){
          var reDirec = "turnos/listado"
        }

        var data = new FormData();
        data.append("token", token);
        data.append("table", table);
        data.append("id", idItem);
        data.append("nameId", "id_"+column);
        data.append("email-admin", emailAdmin);

        $.ajax({

          url: url,
          method: "POST",
          data: data,
          contentType: false,
          cache: false, 
          processData: false,
          success: function(response) {
            if (response == 200) {
                console.log(response);
                function showAlert() {
                    Swal.fire({
                        title: "Correcto",
                        icon: "success",
                        text: "Item eliminado con éxito",
                        confirmButtonColor: "#074A1F"
                    }).then((result) => {
                        // Redirige al usuario después de cerrar la alerta
                        if (result.isConfirmed) {
                            window.location.href = "/admin/" + reDirec;
                        }
                    });
                }
                showAlert();
                
                // Registrar la eliminación
                var emailUser = localStorage.getItem('email-admin');
                var logData = new FormData();
                logData.append("token", localStorage.getItem('token-admin'));
                logData.append("table", table);
                logData.append("id", idItem);
                logData.append("emailUser", emailUser);

                // Llama al endpoint de registro
                $.ajax({
                    url: "/ajax/logs/logDelete.ajax.php", // Asegúrate de que esta ruta sea correcta
                    method: "POST",
                    data: logData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(logResponse) {
                        console.log(logResponse); // Verifica la respuesta del servidor
                        const response = JSON.parse(logResponse); // Asegúrate de parsear la respuesta JSON
                        if (response.status === "success") {
                            console.log("Log registrado correctamente.");
                        } else {
                            console.error("Error al registrar el log:", response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la solicitud AJAX:", error);
                    }
                });
            } else if (response == "no-borrar") {
                console.log(response);
                function showAlert() {
                    Swal.fire({
                        title: "Error",
                        icon: "error",
                        text: "Este item no se puede borrar",
                        confirmButtonColor: "#EF1400"
                    });
                }
                showAlert();
            } else {
                console.log(response);
                function showAlert() {
                    Swal.fire({
                        title: "Error",
                        icon: "error",
                        text: "Este item no se puede borrar",
                        confirmButtonColor: "#EF1400"
                    });
                }
                showAlert();
            }
        }
        

        })

      } else {
        console.log("Eliminación cancelada");
      }
    });

  });

});

