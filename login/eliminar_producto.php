<?php
session_start();
require_once 'includes/conexion.php';

// Verificamos si el usuario está logueado
if (!isset($_SESSION['vendedor_id'])) {
    $_SESSION['error'] = "Acceso no permitido.";
    header("Location: registrar_productos.php");
    exit;
}

// Validar que el ID del producto venga por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id = intval($_POST['id_producto']);
    $vendedor_id = $_SESSION['vendedor_id'];

    // Asegurar que el producto pertenece al vendedor
    $sql = "DELETE FROM productos WHERE id = ? AND creado_por = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $vendedor_id);

    if ($stmt->execute()) {
        $_SESSION['exito'] = "Producto eliminado correctamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el producto.";
    }

    $stmt->close();
    $conn->close();

    header("Location: registrar_productos.php");
    exit;
} else {
    $_SESSION['error'] = "ID de producto no válido.";
    header("Location: registrar_productos.php");
    exit;
}
