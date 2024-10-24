<?php
// data-renovacion.ajax.php

header('Content-Type: application/json');

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../views/assets/fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta

    // Verifica si la carpeta de destino existe
    $directory = __DIR__ . '/../views/assets/pdfs/comercios/renovaciones/'; // Usando ruta absoluta
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true); // Crea la carpeta si no existe
    }

    // Obtener los datos enviados por POST
    $data = $_POST; // Puedes agregar validaciones según tu necesidad

    $pdf = new FPDF();
    $pdf->AddPage(); // Agregar una página

    // Agregar la imagen en la cabecera
    $pdf->Image('../views/assets/images/informes/cabecera.png', 10, 10, 190);
    $pdf->Ln(30); // Salto de línea después de la imagen

    // Imprimir los datos del formulario
    $pdf->SetFont('Arial', 'B', 16); // Configuración de fuente
    $pdf->Cell(0, 10, 'Datos de Renovacion', 0, 1, 'C'); // Título del PDF
    $pdf->Ln(10); // Salto de línea

    // Títulos y datos
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Text(15, 35, 'Número Cuenta DREI:');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Text(15, 45, $_POST['cuenta_drei']);

    // Agregar los campos del formulario
    $pdf->SetFont('Arial', '', 12); // Cambiar a fuente normal
    foreach ($data as $key => $value) {
        $pdf->Cell(0, 10, ucfirst($key) . ': ' . $value, 0, 1); // Imprimir clave y valor
    }

    $pdfPath = $directory . 'renovacion_' . date('YmdHis') . '.pdf'; // Ruta del PDF a crear con timestamp

    // Intentar generar el PDF y manejar errores
    try {
        $pdf->Output('F', $pdfPath);
        echo json_encode([
            'status' => 'success',
            'message' => 'PDF generado exitosamente.',
            'data' => ['pdf_path' => $pdfPath]
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error al generar el PDF: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido.'
    ]);
}
?>
