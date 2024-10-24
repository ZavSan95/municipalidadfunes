<?php
session_start();
require_once 'views/assets/fpdf/fpdf.php'; 

class pdf extends FPDF {
    public function header() {
    }
    public function footer() { 
    }
}

// Generar PDF
$fpdf = new pdf('P', 'mm', 'letter');
$fpdf->AddPage('PORTRAIT', 'letter');
$fpdf->SetMargins(20,10,20);

// Guardar el archivo en el servidor
$pdf_name = "documento_vacio.pdf"; // Nombre del archivo PDF
$path = "views/assets/pdfs/comercios/renovaciones/" . $pdf_name;

$pdf->Output($path, 'F'); // 'F' guarda el archivo en el servidor en la ruta especificada

// Retornar respuesta en formato JSON
if (file_exists($path)) {
    echo json_encode(['status' => 'success', 'message' => 'PDF generado correctamente.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se pudo generar el PDF.']);
}
exit; // Terminar el script
