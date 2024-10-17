<?php
include 'config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de pedidos - Gallesistema</title>
</head>
<body>
    <h1>Lista de Pedidos</h1>
    <a href="index.html">Menu</a>
    <?php 
    // Consulta para obtener la información de los pedidos, clientes y galletitas
    $sql = "
    SELECT 
        g.ID AS ID_Galles,
        p.ID AS ID_Pedido, 
        c.Nombre AS Nombre_Cliente, 
        c.Apellido AS Apellido_Cliente,
        DATE_FORMAT(p.Fecha, '%d/%m/%y') AS Fecha_Pedido,
        p.Cantidad_Pallets AS Cantidad_Pallets, 
        g.Etapa_Chequeo AS Etapa_Chequeo, 
        g.Estado AS Estado_Galletita,
        DATE_FORMAT(g.Hora_Chequeo, '%d/%m/%y %H:%i') AS Hora_Chequeo
    FROM Pedidos p
    JOIN Clientes c ON p.ID_Cliente = c.ID
    JOIN Galletitas g ON p.ID = g.ID_Pedido
    ORDER BY ID_Pedido;
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID Pedido</th>
                    <th>Nombre del Cliente</th>
                    <th>Pallets</th>
                    <th>Fecha del Pedido</th>
                    <th>Etapa de Chequeo</th>
                    <th>Ultimo Chequeo</th>
                    <th>Estado de la Galletita</th>
                    <th></th>
                </tr>";
        
        // Recorrer los resultados y mostrar cada fila
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ID_Pedido"] . "</td>
                    <td>" . $row["Nombre_Cliente"] . " " . $row["Apellido_Cliente"] . "</td>
                    <td>" . $row["Cantidad_Pallets"] . "</td>
                    <td>" . $row["Fecha_Pedido"] . "</td>
                    <td>" . $row["Etapa_Chequeo"] . "</td>
                    <td>" . $row["Hora_Chequeo"] . "</td>
                    <td>" . $row["Estado_Galletita"] . "</td>
                    <td><a href='forms/Chequeo_galles.php?id=" . $row["ID_Galles"] . "'>Chequeo de Galletitas</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron pedidos.</p>";
    }
    
    // Cerrar la conexión
    $conn->close();
    ?>
    </body>
</html>
