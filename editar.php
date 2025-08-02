<?php
require_once 'login/includes/conexion.php';



$id = $_GET['id'];

// Consultar datos del vendedor
$sql = "SELECT * FROM vendedores WHERE id = $id";
$resultado = $conn->query($sql);

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

    // Actualizar los datos
    $sql_update = "UPDATE vendedores SET nombre='$nombre', correo='$correo', telefono='$telefono', direccion='$direccion' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        header("Location: listar.php");
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
</head>
<body class="p-4">
  <h1>Editar Vendedor</h1>

  <form method="POST">
    <div class="mb-3">
      <label>Nombre:</label>
      <input type="text" name="nombre" class="form-control" value="<?php echo $vendedor['nombre']; ?>" required>
    </div>

    <div class="mb-3">
      <label>Correo:</label>
      <input type="email" name="correo" class="form-control" value="<?php echo $vendedor['correo']; ?>" required>
    </div>

    <div class="mb-3">
      <label>Teléfono:</label>
      <input type="text" name="telefono" class="form-control" value="<?php echo $vendedor['telefono']; ?>" required>
    </div>

    <div class="mb-3">
      <label>Dirección:</label>
      <input type="text" name="direccion" class="form-control" value="<?php echo $vendedor['direccion']; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
