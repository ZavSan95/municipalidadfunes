/*=============================================
Recordar Email
=============================================*/

$(document).ready(function() {

    // Función para recordar el correo electrónico en localStorage
    function rememberEmail(event){

        if(event.target.checked){

            localStorage.setItem("emailAdmin", $('[name="loginAdminEmail"]').val());
            localStorage.setItem("checkRem", true);

        } else {

            localStorage.removeItem("emailAdmin");
            localStorage.removeItem("checkRem");
        }

    }

    // Función para obtener el correo almacenado y marcar el checkbox
    function getEmail(){

        if(localStorage.getItem('emailAdmin') != null){

            $('[name="loginAdminEmail"]').val(localStorage.getItem('emailAdmin'));

        }

        if(localStorage.getItem('checkRem') != null && localStorage.getItem('checkRem') === "true"){

            $('#remember').prop('checked', true); // Usar .prop en lugar de .attr para checkboxes
        }

    }

    // Ejecutar la función para recuperar los valores del localStorage
    getEmail();

    // Asignar el evento al checkbox
    $('#remember').on('change', rememberEmail);

});


/*=============================================
SummerNote
=============================================*/
if ($('.summernote').length > 0) {
    $('.summernote').summernote({
        minHeight: 500,
        prettifyHtml: false,
        followingToolbar: true,
        codemirror: {
            mode: "application/xml",
            styleActiveLine: true,
            lineNumbers: true,
            lineWrapping: true
        },
        toolbar: [
            ['misc', ['codeview', 'undo', 'redo']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['style', 'ul', 'ol', 'paragraph', 'height']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['insert', ['link', 'picture', 'hr', 'video', 'table', 'emoji']],
        ]
    });
  }

/*=============================================
Validar Datos Repetidos
=============================================*/
// function validateDataRepeat(event, type){

//     if(type=="category"){

//         var table = "categories";
//         var linkTo = "name_category";
//     }

//     var value = event.target.value;


// }

/*=============================================
Validamos imagen
=============================================*/

function validateImageJS(event, tagImg){

    var image = event.target.files[0];
    if(image == undefined){

        return;
    }
  
    /*=============================================
    Validamos el formato
    =============================================*/
  
    if(image["type"] !== "image/jpeg" && image["type"] !== "image/png" && image["type"] !== "image/gif"){

        return;
    }
  
    /*=============================================
    Validamos el tamaño
    =============================================*/
  
    else if(image["size"] > 2000000){

        return;
    }
  
    /*=============================================
    Mostramos la imagen temporal
    =============================================*/
  
    else{
  
      var data = new FileReader();
      data.readAsDataURL(image);
  
      $(data).on("load", function(event){
        
        var path = event.target.result; 
    
        $("."+tagImg).attr("src", path);
        $(".metaImg").attr("src", path);    
  
      })
  
    }
  
  }

