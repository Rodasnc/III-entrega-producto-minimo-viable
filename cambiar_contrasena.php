<?php
require_once 'login/includes/conexion.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de vendedor no proporcionado.");
}

$id = intval($_GET['id']);
$mensaje = "";

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nueva_contrasena = $_POST['nueva_contrasena'];

    if (strlen($nueva_contrasena) < 6) {
        $mensaje = "⚠️ La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Encriptar contraseña
        $contrasena_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

        // Actualizar en BD
        $stmt = $conn->prepare("UPDATE vendedores SET contrasena = ? WHERE id = ?");
        $stmt->bind_param("si", $contrasena_hash, $id);

        if ($stmt->execute()) {
            $mensaje = "✅ Contraseña actualizada correctamente.";
        } else {
            $mensaje = "❌ Error al actualizar la contraseña.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cambiar Contraseña</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">

        <div class="card shadow-lg border-0">
          <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-key"></i> Cambiar Contraseña</h4>
          </div>
          <div class="card-body">

            <?php if (!empty($mensaje)): ?>
              <div class="alert alert-info text-center"><?= $mensaje ?></div>
            <?php endif; ?>

            <form method="post">
              <div class="mb-3">
                <label for="nueva_contrasena" class="form-label"><i class="fas fa-lock"></i> Nueva Contraseña</label>
                <div class="input-group">
                  <input type="password" id="nueva_contrasena" name="nueva_contrasena" class="form-control" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
                <small class="text-muted">Mínimo 6 caracteres</small>
              </div>

              <div class="d-flex justify-content-between">
                <a href="listar_vendedores.php" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Volver atrás
                </a>
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-save"></i> Guardar
                </button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById("nueva_contrasena");
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
