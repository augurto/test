<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos no está en localhost
$username = "u291982824_test";
$password = "21.12*Test";
$database = "u291982824_test";

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Consulta SQL para obtener correos de la tabla "usuarios"
$sql = "SELECT email FROM usuarios";
$result = $conn->query($sql);

// Array para almacenar los correos
$correos = array();

if ($result->num_rows > 0) {
    // Recorre los resultados y agrega los correos al array
    while ($row = $result->fetch_assoc()) {
        $correos[] = $row["email"];
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

$mail = new PHPMailer(true);

try {
    // Configurar el servidor SMTP de Gmail
    $mail->SMTPDebug = 2; // Cambia a 2 para ver mensajes de depuración detallados
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ego.17.22@gmail.com';
    $mail->Password = 'yxpg decu fxnq egsv'; // La contraseña de aplicación que generaste
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Destinatarios dinámicos
    foreach ($correos as $correo) {
        $mail->addAddress($correo);
    }

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Asunto del correo';
    $mail->Body    = 'Este es el contenido del correo.';

    $mail->send();
    echo 'El correo se ha enviado correctamente.';
    
    // Redireccionar a index.php después de enviar el correo
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
}
?>
