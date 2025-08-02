<?php
require_once 'login/includes/conexion.php'; // Asegúrate de que este archivo define $conn

$sql = "SELECT * FROM vendedores";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Vendedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Listado de Vendedores</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $fila['id'] ?></td>
                <td><?= $fila['nombre'] ?></td>
                <td><?= $fila['correo'] ?></td>
                <td><?= $fila['telefono'] ?></td>
                <td><?= $fila['direccion'] ?></td>
                <td>
                    <a href="editar_vendedor.php?id=<?= $fila['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="eliminar_vendedor.php?id=<?= $fila['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás segura que deseas eliminar este registro?')">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
