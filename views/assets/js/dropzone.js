document.addEventListener('DOMContentLoaded', function() {
    // Desactivar la autodetección de Dropzone si es necesario
    Dropzone.autoDiscover = false;

    // Inicializar Dropzone en el contenedor con el ID 'myDropzone'
    var myDropzone = new Dropzone("#myDropzone", {
        url: "/file/post", // Cambia esta URL al endpoint donde quieres subir los archivos
        method: "post",
        maxFilesize: 2, // Tamaño máximo del archivo en MB
        acceptedFiles: "image/jpeg, image/png", // Tipos de archivos aceptados
        dictDefaultMessage: "Arrastra las imágenes de tu reclamo aquí", //Mensaje Default
        dictRemoveFile: "Eliminar archivo", //Mensaje eliminar archivo
        addRemoveLinks: true // Agregar enlaces de eliminación
    });


});

