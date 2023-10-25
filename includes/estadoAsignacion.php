<?php
include 'conTest.php'; // Incluye el archivo con la conexión a la base de datos

// Obtener los valores de la URL
$id_documento = $_GET['id_documento'];
$valor = $_GET['valor'];

// Realizar la consulta SQL para actualizar la tabla nuevaAsignación
$sql = "UPDATE nuevaAsignacion SET estado_asignacion = $valor WHERE id_documento = $id_documento";

if ($conn->query($sql) === TRUE) {
    // Éxito: la actualización se realizó correctamente
    header('Location: ../asignacion.php'); // Redirige a la página documento.php o a donde desees
} else {
    // Error en la actualización
    echo "Error al actualizar el estado de asignación: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
