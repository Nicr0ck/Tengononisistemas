<?php
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$telefono = $_POST["telefono"];
$localidad = $_POST["localidad"];
$direccion = $_POST["direccion"];

require_once "../config/config.php";

$sql = "INSERT INTO clientes (nombre, apellido, telefono, localidad, direccion) VALUES ('$nombre', '$apellido', '$telefono', '$localidad', '$direccion');";
$result = $conn->query($sql);

if($result){
    header("Location: ../MenuPedidos.html");
    exit();
}else{
    echo"Contactarse con la gente de TengononiSistemas";
}