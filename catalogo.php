<?php
require_once 'login/includes/conexion.php';

// Traer todos los productos con info del vendedor
$sql = "SELECT p.*, v.nombre AS vendedor_nombre, v.correo, v.telefono, v.direccion
        FROM productos p
        JOIN vendedores v ON p.creado_por = v.id
        ORDER BY p.creado_en DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="imagenes/favi.png" type="image/png">
    <title>Catálogo de Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/catalogo.css">

</head>
<body>
    <header class="navbar">
        <div class="logo">
        <img src="imagenes/logo1.png" alt="Logo Delcampo">
    </div>
    <h2>Catálogo de Productos</h2>
    <nav>
        <a href="inicio.php">Inicio</a>
        <a href="eventos.php">Eventos</a>
    </nav>
</header>
<br>
    <div class="container mt-0">
        <h1 class="text-center mb-4">De las manos que cultivan con amor</h1>
        <div class="row">
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="login/imagenes_productos/<?= htmlspecialchars($row['imagen']) ?>" class="card-img-top" alt="Imagen del producto">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['descripcion']) ?></p>
                            <p class="card-text fw-bold">$<?= number_format($row['precio'], 0, ',', '.') ?></p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success w-100" onclick="mostrarVendedor(
                                '<?= htmlspecialchars($row['vendedor_nombre']) ?>',
                                '<?= htmlspecialchars($row['correo']) ?>',
                                '<?= htmlspecialchars($row['telefono']) ?>',
                                '<?= htmlspecialchars($row['direccion']) ?>'
                            )">
                                Hacer pedido
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal para mostrar la info del vendedor -->
    <div class="modal fade" id="vendedorModal" tabindex="-1" aria-labelledby="vendedorModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="vendedorModalLabel">Información del Vendedor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p><strong>Nombre:</strong> <span id="vendedorNombre"></span></p>
            <p><strong>Correo:</strong> <span id="vendedorCorreo"></span></p>
            <p><strong>Teléfono:</strong> <span id="vendedorTelefono"></span></p>
            <p><strong>Dirección:</strong> <span id="vendedorDireccion"></span></p>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarVendedor(nombre, correo, telefono, direccion) {
            document.getElementById('vendedorNombre').textContent = nombre;
            document.getElementById('vendedorCorreo').textContent = correo;
            document.getElementById('vendedorTelefono').textContent = telefono;
            document.getElementById('vendedorDireccion').textContent = direccion;

            var modal = new bootstrap.Modal(document.getElementById('vendedorModal'));
            modal.show();
        }
    </script>
</body>
</html>
