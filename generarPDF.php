<?php

require('fpdf/fpdf.php');

// Obtener los datos del formulario
$nombres = $_POST['nombres'];
$requerimiento = $_POST['Requerimiento'];
$selectedUserId = $_POST['selected_user']; // Nombre del campo select

error_log("Mensaje de depuración 1");
print_r($selectedUsers); // Imprime el contenido del arreglo $selectedUsers
error_log("Mensaje de depuración 2");


// Incluir el archivo de conexión a la base de datos
require 'db_connection.php';
$nombresUsuarios = "";
$cargosUsuarios = "";

// Insertar los datos del formulario en una tabla (ajusta el nombre de la tabla según tu base de datos)
$insertQuery = "INSERT INTO documentoCreado (nombres, requerimiento, id_user) VALUES ('$nombres', '$requerimiento', '$selectedUserId')";
if ($conn->query($insertQuery) === true) {
    // Obtener el ID del registro insertado
    $id_inserted = $conn->insert_id;
} else {
    echo 'Error al insertar datos en la base de datos: ' . $conn->error;
}

// Crear una instancia de la clase FPDF
$pdf = new FPDF();
$pdf->AddPage();


// Configurar la fuente y el tamaño
$pdf->SetFont('Arial', '', 12);

// Días de la semana y meses en español
$nombreDias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
$nombreMeses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

// Agregar la imagen "antamina.jpg" alineada a la derecha
$pdf->Image('assets/images/antamina.jpg', $pdf->GetX() + 150, $pdf->GetY(), 20); // Ajusta la posición y el ancho según tus necesidades
// Ajusta el ancho (100) según tus necesidades
$pdf->SetY($pdf->GetY() + 10); // Ajusta la posición vertical según tus necesidades
$pdf->Cell(0, 10, utf8_decode('Año de la unidad, la paz y el desarrollo'), 0, 1, 'C');

// Obtener la fecha actual en la zona horaria de Perú
date_default_timezone_set('America/Lima');
$dia = date('j'); // Día del mes sin ceros iniciales
$mes = date('n'); // Mes numérico
$anio = date('Y'); // Año

// Agregar la fecha en formato "día, nombre del mes y año"
$fecha = $nombreDias[date('w')] . ', ' . $dia . ' de ' . $nombreMeses[$mes - 1] . ' de ' . $anio;
$pdf->Cell(0, 10, 'Yanacancha, ' . $fecha, 0, 1, 'R');

// Obtener la fecha actual en la zona horaria de Perú
date_default_timezone_set('America/Lima');
$dia2 = date('j'); // Día del mes sin ceros iniciales
$mes2 = date('n'); // Mes numérico
$anio2 = date('Y'); // Año
$hora2 = date('H'); // Hora
$minuto2 = date('i'); // Minuto
$segundo2 = date('s'); // Segundo


// Agregar el texto "Carta:" seguido de la variable $cartaID
$pdf->Cell(0, 10, utf8_decode(' CARTA N°').$id_inserted, 0, 1, 'R');

// Agregar saltos de línea
$pdf->Ln(30); // 5 saltos de línea

// Agregar "SR:" y los datos del formulario (nombre)
$nombre = $_POST['nombres']; // Asegúrate de obtener el valor del formulario adecuadamente
$pdf->Cell(0, 10, 'SR: ' . $nombre, 0, 1, 'L');
// Recorrer los IDs de usuarios seleccionados y consultar la base de datos
foreach ($selectedUsers as $id_user) {
    $userQuery = "SELECT nombre, cargo FROM usuarios WHERE id_user = $id_user";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $nombreUsuario = $userRow["nombre"];
        $cargoUsuario = $userRow["cargo"];

        // Agregar el nombre y el cargo de cada usuario al PDF
        $nombresUsuarios .= $nombreUsuario . "\n";
        $cargosUsuarios .= $cargoUsuario . "\n";
    }
}

// Agregar "Usuarios Seleccionados:"
$pdf->Cell(0, 10, 'Usuarios Seleccionados:', 0, 1, 'L');

// Agregar los nombres de los usuarios al PDF
$pdf->Cell(0, 10, 'Nombres:', 0, 1, 'L');
$pdf->MultiCell(0, 10, utf8_decode($nombresUsuarios), 0, 'L');

// Agregar los cargos de los usuarios al PDF
$pdf->Cell(0, 10, 'Cargos:', 0, 1, 'L');
$pdf->MultiCell(0, 10, utf8_decode($cargosUsuarios), 0, 'L');

// Texto justificado
$textoJustificado = "Apreciable Sr. Trinquete Chanchullo, por medio de este oficio se le hace comunicación de la resolución de la junta directiva de esta empresa, en relación a su comportamiento y manejo de los recursos económicos de la sucursal bajo su cargo. Según los reportes anteriores que hemos tenido, aunadas a las quejas de malos tratos recibidos por usted por parte de sus subordinados, comunicándole el dictamen de la junta directiva, consistente en la resolución de separarlo del cargo que ostenta dentro de esta empresa y pedirle su renuncia.";

// Agregar el texto justificado
$pdf->MultiCell(0, 10, utf8_decode($textoJustificado), 0, 'J');
$pdf->Ln(5); 

// Agregar "Requiero:" y los datos del formulario (Requerimiento)
$requerimiento = $_POST['Requerimiento']; // Asegúrate de obtener el valor del formulario adecuadamente
$pdf->Cell(0, 10, 'Requiero: ' . $requerimiento, 0, 1, 'L');

// Texto del cuerpo de la carta
$textoCuerpo = "Adjuntando documentos que prueban diversos malos manejos, así como se adjuntan testimonios respectivos a los malos tratos.\n";
$textoCuerpo .= "Atentamente";

// Agregar el texto del cuerpo de la carta
$pdf->MultiCell(0, 10, utf8_decode($textoCuerpo), 0, 'J');

// Centrar la imagen de la firma
$pdf->Image('assets/images/firma.png', 75, $pdf->GetY() + 20, 50);


// Salida del PDF
$pdf->Output();
?>
