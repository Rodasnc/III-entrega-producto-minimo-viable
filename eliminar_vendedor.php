<?php
require_once 'login/includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']); // Convertir a número entero

        // Eliminar vendedor
        $sql = "DELETE FROM vendedores WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: listar_vendedores.php");
            exit();
        } else {
            echo "❌ Error al eliminar: " . $conn->error;
        }
    } else {
        echo "❌ ID no recibido.";
    }
} else {
    echo "❌ Acceso no permitido.";
}
