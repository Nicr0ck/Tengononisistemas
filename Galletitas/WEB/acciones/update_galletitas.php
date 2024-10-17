<?php
require_once "../config/config.php";

$etapa = mysqli_real_escape_string($conn, $_POST["Etapa"]);
$estado = mysqli_real_escape_string($conn, $_POST["Estado"]);
$ID = intval($_GET["id"]);
if (!empty($etapa) && !empty($estado) && !empty($ID)) {
    $sql = "UPDATE galletitas 
            SET Estado = '$estado', Etapa_Chequeo = '$etapa', Hora_Chequeo = NOW() 
            WHERE ID = $ID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../Lista_Galles.php");
    exit();
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
} else {
    echo "Error: Los datos proporcionados están vacíos o no son válidos.";
    echo "<br>Etapa: " . $etapa;
    echo "<br>Estado: " . $estado;
    echo "<br>ID: " . $ID;
}

$conn->close();
