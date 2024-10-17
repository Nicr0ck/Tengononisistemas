<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Entregas - Gallesistema</title>
</head>
<body>
    <h1>Registro de Entregas</h1>
    <a href="index.html">Menu</a>
    <?php
require_once "config/config.php";

$sql = "
    SELECT 
        e.ID as ID_Entrega, 
        p.ID as ID_Pedido, 
        c.Nombre, 
        c.Apellido, 
        p.Cantidad_Pallets, 
        CONCAT('Camion ', e.ID_Camion) as Camion, 
        e.Hora_Salida, 
        e.Hora_Entrega, 
        e.Comentarios_Cliente, 
        e.Devolucion 
    FROM Entregas e
    INNER JOIN Pedidos p ON e.ID_Pedido = p.ID
    INNER JOIN Clientes c ON p.ID_Cliente = c.ID
    INNER JOIN Camiones cam ON e.ID_Camion = cam.ID
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID Entrega</th>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Cantidad de Pallets</th>
                <th>Camion</th>
                <th>Hora de Salida</th>
                <th>Hora de Entrega</th>
                <th>Comentario del Cliente</th>
                <th>Devuelto</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        $hora_entrega = empty($row['Hora_Entrega']) ? "En camino" : $row['Hora_Entrega'];

        if (empty($row['Comentarios_Cliente']) && !empty($row['Hora_Entrega'])) {
            $comentario_cliente = "<a href='forms/Comentario_Cliente.php?id={$row['ID_Entrega']}'>Agregar Comentario</a>";
        } else {
            $comentario_cliente = $row['Comentarios_Cliente'];
        }
        
        echo "<tr>
                <td>{$row['ID_Entrega']}</td>
                <td>{$row['ID_Pedido']}</td>
                <td>{$row['Nombre']} {$row['Apellido']}</td>
                <td>{$row['Cantidad_Pallets']}</td>
                <td>{$row['Camion']}</td>
                <td>{$row['Hora_Salida']}</td>
                <td>{$hora_entrega}</td>
                <td>{$comentario_cliente}</td>
                <td>" . ($row['Devolucion'] ? 'Sí' : 'No') . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron entregas.";
}

$conn->close();
?>


</body>
</html>