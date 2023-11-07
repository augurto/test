<?php
$servername = "localhost";
$username = "u291982824_puto";
$password = "7.1291.Puto*";
$database = "u291982824_puto";

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
