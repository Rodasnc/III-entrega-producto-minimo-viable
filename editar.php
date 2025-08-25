<?php
require_once 'login/includes/conexion.php';

// Validar ID recibido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}
$id = intval($_GET['id']);

// Consultar datos del vendedor
$stmt = $conn->prepare("SELECT * FROM vendedores WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $vendedor = $resultado->fetch_assoc();
} else {
    echo "Vendedor no encontrado.";
    exit();
}

// Si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $stmt_update = $conn->prepare("UPDATE vendedores 
                                   SET nombre=?, correo=?, telefono=?, direccion=? 
                                   WHERE id=?");
    $stmt_update->bind_param("ssssi", $nombre, $correo, $telefono, $direccion, $id);

    if ($stmt_update->execute()) {
        header("Location: listar_vendedores.php?mensaje=actualizado");
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Vendedor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card shadow-lg border-0">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-edit"></i> Editar Vendedor</h4>
          </div>
          <div class="card-body">
            <form method="POST">

              <div class="mb-3">
                <label class="form-label"><i class="fas fa-user"></i> Nombre</label>
                <input type="text" name="nombre" class="form-control" 
                       value="<?= htmlspecialchars($vendedor['nombre']) ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="fas fa-envelope"></i> Correo</label>
                <input type="email" name="correo" class="form-control" 
                       value="<?= htmlspecialchars($vendedor['correo']) ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="fas fa-phone"></i> Teléfono</label>
                <input type="text" name="telefono" class="form-control" 
                       value="<?= htmlspecialchars($vendedor['telefono']) ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="fas fa-home"></i> Dirección</label>
                <input type="text" name="direccion" class="form-control" 
                       value="<?= htmlspecialchars($vendedor['direccion']) ?>" required>
              </div>

              <div class="d-flex justify-content-between">
                <a href="listar_vendedores.php" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-save"></i> Guardar cambios
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>
