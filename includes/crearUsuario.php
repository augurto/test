<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "u291982824_siscun";
    $password = "Siscun*20";
    $dbname = "u291982824_siscun";


    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $nombreUsuario = $_POST['nombres'];
    $documento = $_POST['documento'];
    $email = $_POST['email'];
    $password = $_POST['pass']; 
    $entidad = $_POST['entidad']; 

    // Preparar la consulta SQL para insertar los datos en la tabla de usuarios (ajusta el nombre de la tabla según tu base de datos)
    $sql = "INSERT INTO user (documento, nombre_user,userName,tipo_user,email_user, pass_user, empresaUser, sede) 
    VALUES ('$documento','$nombreUsuario','$nombreUsuario','1', '$email', '$password','1','$entidad')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Usuario creado con éxito";
        // Redirigir a la página nuevo_usuario.php
        header("Location: ../nuevo_usuario.php");
        exit(); // Asegurar que el script se detenga después de la redirección
    } else {
        echo "Error al crear el usuario: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "No se recibieron datos del formulario";
}
