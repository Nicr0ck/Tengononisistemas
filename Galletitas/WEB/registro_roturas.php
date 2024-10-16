<?php
include 'config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Roturas - Gallesistema</title>
</head>
<body>
    <h1>Registro de Roturas</h1>
    <a href="index.html">Menu</a>
    <?php 
    // Consulta para obtener la información de los pedidos, clientes y galletitas
    $sql = "
    SELECT 
        p.ID AS ID_Pedido, 
        c.Nombre AS Nombre_Cliente, 
        c.Apellido AS Apellido_Cliente,
        p.Cantidad_Pallets AS Cantidad_Pallets,
        DATE_FORMAT(r.Hora_Rotura, '%d/%m/%y %H:%i:%s') AS Hora_Rotura,
        r.Etapa_Rotura AS Etapa_Rotura
    FROM Roturas r
    JOIN Galletitas g ON r.ID_Galletitas = g.ID
    JOIN Pedidos p ON g.ID_Pedido = p.ID
    JOIN Clientes c ON p.ID_Cliente = c.ID
    ORDER BY ID_Pedido;
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID Pedido</th>
                    <th>Nombre del Cliente</th>
                    <th>Cantidad de Pallets</th>
                    <th>Fecha y Hora de Rotura</th>
                    <th>Etapa de Rotura</th>
                </tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ID_Pedido"] . "</td>
                    <td>" . $row["Nombre_Cliente"] . " " . $row["Apellido_Cliente"] . "</td>
                    <td>" . $row["Cantidad_Pallets"] . "</td>
                    <td>" . $row["Hora_Rotura"] . "</td>
                    <td>" . $row["Etapa_Rotura"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron roturas.</p>";
    }

    $conn->close();
    ?>
</body>
</html>