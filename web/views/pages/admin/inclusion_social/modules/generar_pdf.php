<?php
require_once 'views/assets/fpdf/fpdf.php'; 
require_once 'controllers/controller.curl.php';

if (isset($_GET['registroPDF']) && !empty($_GET['registroPDF'])) {
    $idRegistro = base64_decode($_GET['registroPDF']);
} else {
    $idRegistro = null;
}

$select = "*";
$url = "relations?rel=registros,restados,prioridades,rzonas,equipos,trabajos&type=registro,restado,prioridad,rzona,equipo,trabajo".
"&linkTo=id_registro&equalTo=".base64_decode($_GET['registroPDF'])."&select=" . $select;
$method = "GET";
$fields = array();

$data = CurlController::request($url, $method, $fields);
if ($data->status == 200) {
    $data = $data->results[0];
} else {
    $data = [];
}

ob_end_clean(); 
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);  
header("Content-Type: text/html; charset=UTF-8");  

$pdf = new FPDF();
$pdf->AddPage();

// Agregar la imagen en la cabecera
$pdf->Image('views/assets/images/informes/cabecera.png', 10, 10, 190);
$pdf->Ln(30); 

// Establecer la fuente para la fecha y el número de registro
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, mb_convert_encoding('Fecha: ' . date('d/m/Y') . '   |   Número de Registro: ' . $idRegistro, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
$pdf->Ln(10); 

// Título
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, mb_convert_encoding('COORDINACIÓN DE INCLUSIÓN SOCIAL / OFICINA DE TRABAJO SOCIAL', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
$pdf->Ln(10); 

// Informe Social
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 5, mb_convert_encoding('INFORME SOCIAL - GOBIERNO DE LA CIUDAD DE FUNES', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->Ln(10); 

// Datos Solicitante
$pdf->SetFont('Arial', 'I', 15);
$pdf->Cell(0, 5, mb_convert_encoding('DATOS PERSONALES DEL SOLICITANTE', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->Ln(10); 

// Establecer una fuente más pequeña para los encabezados
$pdf->SetFont('Arial', 'B', 10);

// Agregar encabezados
$fechaPedido = $data->date_created_registro; 
$dni = $data->dni_registro;           
$nombreApellido = $data->nombre_registro; 
$telefono = $data->telefono_registro;       
$direccion = $data->direccion_registro;   
$estado = $data->descripcion_restado;       
$zona = $data->descripcion_rzona;      
$equipo = $data->descripcion_equipo; 
$trabajoOficio = $data->descripcion_trabajo; 
$bancarizacion = $data->bancarizacion_registro;       
$accesoInformacion = $data->acceso_registro;         
$ultimoTrabajo = $data->utrabajo_registro;         
 

// Función para limpiar el HTML del informe
function limpiarHtml($texto) {
    // Reemplazar saltos de línea <br> o <br /> por un espacio, para que las oraciones queden en la misma línea
    $texto = preg_replace('/<br\s*\/?>/i', ' ', $texto);
    
    // Convertir entidades HTML a caracteres
    $texto = html_entity_decode($texto, ENT_QUOTES, 'UTF-8');
    
    // Eliminar cualquier otra etiqueta HTML que quede
    $texto = strip_tags($texto);
    
    // Eliminar saltos de línea innecesarios
    $texto = trim(preg_replace('/\s+/', ' ', $texto));
    
    return $texto;
}

$observaciones = limpiarHtml($data->observacion_registro);   
$informe = limpiarHtml($data->informe_registro);

// Agregar encabezados con valores en la misma fila y un espacio entre ellos
$pdf->Cell(0, 6, mb_convert_encoding('Fecha Pedido: ', 'ISO-8859-1') . '  ' . $fechaPedido, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('DNI: ', 'ISO-8859-1') . '  ' . $dni, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Nombre y Apellido: ', 'ISO-8859-1') . '  ' . $nombreApellido, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Teléfono: ', 'ISO-8859-1') . '  ' . $telefono, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Dirección: ', 'ISO-8859-1') . '  ' . $direccion, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Estado: ', 'ISO-8859-1') . '  ' . $estado, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Zona: ', 'ISO-8859-1') . '  ' . $zona, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Equipo: ', 'ISO-8859-1') . '  ' . $equipo, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Trabajo/Oficio: ', 'ISO-8859-1') . '  ' . $trabajoOficio, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Bancarización: ', 'ISO-8859-1') . '  ' . $bancarizacion, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Acceso a la información: ', 'ISO-8859-1') . '  ' . $accesoInformacion, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Observaciones: ', 'ISO-8859-1') . '  ' . $observaciones, 0, 1, 'L');

// Imprimir el encabezado "Informe" y luego el contenido del informe con menor espaciado entre líneas
$pdf->Ln(10); 
$pdf->Cell(0, 6, mb_convert_encoding('Informe: ', 'ISO-8859-1'), 0, 1, 'L');
$pdf->MultiCell(0, 5, mb_convert_encoding($informe, 'ISO-8859-1'), 0, 'L'); // Reduce el valor de alto de línea a 5







$pdf_name = "registro_" . $idRegistro . ".pdf";
$path = "views/assets/pdfs/inclusion_social/" . $pdf_name;  // Define la ruta donde se guardará el PDF

// Guarda el archivo en el servidor
$pdf->Output($path, 'F'); // 'F' guarda el archivo en el servidor en la ruta especificada

// Opcionalmente, también puedes mostrar el PDF en el navegador
$pdf->Output($pdf_name, 'I');
exit; // Asegúrate de terminar el script después de generar el PDF

