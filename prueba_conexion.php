<?php
$mysqli = new mysqli("localhost", "root", "", "rotiseria");

if ($mysqli->connect_errno) {
    die("❌ Error de conexión: " . $mysqli->connect_error);
}
echo "✅ Conexión exitosa a la base de datos.";
?>
