<?php
require_once __DIR__ . '/login/includes/conexion.php'; // conexión a BD

// Consulta de vendedores
$sql = "SELECT id, nombre, correo, telefono, direccion FROM vendedores ORDER BY id DESC";
$resultado = $conn->query($sql);

// Verificación de error
if ($resultado === false) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="imagenes/favi.png" type="image/png">
  <title>Listado de Vendedores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
 
</head>

<body class="p-4 bg-light">
    
 <div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="text-primary mb-0">
    <i class="fas fa-users"></i> Listado de Vendedores
  </h1>
  <a href="inicio.php" class="btn btn-primary">
    <i class="fas fa-home"></i> Inicio
  </a>
</div>
        <table class="table table-hover align-middle">
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while($fila = $resultado->fetch_assoc()): ?>
              <tr>
                <td><?= $fila['id'] ?></td>
                <td><?= htmlspecialchars($fila['nombre']) ?></td>
                <td><?= htmlspecialchars($fila['correo']) ?></td>
                <td><?= htmlspecialchars($fila['telefono']) ?></td>
                <td><?= htmlspecialchars($fila['direccion']) ?></td>
                <td class="text-center">
                  <a href="editar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Editar
                  </a>
                  <a href="cambiar_contrasena.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-info">
                    <i class="fas fa-key"></i> Contraseña
                  </a>
                  <form action="eliminar_vendedor.php" method="POST" class="d-inline"
                        onsubmit="return confirm('¿Estás seguro de eliminar este vendedor?');">
                      <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                      <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Eliminar
                      </button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
