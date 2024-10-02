
/*=============================================
Edición Galería DropZone
=============================================*/
function removeGallery(elem) {
    // Remover el elemento visualmente
    $(elem).parent().remove();

    // Convertir el valor de la galería vieja en un array
    var arrayFilesEdit = JSON.parse($(".galleryOldReclamo").val());

    // Mostrar el array antes de eliminar el archivo
    console.log("Array antes de eliminar: ", arrayFilesEdit);

    // Obtener el archivo que se desea eliminar
    var fileToRemove = $(elem).attr("remove");

    // Buscar el índice correcto del archivo en el array
    var index = arrayFilesEdit.indexOf(fileToRemove);

    if (index !== -1) {
        // Si el archivo existe en el array, lo eliminamos
        arrayFilesEdit.splice(index, 1);

        // Actualizar el valor del campo hidden con el nuevo array
        $(".galleryOldReclamo").val(JSON.stringify(arrayFilesEdit));

        // Si también tienes que agregar el archivo eliminado a la lista de eliminados
        var deleteArray = JSON.parse($(".deleteGalleryProduct").val());
        deleteArray.push(fileToRemove);
        $(".deleteGalleryProduct").val(JSON.stringify(deleteArray));


    } else {
        console.log("El archivo no se encontró en el array.");
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Desactivar la autodetección de Dropzone si es necesario
    Dropzone.autoDiscover = false;

    // Inicializar Dropzone en el contenedor con el ID 'myDropzone'
    // var myDropzone = new Dropzone("#myDropzoneReclamo", {
    //     url: "/file/post", // Cambia esta URL al endpoint donde quieres subir los archivos
    //     method: "post",
    //     maxFilesize: 2, // Tamaño máximo del archivo en MB
    //     acceptedFiles: "image/jpeg, image/png", // Tipos de archivos aceptados
    //     dictDefaultMessage: "Arrastra las imágenes de tu reclamo aquí", //Mensaje Default
    //     dictRemoveFile: "Eliminar archivo", //Mensaje eliminar archivo
    //     addRemoveLinks: true // Agregar enlaces de eliminación
    // });

    $(".dropzone").dropzone({
        url: "/",
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg, image/png",
        maxFilesize: 10,
        maxFiles: 10,
        dictDefaultMessage: "Arrastra las imágenes de tu reclamo aquí",
        dictRemoveFile: "Eliminar archivo",
        init: function() {

            var elem = $(this.element);
            var arrayFiles = [];
            var countArrayFiles = 0;

            this.on("addedfile", function(file) {

                countArrayFiles++;

                setTimeout(function() {

                    arrayFiles.push({

                        "file": file.dataURL,
                        "type": file.type,
                        "width": file.width,
                        "height": file.height

                    })

                    elem.parent().children(".galleryReclamo").val(JSON.stringify(
                        arrayFiles));


                }, 500 * countArrayFiles)

            })

            this.on("removedfile", function(file) {

                countArrayFiles++;
                setTimeout(function() {

                    var index = arrayFiles.indexOf({

                        "file": file.dataURL,
                        "type": file.type,
                        "width": file.width,
                        "height": file.height

                    })

                    arrayFiles.splice(index, 1);

                    elem.parent().children(".galleryReclamo").val(JSON.stringify(
                        arrayFiles));

                }, 500 * countArrayFiles)

            })

            myDropzone = this;

            $(".saveBtn").click(function() {

                if (arrayFiles.length >= 1) {

                    myDropzone.processQueue();

                } else {

                    //Alerta errror galeria vacia
                    return;
                }
            })
        }

    });


});
