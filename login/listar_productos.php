<?php
session_start();
if (!isset($_SESSION['vendedor_id'])) {
    header("Location: index.php");
    exit;
}
require_once("includes/conexion.php");

$vendedor_id = $_SESSION['vendedor_id'];
$sql = "SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE creado_por = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendedor_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Productos</title>
    <link rel="stylesheet" href="css/productos_v2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Lista de Productos</h2>

        <?php if (isset($_GET["mensaje"]) && $_GET["mensaje"] === "actualizado"): ?>
            <div class="alert alert-success">✅ Producto actualizado correctamente.</div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($producto = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php if (!empty($producto['imagen'])): ?>
                                <img src="imagenes/<?= htmlspecialchars($producto['imagen']) ?>" width="60" height="60">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td>
                            <a href="editar_producto.php?id=<?= $producto['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                            <!-- Puedes agregar botón eliminar aquí si lo deseas -->
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="registrar_productos.php" class="btn btn-success">Registrar nuevo producto</a>
    </div>
</body>
</html>
