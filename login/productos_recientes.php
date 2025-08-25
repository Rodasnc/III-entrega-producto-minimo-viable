<?php
session_start();
if (!isset($_SESSION['vendedor_id'])) {
    header("Location: index.php");
    exit;
}
include(__DIR__ . "/includes/conexion.php");

$vendedor_id = $_SESSION['vendedor_id'];

$query = "SELECT id, nombre, imagen FROM productos WHERE creado_por = ? ORDER BY creado_en DESC LIMIT 6";
$stmt = $conn->prepare($query);
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
<body >
    <div class="row">
    <?php while($row = $resultado->fetch_assoc()): ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100 text-center">
                <img src="imagenes_productos/<?= htmlspecialchars($row['imagen']) ?>" 
                     class="card-img-top" 
                     alt="<?= htmlspecialchars($row['nombre']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
                </div>
                <div class="card-footer">
                    <form action="eliminar_producto.php" method="post" 
                          onsubmit="return confirm('¿Eliminar este producto?');">
                        <input type="hidden" name="producto_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<div class="text-center mt-4">
    <a href="registrar_producto.php" class="btn btn-success">Volver al Registro</a>
</div>
