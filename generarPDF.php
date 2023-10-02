<?php
require('fpdf/fpdf.php');

class PDF extends FPDF {
    // Función para el encabezado
    function Header() {
        $this->SetFont('Arial', '', 12);
        $this->SetXY(0, 10);
        $this->Cell(210, 10, utf8_decode('Año de la unidad, la paz y el desarrollo'), 0, 1, 'C');
    }
    // Función para el pie de página
    function Footer() {
        // Establecer la posición a 1.5 cm desde el final de la página
        $this->SetY(-15);
        // Configurar fuente y tamaño para la fecha
        $this->SetFont('Arial', 'I', 8);
        // Imprimir la fecha actual en la parte inferior
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');
        $this->Cell(0, 10, 'Fecha: ' . $fechaActual, 0, 0, 'C');
    }
}

// Establecer conexión a la base de datos
$usuario = "u291982824_test";
$contrasena = "21.17.Audra";
$base_de_datos = "u291982824_test";
$host = "localhost";

// Obtener el valor del 'tipoDocumento' y 'Observaciones' enviados desde el formulario
$tipoDocumento2 = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : '';
$tipoDocumento=1;
$observacionesFormulario = isset($_POST['Observaciones']) ? $_POST['Observaciones'] : '';

// Validar que 'tipoDocumento' no esté vacío
if (!empty($tipoDocumento)) {
    // Intentar establecer la conexión
    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Verificar si la conexión fue exitosa
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    } else {
        // Consultar la base de datos para obtener el nombreDocumento
        $consulta = "SELECT nombreDocumento, Observacion FROM documento WHERE id = 1";
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param("i", $tipoDocumento); // "i" indica que se espera un valor entero
        $stmt->execute();
        $stmt->bind_result($nombreDocumento, $observacion);

        // Crear un nuevo objeto PDF
        $pdf = new PDF();
        $pdf->AddPage();

        // Agregar estilo CSS para centrar y justificar texto
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Tipo de Documento (formulario):', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        
        // Obtener el nombre del documento correspondiente al ID
        $pdf->MultiCell(0, 10, $nombreDocumento, 0, 'C');

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Observaciones (formulario):', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 10, 'asdasdsad'); // Muestra las observaciones del formulario

        // Calcular la posición X para centrar la imagen en el eje horizontal
        $imageWidth = 50; // Ancho de la imagen en puntos
        $pageWidth = $pdf->GetPageWidth(); // Ancho de la página en puntos
        $imageX = ($pageWidth - $imageWidth) / 2;

        $pdf->Image('assets/images/firma.png', $imageX, $pdf->GetY() + 10, $imageWidth); // Centra la imagen horizontalmente

        // Salida del PDF
        $pdf->Output();

        // Cerrar la conexión y liberar recursos
        $stmt->close();
        $conexion->close();
    }
} else {
    echo "Tipo de Documento no válido o no se proporcionó.";
}
?>

