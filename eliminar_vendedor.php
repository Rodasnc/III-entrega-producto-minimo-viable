<?php
session_start();

// Verificamos si el usuario es administrador
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] !== true) {
    echo "Acceso no permitido.";
    exit;
}

require_once 'login/includes/conexion.php';

if (isset($_GET['id'])) {
    $vendedor_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM vendedores WHERE id = ?");
    $stmt->bind_param("i", $vendedor_id);

    if ($stmt->execute()) {
        header("Location: listar_vendedores.php");
        exit;
    } else {
        echo "Error al eliminar el vendedor: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID del vendedor no especificado.";
}
