<?php
$Cantidad_Pallets = $_POST["Cantidad_Pallets"];
$ID_Cliente = $_POST["ID_Cliente"];

require_once "../config/config.php";

$sql = "INSERT INTO pedidos (Cantidad_Pallets, ID_Cliente, Fecha) VALUES ($Cantidad_Pallets, $ID_Cliente, CURDATE());";
$result = $conn->query($sql);

if($result){
    header("Location: ../MenuPedidos.html");
    exit();
}else{
    echo"Contactarse con la gente de TengononiSistemas";
}