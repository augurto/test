<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';

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

    // Destinatarios
    $mail->setFrom('ego.17.22@gmail.com', 'Pruebas Ego');
    $mail->addAddress('augurto.17@gmail.com', 'Destinatario 1');
    $mail->addAddress('lolahydra21@gmail.com', 'Destinatario 2');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Asunto del correo';
    $mail->Body    = 'Este es el contenido del correo.';

    $mail->send();
    echo 'El correo se ha enviado correctamente.';
} catch (Exception $e) {
    echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
}
?>
