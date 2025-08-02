
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - Del Campo</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">


</head>
<body>


  <div class="login-box">
    <div class="text-center mb-4">
      <img src="../imagenes/manos.png" class="icon-top" alt="icono planta"  />
      <h2 class="login-title">Del Campo 🌿</h2>
      <p class="text-muted"> a La Mesa, de las manos que cultivan con Amor </p>
    </div>

    <!-- Mensaje de error -->
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>

    <form action="validar.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Correo Electronico</label>
        <input type="text" name="correo" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="contrasena" class="form-control" required>
      </div>
      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-login">
          <i class="fas fa-leaf me-1"></i> Ingresar
        </button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
