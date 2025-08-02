<?php
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['vendedor_id'])) {
    header("Location: index.php");
    exit;
}

include("includes/conexion.php");

// Validar que todos los campos estén presentes
if (
    isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio']) &&
    isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK
) {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $vendedor_id = $_SESSION['vendedor_id'];

    // Validar extensión segura
    $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

    if (in_array($extension, $permitidas)) {
        // Generar un nombre único para evitar duplicados
        $imagenNombre = uniqid() . "." . $extension;
        $rutaDestino = "imagenes_productos/" . $imagenNombre;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen, creado_por) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagenNombre, $vendedor_id);

            if ($stmt->execute()) {
                header("Location: registrar_productos.php?exito=1");
                exit;
            } else {
                echo "Error al guardar el producto: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error al mover la imagen al servidor.";
        }
    } else {
        echo "Tipo de imagen no permitido. Usa JPG, PNG, GIF o WEBP.";
    }

    $conn->close();
} else {
    echo "Faltan datos del formulario o la imagen no se cargó correctamente.";
}
?>
