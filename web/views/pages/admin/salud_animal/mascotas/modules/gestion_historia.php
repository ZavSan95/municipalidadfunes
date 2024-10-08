<?php
// Obtener el id de la mascota desde la URL (GET)
if (isset($_GET['mascota'])) {
    $idMascota = base64_decode($_GET['mascota']);
    echo $idMascota;

} else {

}



