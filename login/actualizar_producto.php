<?php
require_once("includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id_producto);

    if ($stmt->execute()) {
        header("Location: listar_productos.php?mensaje=actualizado");
        exit();
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no válido.";
}
?>
