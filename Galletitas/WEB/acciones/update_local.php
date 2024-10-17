<?php
require_once "../config/config.php";

$ID = intval($_GET["id"]);
$localizacion = mysqli_real_escape_string($conn, $_POST["Localizacion"]);

if (!empty($localizacion)) {
    $sql = "UPDATE camiones 
            SET Localizacion = '$localizacion', Hora = NOW() 
            WHERE ID = $ID";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../registro_camiones.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
} else {
    echo "Error: Los datos proporcionados están vacíos o no son válidos.";
}
$conn->close();
?>
