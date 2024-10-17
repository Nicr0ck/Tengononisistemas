<?php
require_once "../config/config.php";

$ID = intval($_POST["ID"]);
$ID_Camion = intval($_POST["ID_Camion"]);
$ID_Camionero = intval($_POST["ID_Camionero"]);
if (!empty($ID) && !empty($ID_Camion) && !empty($ID_Camionero)) {
    $sql = "UPDATE Entregas 
            SET ID_Camion = '$ID_Camion' 
            WHERE ID = $ID";
            echo"$sql";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE Camiones
            SET ID_Camionero = '$ID_Camionero' 
            WHERE ID = $ID_Camion";
            echo"$sql";
            if ($conn->query($sql) === TRUE) {
                header("Location: ../registro_camiones.php");
                exit();
                }
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
?>
