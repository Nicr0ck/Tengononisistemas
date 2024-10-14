<?php
include 'config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Camiones - Gallesistema</title>
</head>
<body>
    <h1>Registro de Camiones</h1>
    <?php 
    $sql = "
    SELECT 
        cam.ID AS ID_Camion, 
        cam.Localizacion AS Localizacion, 
        DATE_FORMAT(cam.Hora, '%d/%m/%y %H:%i:%s') AS Hora,
        cami.Nombre AS Nombre_Camionero, 
        cami.DNI AS DNI_Camionero,
        e.ID_Pedido AS ID_Pedido
    FROM Camiones cam
    JOIN Camioneros cami ON cam.ID_Camionero = cami.ID
    JOIN Entregas e ON cam.ID = e.ID_Camion
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID Camión</th>
                    <th>Localización</th>
                    <th>Ult vez</th>
                    <th>Nombre del Camionero</th>
                    <th>DNI del Camionero</th>
                    <th>ID del Pedido</th>
                </tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ID_Camion"] . "</td>
                    <td>" . $row["Localizacion"] . "</td>
                    <td>" . $row["Hora"] . "</td>
                    <td>" . $row["Nombre_Camionero"] . "</td>
                    <td>" . $row["DNI_Camionero"] . "</td>
                    <td>" . $row["ID_Pedido"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron registros de camiones.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
