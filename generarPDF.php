<?php
// Incluye la biblioteca FPDF
require('fpdf/fpdf.php');

// Configura la conexión a la base de datos
$usuario = 'u291982824_test';
$contraseña = '21.17.Audra';
$base_de_datos = 'u291982824_test';
$localhost = 'localhost';

// Conecta a la base de datos
$conexion = mysqli_connect($localhost, $usuario, $contraseña, $base_de_datos);

// Verifica si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtiene el valor del campo "tipoDocumento" del formulario
$tipoDocumento = $_POST['tipoDocumento'];

// Consulta la base de datos para obtener los datos correspondientes al tipo de documento
$sql = "SELECT nombreDocumento FROM documento WHERE id = $tipoDocumento";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $nombreDocumento = $fila['nombreDocumento'];
} else {
    $nombreDocumento = "Documento no encontrado";
}

// Obtiene las observaciones adicionales del formulario
$observaciones = $_POST['observacionesAdicionales'];

// Inicializa la clase FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Agrega el título (nombre del documento)
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, $nombreDocumento, 0, 1, 'C');

// Agrega las observaciones
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $observaciones);

// Agrega la imagen
$pdf->Image('assets/images/firma.png', 10, $pdf->GetY() + 10, 50);

// Genera el PDF en una nueva ventana o pestaña
$pdf->Output('_blank');

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
