<?php
//REGISTRO LOG LOGOUT
require_once 'controllers/controller.log.php';
$log = new ControllerLog();
$log->register($_SESSION['administrador']->email_admin,"CIERRE SESION");

session_destroy();
echo '<script>
window.location = "/admin";
</script>';