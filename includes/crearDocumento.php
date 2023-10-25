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

// Establecer la zona horaria a Perú
date_default_timezone_set('America/Lima');

// Obtener la fecha y hora actual
$fecha_creacion = date('Y-m-d H:i:s');

// Consulta SQL para insertar los datos en la tabla nuevoDocumento
$sql = "INSERT INTO nuevoDocumento (codigo, tipo_documento, numero, anio, entidad_remitente, suscrito, destinatario_o_cargo, entidad, carpeta_fiscal, direccion, observaciones, estado, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Vincular los parámetros
$stmt->bind_param("ssiiissssssss", $codigo, $tipo_documento, $numero, $anio, $entidad_remitente, $suscrito, $destinatario_o_cargo, $entidad, $carpeta_fiscal, $direccion, $observaciones, $estado, $fecha_creacion);

// Ejecutar la declaración
if ($stmt->execute()) {
    // Registro de un mensaje de éxito en el registro del servidor
    error_log("Nuevo registro insertado en la tabla nuevoDocumento con éxito.");
} else {
    // Registro de un mensaje de error en el registro del servidor
    error_log("Error al insertar el registro: " . $stmt->error);
}

// Cerrar la declaración
$stmt->close();
?>
