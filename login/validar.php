<?php
session_start();
include('includes/conexion.php'); // Asegúrate de que esta ruta es correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');

    if (empty($correo) || empty($contrasena)) {
        echo "⚠️ Por favor completa todos los campos.";
        exit;
    }

    $sql = "SELECT * FROM vendedores WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $vendedor = $resultado->fetch_assoc();

        // ✅ VERIFICAR CONTRASEÑA ENCRIPTADA
        if (password_verify($contrasena, $vendedor['contrasena'])) {
            $_SESSION['vendedor_id'] = $vendedor['id'];
            $_SESSION['correo'] = $vendedor['correo'];

            // ✅ REDIRIGIR A LA PÁGINA DE PRODUCTOS
            header("Location: registrar_productos.php");
            exit;
        } else {
            echo "❌ Contraseña incorrecta.";
        }
    } else {
        echo "❌ El correo no está registrado.";
    }

    $stmt->close();
    $conn->close();
}
?>
