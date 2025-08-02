<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Del Campo a la Mesa</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/diseño1.css">

  <!-- Favicon -->
  <link rel="icon" href="imagenes/favi.png" type="image/png">
</head>

<body>

  <!-- NAVBAR -->
  <header class="navbar navbar-expand-lg navbar-light bg-light px-4 py-2">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <!-- LOGO -->
      <div class="logo">
        <img src="imagenes/logo1.png" alt="Logo Delcampo" height="50">
      </div>

      <!-- ENLACES DEL MENÚ -->
      <nav class="d-flex gap-3">
        <a class="nav-link" href="eventos.php">Eventos</a>
        <a class="nav-link" href="catalogo.php">Catálogo</a>
        <a class="nav-link" href="login/index.php">Iniciar sesión</a>
        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalTratamiento">Registrarse</a>
      </nav>
    </div>
  </header>

  <!-- CONTENIDO PRINCIPAL -->
  <section class="hero text-center py-5 bg-light">
    <div class="container">
      <h1>Bienvenidos a Del Campo a la Mesa</h1>
      <p>Conectando productos campesinos directamente contigo. Conoce nuestros eventos, catálogo y más.</p>
    </div>
  </section>

  <!-- MODAL DE TRATAMIENTO DE DATOS -->
  <div class="modal fade" id="modalTratamiento" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Tratamiento de datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <p>¿Acepta el tratamiento de sus datos personales según nuestra 
            <a href="#" data-bs-toggle="modal" data-bs-target="#politicaModal" data-bs-dismiss="modal">política de privacidad</a>?
          </p>

          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="aceptaPolitica" onchange="toggleBotonAceptar()">
            <label class="form-check-label" for="aceptaPolitica">
              He leído y acepto la política de tratamiento de datos.
            </label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a href="registro.php" class="btn btn-primary disabled" id="btnAceptar">Aceptar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL CON EL PDF DE LA POLÍTICA -->
  <div class="modal fade" id="politicaModal" tabindex="-1" aria-labelledby="politicaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="politicaModalLabel">Política de tratamiento de datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body p-0" style="height:70vh;">
          <iframe src="docs/tratamientoDatos.pdf" width="100%" height="100%" style="border: none;"></iframe>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS y lógica de checkbox -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleBotonAceptar() {
      const checkbox = document.getElementById('aceptaPolitica');
      const boton = document.getElementById('btnAceptar');

      if (checkbox.checked) {
        boton.classList.remove('disabled');
      } else {
        boton.classList.add('disabled');
      }
    }
  </script>

</body>
</html>
