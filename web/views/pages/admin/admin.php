
<!-- modules/links.php -->
<div>
<?php



// Verificar si el usuario está logueado como administrador
if (!isset($_SESSION["administrador"])) {
  
  // Si no está logueado, redirige al login
  include "login/login.php";

} else {

  // Mostrar detalles del administrador logueado para pruebas (puedes eliminar esta línea en producción)
  // echo '<pre>';print_r($_SESSION['administrador']);echo '</pre>';

  include 'modules/preloader.php';
  include 'modules/navbar.php';
  include 'modules/sidebar.php';

  // Validar si hay un módulo en la URL después del dominio
  if (!empty($routesArray[1])) {

    // Asignar el rol del administrador
    $rol_admin = $_SESSION['administrador']->rol_admin;

    // Definir los módulos permitidos para cada rol
    $modulosPorRol = [
      'admin' => ['administradores', 'prensa', 'slides','gestor_reclamos', 'estadisticas_reclamos', 'servicio_tecnico', 'salud_animal', 'mascotas'],
      'prensa' => ['prensa', 'slides'],
      // Agregar más roles y sus permisos si es necesario
    ];

    // Verificar si el módulo al que se intenta acceder está permitido para el rol del usuario
    if (array_key_exists($rol_admin, $modulosPorRol) && in_array($routesArray[1], $modulosPorRol[$rol_admin])) {

      // Incluir el archivo correspondiente al módulo
      include $routesArray[1]."/".$routesArray[1].".php";



    } else {
      // Si no tiene permisos, redirigir a la página de error 404
      echo '<script>
         window.location = "'.$path.'404";
      </script>';
    }

  } else {
    // Si no hay módulo especificado, cargar el tablero por defecto
    include "tablero/tablero.php";
  }

  include 'modules/footer.php';
}
?>

<!-- modules/scripts -->

<script src="<?php echo $path ?>/views/assets/js/tables.js"></script>
<script src="<?php echo $path ?>/views/assets/js/forms.js"></script>


</div>
