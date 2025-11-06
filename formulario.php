<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>BifeConJuguito - Votar combo</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f2f2f2;
    }
    h2 {
      text-align: center;
    }
    form {
      background-color: white;
      width: 300px;
      margin: 40px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 5px gray;
    }
    label {
      display: block;
      margin: 8px 0;
    }
    button, a {
      display: inline-block;
      margin-top: 10px;
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
      color: white;
    }
    button {
      background-color: #007bff;
      border: none;
    }
    a {
      background-color: #28a745;
    }
  </style>
</head>
<body>

  <h2> Votá tu combo favorito</h2>

  <?php
  // Conexión a la base
 $conexion = mysqli_connect("sql207.infinityfree.com", "if0_40332512", "Bifeconjuguito", "if0_40332512_bifeconjuguito");



  // Si se envió el formulario
  if (isset($_POST["combo"])) {
    $combo = $_POST["combo"];
    $sql = "UPDATE combos SET votos = votos + 1 WHERE id = $combo";
    mysqli_query($conexion, $sql);
    echo "<p style='text-align:center; color:green;'>¡Gracias! Tu voto fue registrado.</p>";
  }
  ?>

  <form method="post" action="formulario.php">
    <label><input type="radio" name="combo" value="1" required> Combo 1 - La Insuperable</label>
    <label><input type="radio" name="combo" value="2"> Combo 2 - La Finoli</label>
    <label><input type="radio" name="combo" value="3"> Combo 3 - La Pesada</label>
    <label><input type="radio" name="combo" value="4"> Combo 4 - Sopa de Tubo</label>
    <label><input type="radio" name="combo" value="5"> Combo 5 - El Patriota</label>
    <label><input type="radio" name="combo" value="6"> Combo 6 - Diablo Ácido</label>

    <button type="submit">Votar</button>
    <a href="https://bifeconjuguito.gt.tc/graficos.php">Ver gráfico</a>
  </form>

</body>
</html>
