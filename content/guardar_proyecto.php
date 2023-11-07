<?php
include 'conexion.php';
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['start'];
$fecha_estimada_fin = $_POST['end'];
$fecha_real_fin = $_POST['fecha_real_fin'];

$sql = "INSERT INTO proyecto (nombre, descripcion, fecha_inicio, fecha_estimada_fin, fecha_real_fin) VALUES ('$nombre', '$descripcion', '$fecha_inicio', '$fecha_estimada_fin', '$fecha_real_fin')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../proyecto.php");
    exit(); 
} else {
    echo "Error al crear el proyecto: " . $conn->error;
}
$conn->close();
?>
