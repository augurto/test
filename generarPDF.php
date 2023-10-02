<?php
require('fpdf/fpdf.php');

// Crear una instancia de la clase FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Configurar la fuente y el tamaño
$pdf->SetFont('Arial', '', 12);

// Días de la semana y meses en español
$nombreDias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
$nombreMeses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

// Obtener la fecha actual en la zona horaria de Perú
date_default_timezone_set('America/Lima');
$dia = date('j'); // Día del mes sin ceros iniciales
$mes = date('n'); // Mes numérico
$anio = date('Y'); // Año

// Agregar la fecha en formato "día, nombre del mes y año"
$fecha = $nombreDias[date('w')] . ', ' . $dia . ' de ' . $nombreMeses[$mes - 1] . ' de ' . $anio;
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

// Centrar la imagen de la firma
$pdf->Image('assets/images/firma.png', 75, $pdf->GetY() + 20, 50);

// Agregar la palabra "Firma" debajo de la imagen
$pdf->SetX(75);
$pdf->Cell(50, 10, 'Firma', 0, 1, 'C');

// Salida del PDF
$pdf->Output();
?>
