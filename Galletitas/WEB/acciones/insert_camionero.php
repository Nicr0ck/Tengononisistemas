<?php
$nombre = $_POST["nombre"];
$DNI = $_POST["DNI"];
require_once "../config/config.php";

$sql = "INSERT INTO camioneros (nombre, DNI) VALUES ('$nombre', '$DNI');";
$result = $conn->query($sql);

if($result){
    header("Location: ../forms/asignarCamion.php");
    exit();
}else{
    echo"Contactarse con la gente de TengononiSistemas";
}