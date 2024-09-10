<?php
$servername = "localhost";
$username = "root";
$password = "";  // Cambia si tienes una contraseña
$dbname = "BalinesMojados";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
