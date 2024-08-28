<?php
//=====================================
        //Depurar Errores
//=====================================
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log","C:/xampp/htdocs/webmunicipalidad/php_error_log");

require_once 'controllers/controller.template.php';

$index = new TemplateController();
$index->index();