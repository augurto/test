<?php
require('fpdf/fpdf.php');

// Crear una instancia de la clase FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Configurar la fuente y el tamaño
$pdf->SetFont('Arial', '', 12);

// Obtener la fecha actual en la zona horaria de Perú
date_default_timezone_set('America/Lima');
$fecha = date('d/m/Y');

// Agregar la fecha
$pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1, 'R');

// Agregar el asunto
$pdf->Cell(0, 10, 'Asunto: Solicitud del auditorio de la casa Barrial', 0, 1, 'L');

// Agregar saltos de línea
$pdf->Ln(50); // 5 saltos de línea

// Agregar "SR:" y los datos del formulario (nombre)
$nombre = $_POST['nombres']; // Asegúrate de obtener el valor del formulario adecuadamente
$pdf->Cell(0, 10, 'SR: ' . $nombre, 0, 1, 'L');

// Agregar el texto del cuerpo de la carta
$textoCuerpo = "PRESIDENTE DE LA JUNTA PARROQUIAL\nPRESENTE\n\nApreciable Sr. Trinquete Chanchullo, por medio de este oficio se le hace comunicación de la resolución de la junta directiva de esta empresa, en relación a su comportamiento y manejo de los recursos económicos de la sucursal bajo su cargo. Según los reportes anteriores que hemos tenido, aunadas a las quejas de malos tratos recibidos por usted por parte de sus subordinados, comunicándole el dictamen de la junta directiva, consistente en la resolución de separarlo del cargo que ostenta dentro de esta empresa y pedirle su renuncia. Adjuntando documentos que prueban diversos malos manejos, así como se adjuntan testimonios respectivos a los malos tratos. Atentamente";

$pdf->MultiCell(0, 10, $textoCuerpo, 0, 'J');

// Salida del PDF
$pdf->Output();
?>
