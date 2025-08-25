<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/favi.png" type="image/png">
    <title>Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/diseño1.css">
    
<body>
    <header class="navbar">
        <nav>
             <a href="inicio.php">Inicio</a>
            <a href="eventos.php">Eventos</a>
            <a href="catalogo.php">Catálogo</a>
            <a href="login/index.php">Iniciar sesión</a>
            <a href="registro.php">Registrarse</a>
        </nav>
        <div class="logo">
      <img src="imagenes/logo1.png" alt="Logo Delcampo">
    </div>

    </header>

<style>
    body {
      background: #f5f5f5; /* gris claro */
      font-family: Arial, sans-serif;
    }
    h1 {
      color: #2e7d32; /* verde principal */
      font-weight: bold;
    }
    .btn-inicio {
      background-color: #ff9800; /* naranja */
      border: none;
    }
    .btn-inicio:hover {
      background-color: #e68900; /* naranja más oscuro */
    }
    .evento-card img, .evento-card video {
      object-fit: cover;
      height: 250px;
      border-radius: 12px;
    }
    .evento-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: 2px solid #c8e6c9; /* borde verde suave */
    }
    .evento-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .card-title {
      color: #f57f17; /* amarillo oscuro */
      font-weight: bold;
    }
    .card-text {
      color: #555; /* gris suave */
    }
  </style>
</head>
<body class="p-4">
    
  <div class="container">
    <!-- Título -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>
        <i class="fas fa-seedling"></i> Eventos y Promociones
      </h1>
    </div>
 

    <!-- Galería de eventos -->
    <div class="row g-4">
      <!-- Evento con imagen -->
       
      <div class="col-md-4">
        <div class="card evento-card">
          <img src="imagenes/campo.jpg" class="card-img-top" alt="Promoción 1">
          <div class="card-body text-center">
            <h5 class="card-title">Promoción de la Cosecha</h5>
            <p class="card-text">Frutas frescas con 30% de descuento.</p>
          </div>
        </div>
      </div>

      <!-- Evento con video -->
      <div class="col-md-4">
        <div class="card evento-card">
          <video controls class="w-100">
            <source src="videos/evento2.mp4" type="video/mp4">
            Tu navegador no soporta el video.
          </video>
          <div class="card-body text-center">
            <h5 class="card-title">Feria Campesina</h5>
            <p class="card-text">Mira lo mejor de nuestra feria en este video.</p>
          </div>
        </div>
      </div>

      <!-- Evento con video de YouTube -->
      <div class="col-md-4">
        <div class="card evento-card">
          <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/VIDEO_ID" title="YouTube video" allowfullscreen></iframe>
          </div>
          <div class="card-body text-center">
            <h5 class="card-title">Conferencia sobre Agricultura</h5>
            <p class="card-text">Revive nuestra charla online.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>