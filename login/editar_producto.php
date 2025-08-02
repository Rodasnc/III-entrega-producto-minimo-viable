<?php
session_start();
if (!isset($_SESSION['vendedor_id'])) {
    header("Location: index.php");
    exit;
}
include(__DIR__ . "/includes/conexion.php");

if (!isset($_GET['id'])) {
    echo "Producto no especificado.";
    exit;
}

$id = $_GET['id'];
$vendedor_id = $_SESSION['vendedor_id'];

// Obtener datos del producto
$stmt = $conn->prepare("SELECT nombre, descripcion, precio FROM productos WHERE id = ? AND creado_por = ?");
$stmt->bind_param("ii", $id, $vendedor_id);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

if (!$producto) {
    echo "Producto no encontrado o no tienes permisos.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/productos_v2.css">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Editar Producto</h2>
        <form action="actualizar_producto.php" method="post">
            <input type="hidden" name="id_producto" value="<?= $id ?>">
            <div class="mb-3">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" step="0.01" class="form-control" value="<?= $producto['precio'] ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="registrar_producto.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
