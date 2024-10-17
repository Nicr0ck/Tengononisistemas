<?php
include "../config/config.php";

// Aseguramos que el ID sea un entero
$ID = intval($_GET["id"]);

$sql = "SELECT 
    cam.ID AS ID_Camion, 
    cam.Localizacion AS Localizacion,
    cami.Nombre AS Nombre_Camionero, 
    cami.DNI AS DNI_Camionero
FROM Camiones cam
JOIN Camioneros cami ON cam.ID_Camionero = cami.ID
JOIN Entregas e ON cam.ID = e.ID_Camion
WHERE cam.ID = ?
ORDER BY ID_Camion";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();

// Verificamos si se encontró alguna fila
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $num = $row["ID_Camion"];
    $nombre = $row["Nombre_Camionero"];
    $localizacion = $row["Localizacion"];
} else {
    $num = "N/A";
    $nombre = "No se encontró información";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localizacion del Camion - Gallesistema</title>
</head>
<body>
    <h1>Localizacion del Camion</h1>
    <?php
    echo "
    <h3>Donde está el camión $num</h3>
    <div>Conductor: $nombre</div>    
    ";
    ?>
    <form action="../acciones/local_camion.php">
        <label for="Localizacion">Localizacion: </label>
        <?php
        echo"
        <input type='text' name='Localizacion' id='Localizacion' placeholder='$localizacion'>";
        ?>
        <button type="submit" class="btn">Actualizar localizacion</button>
    </form>
</body>
</html>
