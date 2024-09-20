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
Tabla para noticias
=============================================*/

if($(".newsTable").length > 0){

  var url = "/ajax/data-news.ajax.php";

  var columns = [
     {"data":"id_new"},
     {"data":"title_new"},
     {"data":"category_new"},
     {"data":"actions", "orderable":false, "searchable":false}
  ]

  var order = [0,"desc"];
  

}

/*=============================================
Data Table Admins
=============================================*/
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
            "url": url,
            "type": "POST"
        },
        "columns":columns,
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
          success: function(response){

            if(response == 200){
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
                        window.location.href = "/admin/administradores";
                    }
                });
            }
            showAlert();
            }
            else if(response == "no-borrar"){
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
            else{
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

