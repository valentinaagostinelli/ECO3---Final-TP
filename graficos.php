<?php
$host = "sql207.infinityfree.com";
$user = "if0_40332512";
$pass = "Bifeconjuguito";
$db   = "if0_40332512_bifeconjuguito"; 


$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    if (isset($_GET['datos'])) {
        header('Content-Type: application/json; charset=utf-8', true, 500);
        echo json_encode(['error' => 'Error de conexión: ' . $mysqli->connect_error]);
        exit;
    } else {
        die("Error de conexión: " . $mysqli->connect_error);
    }
}

if (isset($_GET['datos'])) {
    $res = $mysqli->query("SELECT nombre, votos FROM combos ORDER BY id");
    $labels = [];
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $labels[] = $row['nombre'];
        $data[] = (int)$row['votos'];
    }
    $res->close();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['labels' => $labels, 'data' => $data]);
    $mysqli->close();
    exit;
}

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Resultados - BifeConJuguito</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:Arial,Helvetica,sans-serif;max-width:900px;margin:30px auto;padding:10px;}
    .topbar{display:flex;gap:8px;align-items:center;margin-bottom:10px;}
    .btn{display:inline-block;padding:8px 12px;background:#007bff;color:#fff;border-radius:6px;text-decoration:none;}
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="topbar">
    <h1 style="margin:0">Resultados de la encuesta</h1>
    <a class="btn" href="https://bifeconjuguito.gt.tc/formulario.php" style="margin-left:auto">Volver a la encuesta</a>
  </div>

  <canvas id="miGrafico" width="800" height="400"></canvas>

  <script>
    async function fetchDatos() {
      const resp = await fetch('graficos.php?datos=1');
      if (!resp.ok) throw new Error('Error al pedir los datos');
      return await resp.json();
    }

    async function dibujar() {
      try {
        const json = await fetchDatos();
        const labels = json.labels || [];
        const data = json.data || [];

        const ctx = document.getElementById('miGrafico').getContext('2d');

        if (window.miChart) {
          window.miChart.destroy();
        }

        window.miChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Votos',
              data: data,
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                ticks: { precision:0 }
              }
            },
            plugins: {
              legend: { display: false }
            }
          }
        });

      } catch (e) {
        console.error(e);
        document.body.insertAdjacentHTML('beforeend', '<p style="color:red">No se pudieron cargar los datos.</p>');
      }
    }

    dibujar();

  </script>
</body>
</html>
