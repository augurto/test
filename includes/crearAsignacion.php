<?php
include 'conTest.php'; // Incluye el archivo con la conexión a la base de datos

// Recopila los datos del formulario
$documento = $_POST['documento'];
$courier = $_POST['courier'];
/* $dependencia = $_POST['dependencia']; */
$usuario = $_POST['user'];

// Establecer la zona horaria a Perú
date_default_timezone_set('America/Lima');

// Obtener la fecha y hora actual de Perú
$fecha_asignacion = date('Y-m-d H:i:s');

// Consulta SQL para insertar los datos en la tabla nuevaAsignacion con la fecha y hora actual
$sql = "INSERT INTO nuevaAsignacion (id_documento, id_courier, fecha_asignacion, id_user) 
        VALUES ('$documento', '$courier', '$fecha_asignacion', '$usuario')";

// Ejecutar la consulta SQL
if ($conn->query($sql) === TRUE) {
    // Redireccionar a la página de éxito o a donde desees
    header('Location: ../asignacion.php');
} else {
    // Manejo de errores, muestra un mensaje de error o redirige a una página de error
    echo "Error al insertar la asignación: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
