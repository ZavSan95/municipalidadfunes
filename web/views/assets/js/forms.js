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


