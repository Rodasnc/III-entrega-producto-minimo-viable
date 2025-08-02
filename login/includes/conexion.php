<?php
$host = "localhost";       // o 127.0.0.1
$user = "root";            // Usuario por defecto en XAMPP
$pass = "";                // Sin contraseña por defecto
$db = "del_campo";         // Nombre correcto de tu base de datos

$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer codificación a UTF-8
$conn->set_charset("utf8");
?>
