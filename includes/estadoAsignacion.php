<?php
include 'conTest.php'; // Incluye el archivo con la conexión a la base de datos

// Obtener los valores de la URL
$id_documento = $_GET['id_documento'];
$valor = $_GET['valor'];

// Realizar la consulta SQL para actualizar la tabla nuevaAsignación
$sql_asignacion = "UPDATE nuevaAsignacion SET estado_asignacion = $valor WHERE id_documento = $id_documento";

// Iniciar una transacción
$conn->begin_transaction();

try {
    // Actualizar la tabla nuevaAsignación
    $conn->query($sql_asignacion);

    // Confirmar la transacción
    $conn->commit();

    // Realizar la segunda consulta SQL para actualizar la tabla nuevoDocumento
    $sql_documento = "UPDATE nuevoDocumento SET estado = $valor WHERE id = $id_documento";
    
    // Iniciar una nueva transacción para la segunda actualización
    $conn->begin_transaction();
    
    // Actualizar la tabla nuevoDocumento
    $conn->query($sql_documento);
    
    // Confirmar la segunda transacción
    $conn->commit();

    // Éxito: ambas actualizaciones se realizaron correctamente
    header('Location: ../documento.php'); // Redirige a la página documento.php o a donde desees
} catch (Exception $e) {
    // Error en la actualización, deshacer ambas transacciones
    $conn->rollback();
    echo "Error al actualizar el estado de asignación y el estado del documento: " . $e->getMessage();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
