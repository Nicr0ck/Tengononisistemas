<?php
require_once "../config/config.php";

$sql = "INSERT INTO camiones (Localizacion, Hora) VALUES ('Fábrica',NOW())";
$result = $conn->query($sql);

if($result){
    header("Location: ../forms/AsignarCamion.php");
    exit();
}else{
    echo"Contactarse con la gente de TengononiSistemas";
}