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

// Agregar la imagen "antamina.jpg" alineada a la derecha
$pdf->Image('assets/images/antamina.jpg', null, null, 100); // Ajusta el ancho (100) según tus necesidades

// Agregar el texto centrado debajo de la imagen
$pdf->SetY(80); // Ajusta la posición vertical según tus necesidades
$pdf->Cell(0, 10, utf8_decode('Año de la unidad, la paz y el desarrollo'), 0, 1, 'C');

// Obtener la fecha actual en la zona horaria de Perú
date_default_timezone_set('America/Lima');
$dia = date('j'); // Día del mes sin ceros iniciales
$mes = date('n'); // Mes numérico
$anio = date('Y'); // Año

// Agregar la fecha en formato "día, nombre del mes y año"
$fecha = $nombreDias[date('w')] . ', ' . $dia . ' de ' . $nombreMeses[$mes - 1] . ' de ' . $anio;
$pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1, 'R');

// Agregar el asunto alineado a la derecha
$pdf->Cell(0, 10, 'Carta :', 0, 1, 'R');


// Agregar saltos de línea
$pdf->Ln(30); // 5 saltos de línea

// Agregar "SR:" y los datos del formulario (nombre)
$nombre = $_POST['nombres']; // Asegúrate de obtener el valor del formulario adecuadamente
$pdf->Cell(0, 10, 'SR: ' . $nombre, 0, 1, 'L');

// Texto justificado
$textoJustificado = "Apreciable Sr. Trinquete Chanchullo, por medio de este oficio se le hace comunicación de la resolución de la junta directiva de esta empresa, en relación a su comportamiento y manejo de los recursos económicos de la sucursal bajo su cargo. Según los reportes anteriores que hemos tenido, aunadas a las quejas de malos tratos recibidos por usted por parte de sus subordinados, comunicándole el dictamen de la junta directiva, consistente en la resolución de separarlo del cargo que ostenta dentro de esta empresa y pedirle su renuncia.";

// Agregar el texto justificado
$pdf->MultiCell(0, 10, $textoJustificado, 0, 'J');

// Agregar "Requiero:" y los datos del formulario (Requerimiento)
$requerimiento = $_POST['Requerimiento']; // Asegúrate de obtener el valor del formulario adecuadamente
$pdf->Cell(0, 10, 'Requiero: ' . $requerimiento, 0, 1, 'L');

// Texto del cuerpo de la carta
$textoCuerpo = "Adjuntando documentos que prueban diversos malos manejos, así como se adjuntan testimonios respectivos a los malos tratos.\n";
$textoCuerpo .= "Atentamente";

// Agregar el texto del cuerpo de la carta
$pdf->MultiCell(0, 10, $textoCuerpo, 0, 'J');

// Centrar la imagen de la firma
$pdf->Image('assets/images/firma.png', 75, $pdf->GetY() + 20, 50);


// Salida del PDF
$pdf->Output();
?>
