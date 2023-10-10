<?php

require('fpdf/fpdf.php');

// Obtener los datos del formulario

$nombres = $_POST['nombres'];
$requerimiento = $_POST['Requerimiento'];
$selectedUsers = $_POST['selected_users']; 


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
// Reduce el espacio entre líneas a 4 puntos

$lineHeight = 4;

// Configurar la fuente y el tamaño
$pdf->SetFont('Arial', '', 10);

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
$fecha =  $dia . ' de ' . $nombreMeses[$mes - 1] . ' de ' . $anio;
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
$pdf->Cell(0, 10, utf8_decode(' CARTA N° 000').$id_inserted, 0, 1, 'L');

// Agregar saltos de línea
$pdf->Ln(5); // 5 saltos de línea

// Agregar "SR:" y los datos del formulario (nombre)
$nombre = $_POST['nombres']; // Asegúrate de obtener el valor del formulario adecuadamente
// Recorrer los IDs de usuarios seleccionados y consultar la base de datos
$usuariosData = array(); // Crear un arreglo para almacenar los datos de los usuarios

foreach ($selectedUsers as $id_user) {
    $userQuery = "SELECT nombre, cargo FROM usuarios WHERE id_user = $id_user";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $nombreUsuario = $userRow["nombre"];
        $cargoUsuario = $userRow["cargo"];

        // Agregar los datos del usuario al arreglo
        $usuariosData[] = array(
            'nombre' => $nombreUsuario,
            'cargo' => $cargoUsuario,
        );
    }
}

$pdf->Cell(0, 10, utf8_decode('Señores :'), 0, 1, 'L');
// Iterar a través de los datos de los usuarios y agregarlos al PDF uno por uno
foreach ($usuariosData as $userData) {
    $nombreUsuario = $userData['nombre'];
    $cargoUsuario = $userData['cargo'];

    // Agregar nombre y cargo al PDF
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode($nombreUsuario), 0, 'L');
    // Agregar el texto en negrita
    $pdf->SetFont('Arial', '', 10);
   
    $pdf->MultiCell(0, 10, utf8_decode($cargoUsuario), 0, 'L');
}

// Texto justificado
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, utf8_decode('Asunto : '.$nombres), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$textoJustificado = "Por la presente, me dirijo a usted con la finalidad de hacerle llegar nuestros saludos cordiales en nombre propio y de Compañía Minera Antamina S.A., a la vez manifestarle que como parte del trabajo conjunto que venimos realizando con la Comunidad Campesina de Santa Cruz de Pichiu, en esta oportunidad solicitamos tenga a bien enviarnos los datos completos (nombres y apellidos, DNI, fecha de nacimiento y número de contacto) de 05 personas de la C.C. SCP para la posición de Peón, los detalles a continuación:
";

// Agregar el texto justificado
$pdf->MultiCell(0, 4, utf8_decode($textoJustificado), 0, 'J');
$pdf->Ln(5); 

// Agregar "Requiero:" y los datos del formulario (Requerimiento)
$requerimiento = $_POST['Requerimiento']; // Asegúrate de obtener el valor del formulario adecuadamente
$pdf->Cell(0, 10, 'Asunto: ' . $requerimiento, 0, 1, 'R');

// Configurar la fuente y el tamaño
$pdf->SetFont('Arial', '', 10);

// Texto justificado
$textoJustificado = "N° de vacantes: 05 personas\n";
$textoJustificado .= "Empresa: STRACON\n";
$textoJustificado .= "Posición: Peón\n";
$textoJustificado .= "Requisitos: De preferencia varones, carné de construcción civil vigente y habilitado. Antecedentes Policiales y Penales. Primaria, Secundaria: Conclusa o inconclusa. Abstenerse personal con instrucción superior: Técnica o Universitaria.\n";
$textoJustificado .= "Sueldo: Jornal básico diario de S/56.80 Beneficios según el convenio colectivo de construcción civil vigente.\n";
$textoJustificado .= "Vigencia de Contrato: No aplica la firma de contrato debido al régimen utilizado para este vínculo laboral: Construcción Civil.\n";
$textoJustificado .= "Tiempo de Contrato: Según necesidad de los frentes.\n";
$textoJustificado .= "Régimen: Régimen de construcción civil.\n";
$textoJustificado .= "Sistema de Trabajo: Régimen construcción civil\n";
$textoJustificado .= "\nLos datos de las 05 personas que participarían en esta convocatoria deberán ser enviados el jueves 06 de julio a mi representada.\n";
$textoJustificado .= "Sin otro particular, aprovecho la oportunidad para reiterarle los sentimientos de mi consideración y estima.\n\n";
$textoJustificado .= "Cordialmente,";

// Agregar el texto justificado
$pdf->MultiCell(0, 4, utf8_decode($textoJustificado));
// Agregar la firma y el cargo
$pdf->Cell(0, 4, 'MONICA JACOBS ALVARADO', 0, 1, 'L'); // Nombre
$pdf->Cell(0, 4, 'Superintendente General de Gestión Social', 0, 1, 'L'); // Cargo
$pdf->Cell(0, 4, 'Vicepresidencia de Sostenibilidad y Asuntos Externos', 0, 1, 'L'); // Cargo
$pdf->Cell(0, 4, 'Compañía Minera Antamina S.A', 0, 1, 'L');
// Centrar la imagen de la firma
$pdf->Image('assets/images/firma.png', 75, $pdf->GetY() + 20, 50);


// Salida del PDF
$pdf->Output();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

try {
    // Configurar el servidor SMTP de Gmail
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 2; // Cambia a 2 para ver mensajes de depuración detallados
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ego.17.22@gmail.com'; // Cambia esto a tu dirección de correo
    $mail->Password = 'yxpg decu fxnq egsv'; // Tu contraseña de correo
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Definir el contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Aunto correo prueba';
    $mail->Body = 'Contenido del correo';


    // Recorre los IDs de usuario seleccionados
    $selectedUsers = $_POST['selected_users'];
    foreach ($selectedUsers as $id_user) {
        // Consulta SQL para obtener la dirección de correo electrónico del usuario
        $sql = "SELECT email FROM usuarios WHERE id_user = $id_user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $correo = $row["email"];

            // Limpiar y configurar el destinatario
            $mail->ClearAllRecipients();
            $mail->addAddress($correo);

            // Enviar el correo
            $mail->send();
            
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();

} catch (Exception $e) {
    echo 'Error al enviar correos: ' . $mail->ErrorInfo;
}

?>
