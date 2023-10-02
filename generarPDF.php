<?php
require('fpdf/fpdf.php');

// Crear una instancia de la clase FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Configurar la fuente y el tamaño
$pdf->SetFont('Arial', '', 12);

// Obtener la fecha actual en la zona horaria de Perú
date_default_timezone_set('America/Lima');
$fecha = strftime('%d de %B de %Y');

// Agregar la fecha
$pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1, 'R');

// Agregar el asunto
$pdf->Cell(0, 10, 'Asunto: Solicitud del auditorio de la casa Barrial', 0, 1, 'L');

// Agregar saltos de línea
$pdf->Ln(50); // 5 saltos de línea

// Agregar "SR:" y los datos del formulario (nombre)
$nombre = $_POST['nombres']; // Asegúrate de obtener el valor del formulario adecuadamente
$pdf->Cell(0, 10, 'SR: ' . $nombre, 0, 1, 'L');

// Texto del cuerpo de la carta
$textoCuerpo = "Requiero: " . $_POST['Requerimiento'] . "\n\n";
$textoCuerpo .= "Adjuntando documentos que prueban diversos malos manejos, así como se adjuntan testimonios respectivos a los malos tratos.\n";
$textoCuerpo .= "Atentamente";

// Agregar el texto del cuerpo de la carta
$pdf->MultiCell(0, 10, $textoCuerpo, 0, 'J');

// Agregar la imagen de la firma
$pdf->Image('assets/images/firma.png', 10, $pdf->GetY() + 10, 50);

// Agregar el texto "Firma" debajo de la imagen
$pdf->Cell(0, 10, 'Firma', 0, 1, 'C');

// Salida del PDF
$pdf->Output();
?>
