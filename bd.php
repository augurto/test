<?php
$servername = "localhost";
$username = "u291982824_test";
$password = "21.12*Test";
$database = "u291982824_test";

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    // Registro de un mensaje de error en el registro del servidor
    error_log("Error en la conexión a la base de datos: " . $conn->connect_error);
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
} else {
    // Registro de un mensaje de éxito en el registro del servidor
    error_log("Conexión a la base de datos establecida correctamente.");
}
?>
