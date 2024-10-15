<?php
require_once 'views/assets/fpdf/fpdf.php'; 
require_once 'controllers/controller.curl.php';

if (isset($_GET['registro']) && !empty($_GET['registro'])) {
    $idRegistro = base64_decode($_GET['registro']);
} else {
    $idRegistro = null;
}

$select = "*";
$url = "registros?select=" . $select;
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
$fechaPedido = '14/10/2024'; // Ejemplo de valor
$dni = '30173025';           // Ejemplo de valor
$nombreApellido = 'MARIA DE LOS ANGELES PERALTA'; // Ejemplo de valor
$telefono = '2311563';       // Ejemplo de valor
$direccion = 'MITRE 1089';   // Ejemplo de valor
$estado = 'Entregado';       // Ejemplo de valor
$zona = 'VILLA ELVIRA';      // Ejemplo de valor
$equipo = 'EQUIPO SOCIAL ADRIANA'; // Ejemplo de valor
$trabajoOficio = 'AMA DE CASA'; // Ejemplo de valor
$bancarizacion = 'SI';       // Ejemplo de valor
$accesoInformacion = 'REDES SOCIALES'; // Ejemplo de valor
$tramiteDNI = 'NO';          // Ejemplo de valor
$monotributo = 'NO, NECESITA'; // Ejemplo de valor
$ultimoTrabajo = '';         // Ejemplo de valor
$educacionPrimariaCompleta = ''; // Ejemplo de valor
$educacionPrimariaIncompleta = ''; // Ejemplo de valor
$educacionSecundariaCompleta = ''; // Ejemplo de valor
$educacionSecundariaIncompleta = ''; // Ejemplo de valor
$observaciones = '';         // Ejemplo de valor
$informe = 'TIENE 36 AÑOS, SOLTERA, SECUNDARIA COMPLETA. VIVE CON XAVIER MILLAN DE 14 AÑOS, ASISTE
A 398, VACUNAS AL DIA, COBRA AUH; KIARA PERALTA DE 12 AÑOS, ASISTE A 125, VACUNAS AL
DIA, COBRA AUH; THIAGO PERALTA DE 8 AÑOS, ASISTE A 125, VACUNAS AL DIA, COBRA AUH. SU
CASA ES PROPIA, TIENE LUZ, AGUA POTABLE Y GAS A GARRAFA. SU CAPS ES ABEL FAUST.
 Solicita carga de garrafa, debido a que no posee los medios economicos para recargarla,
y la necesita para su micro emprendimiento de cocina. Se sugiere darle acceso al
beneficio';               // Ejemplo de valor

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
$pdf->Cell(0, 6, mb_convert_encoding('Trámite DNI: ', 'ISO-8859-1') . '  ' . $tramiteDNI, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Monotributo: ', 'ISO-8859-1') . '  ' . $monotributo, 0, 1, 'L');
$pdf->Cell(0, 6, mb_convert_encoding('Observaciones: ', 'ISO-8859-1') . '  ' . $observaciones, 0, 1, 'L');

// Imprimir el encabezado "Informe" y luego el contenido del informe
$pdf->Ln(10); 
$pdf->Cell(0, 6, mb_convert_encoding('Informe: ', 'ISO-8859-1'), 0, 1, 'L');
$pdf->MultiCell(0, 6, mb_convert_encoding($informe, 'ISO-8859-1'), 0, 'L');





$pdf->Output($pdf_name, 'I');
exit; // Asegúrate de terminar el script después de generar el PDF

