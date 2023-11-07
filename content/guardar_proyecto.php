<?php
$servername = "localhost";
$username = "u291982824_puto";
$password = "7.1291.Puto*";
$database = "u291982824_puto";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['start'];
$fecha_estimada_fin = $_POST['end'];
$fecha_real_fin = $_POST['fecha_real_fin'];

// Insertar datos en la tabla 'proyecto'
$sql = "INSERT INTO proyecto (nombre, descripcion, fecha_inicio, fecha_estimada_fin, fecha_real_fin) VALUES ('$nombre', '$descripcion', '$fecha_inicio', '$fecha_estimada_fin', '$fecha_real_fin')";

if ($conn->query($sql) === TRUE) {
    echo "Proyecto creado exitosamente";
} else {
    echo "Error al crear el proyecto: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
