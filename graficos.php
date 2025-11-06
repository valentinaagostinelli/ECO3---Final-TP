<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gráfico de votos - BifeConJuguito</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: Arial;
      background-color: #f3f3f3;
      text-align: center;
      padding: 30px;
    }
    canvas {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      margin-top: 20px;
      max-width: 600px;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    a:hover { background-color: #0056b3; }
  </style>
</head>
<body>

  <h2>Resultados de la votación</h2>
  <canvas id="grafico" width="600" height="300"></canvas>

  <?php
  // Conexión a la base de datos
  $conexion = mysqli_connect(
    "sql207.infinityfree.com",
    "if0_40332512",
    "Bifeconjuguito",
    "if0_40332512_bifeconjuguito"
  );

  if (!$conexion) {
    echo "<p style='color:red;'>Error al conectar: " . mysqli_connect_error() . "</p>";
    exit;
  }

  // Traer los datos
  $resultado = mysqli_query($conexion, "SELECT nombre, votos FROM combos");
  $labels = [];
  $data = [];

  while ($fila = mysqli_fetch_assoc($resultado)) {
    $labels[] = utf8_encode($fila["nombre"]);
    $data[] = (int)$fila["votos"];
  }

  mysqli_close($conexion);
  ?>

  <script>
    const etiquetas = <?php echo json_encode($labels, JSON_UNESCAPED_UNICODE); ?>;
    const datos = <?php echo json_encode($data); ?>;

    console.log("Etiquetas:", etiquetas);
    console.log("Datos:", datos);

    const ctx = document.getElementById('grafico').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: etiquetas,
        datasets: [{
          label: 'Cantidad de votos',
          data: datos,
          backgroundColor: [
            '#f44336', '#2196f3', '#4caf50', '#ff9800', '#9c27b0', '#607d8b'
          ]
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
      }
    });
  </script>

  <a href="formulario.php">⬅Volver al formulario</a>

</body>
</html>
