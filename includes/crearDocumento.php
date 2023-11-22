<?php
include 'conTest.php'; // Incluye el archivo con la conexión a la base de datos

// Resto del código para recopilar los datos del formulario
$codigo = $_POST['codigo'];
$tipo_documento = $_POST['tipo_documento'];
$numero = $_POST['numero'];
$anio = $_POST['anio'];
$entidad_remitente = $_POST['entidad_remitente'];
$suscrito = $_POST['suscrito'];
$destinatario_o_cargo = $_POST['destinatario_o_cargo'];
$entidad = $_POST['entidad'];
$carpeta_fiscal = $_POST['carpeta_fiscal'];
$direccion = $_POST['direccion'];
$observaciones = $_POST['observaciones'];
$estado = $_POST['estado'];
$user = $_POST['user'];


// Establecer la zona horaria a Perú
date_default_timezone_set('America/Lima');

// Obtener la fecha y hora actual
$fecha_creacion = date('Y-m-d H:i:s');

// Consulta SQL para insertar los datos en la tabla nuevoDocumento sin preparar
$sql = "INSERT INTO nuevoDocumento (codigo, tipo_documento, numero, anio, entidad_remitente, suscrito, destinatario_o_cargo, entidad, carpeta_fiscal, direccion, observaciones, estado, fecha_creacion,id_user) VALUES ('$codigo', '$tipo_documento', $numero, $anio, '$entidad_remitente', '$suscrito', '$destinatario_o_cargo', '$entidad', '$carpeta_fiscal', '$direccion', '$observaciones', '$estado', '$fecha_creacion', '$user')";

if ($conn->query($sql) === TRUE) {
    // Registro de un mensaje de éxito en el registro del servidor
    error_log("Nuevo registro insertado en la tabla nuevoDocumento con éxito.");
    
    // Redireccionar a la página ../documento.php
    header('Location: ../documento.php');
} else {
    // Registro de un mensaje de error en el registro del servidor
    error_log("Error al insertar el registro: " . $conn->error);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
