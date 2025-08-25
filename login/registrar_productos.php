<?php
session_start();

if (!isset($_SESSION['vendedor_id'])) {
    header("Location: index.php");
    exit;
}

include(__DIR__ . "/includes/conexion.php");

$vendedor_id = $_SESSION['vendedor_id'];
$query = "SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE creado_por = ? ORDER BY creado_en DESC LIMIT 6";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $vendedor_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="imagenes/favi.png" type="image/png">
    <title>Registro de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <!-- Formulario a la izquierda -->
        <div class="col-md-4">
            <h3 class="mb-3">Registrar producto</h3>
            <form action="procesar_productos.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea name="descripcion" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" name="precio" step="0.01" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen:</label>
                    <input type="file" name="imagen" accept="image/*" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Registrar producto</button>
            </form>
            <a href="../inicio.php" class="btn btn-danger w-100 mt-3">Cerrar sesión</a>
        </div>

        <!-- Tarjetas a la derecha -->
        <div class="col-md-8">
            <h3 class="mb-4">Productos recientes</h3>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="imagenes_productos/<?= htmlspecialchars($row['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nombre']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row['descripcion']) ?></p>
                                <p class="card-text fw-bold">$<?= number_format($row['precio'], 0, ',', '.') ?></p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <form action="editar_producto.php" method="get" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>
                                <form action="eliminar_producto.php" method="post" onsubmit="return confirm('¿Eliminar este producto?');" style="display:inline-block;">
                                    <input type="hidden" name="id_producto" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
