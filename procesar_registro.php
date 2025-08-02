<?php
require_once 'login/includes/conexion.php';


// Conexión a la base de datos (ajusta los datos si es necesario)
$conexion = new mysqli("localhost", "root", "", "del_campo");

// Verifica conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Captura los datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Encriptar la contraseña (opcional, pero recomendable)
$contraseñaSegura = password_hash($contraseña, PASSWORD_DEFAULT);

// Insertar en la base de datos
$sql = "INSERT INTO vendedores (nombre, correo, contrasena, telefono, direccion) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssss", $nombre, $correo, $contraseñaSegura, $telefono, $direccion);

if ($stmt->execute()) {
    // Redirige al registro con mensaje de éxito
    header("Location: registro.php?registro=exitoso");
    exit();
} else {
    echo "Error al registrar: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>
