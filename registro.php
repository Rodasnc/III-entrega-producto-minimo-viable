<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="imagenes/favi.png" type="image/png">
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/diseño1.css">
</head>
<body>

  <header class="navbar">
    <nav>
      <a href="inicio.php">Inicio</a>
      <a href="eventos.php">Eventos</a>
      <a href="catalogo.php">Catálogo</a>
    </nav>
    <div class="logo">
      <img src="imagenes/logo1.png" alt="Logo Delcampo">
    </div>
  </header>

  <h1 class="registro-title">Registro de Vendedores</h1>

  <div class="registro-box">
    <form action="procesar_registro.php" method="post" onsubmit="return validarFormulario()">
      <label for="nombre">Nombre y apellido:</label>
      <input type="text" name="nombre" id="nombre" required><br>

      <label for="correo">Correo:</label>
      <input type="email" name="correo" required><br>

      <label for="contraseña">Contraseña:</label>
      <input type="text" name="contraseña" required><br>

      <label for="telefono">Teléfono:</label>
      <input type="text" name="telefono" id="telefono" required><br>

      <label for="direccion">Dirección:</label>
      <input type="text" name="direccion" required><br>

      <button type="submit" class="btn-registrar">Registrar</button>
    </form>
  </div>

  <!-- Modal de confirmación -->
  <div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalExitoLabel">Registro exitoso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          ¡Gracias por registrarse! Ya puede iniciar sesión con su correo y contraseña.
        </div>
        <div class="modal-footer">
          <a href="login/index.php" class="btn btn-primary">Iniciar sesión</a>
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ Validación al enviar el formulario -->
  <script>
    function validarFormulario() {
      const nombre = document.getElementById("nombre").value.trim();
      const telefono = document.getElementById("telefono").value.trim();

      const soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
      const soloNumeros = /^[0-9]+$/;

      if (!soloLetras.test(nombre)) {
        alert("El campo 'Nombre y apellido' solo debe contener letras y espacios.");
        return false;
      }

      if (!soloNumeros.test(telefono)) {
        alert("El campo 'Teléfono' solo debe contener números.");
        return false;
      }

      return true;
    }
  </script>

  <!-- ✅ Validación mientras se escribe -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const campoNombre = document.getElementById("nombre");
      const campoTelefono = document.getElementById("telefono");

      campoNombre.addEventListener("keypress", function (e) {
        const letra = String.fromCharCode(e.keyCode || e.which);
        const soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

        if (!soloLetras.test(letra)) {
          e.preventDefault(); // Bloquea teclas inválidas
        }
      });

      campoTelefono.addEventListener("keypress", function (e) {
        const numero = String.fromCharCode(e.keyCode || e.which);
        if (!/[0-9]/.test(numero)) {
          e.preventDefault(); // Bloquea letras en teléfono
        }
      });
    });
  </script>

  <!-- Script para mostrar el modal si el registro fue exitoso -->
  <script>
    window.addEventListener('DOMContentLoaded', function () {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get('registro') === 'exitoso') {
        const modalExito = new bootstrap.Modal(document.getElementById('modalExito'));
        modalExito.show();
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .modal.fade.show {
      opacity: 1 !important;
      visibility: visible !important;
      z-index: 1055 !important;
    }

    .modal-backdrop.show {
      z-index: 1050 !important;
      opacity: 0.5 !important;
    }

    .navbar,
    .registro-box,
    form {
      position: relative;
      z-index: 1;
    }
  </style>

</body>
</html>
