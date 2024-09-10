<?php
include 'config/config.php';

if (isset($_GET['rol'])) {    
    $rol = $_GET['rol'];
} else {
    die('No se realizo el inicio de sesion');
}
if (isset($_GET['sucursal_id'])) {
    $sucursal_id = $_GET['sucursal_id'];

    $sql = "SELECT Nombre FROM Sucursales WHERE ID = $sucursal_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_sucursal = $row['Nombre'];
    } else {
        die("Sucursal no encontrada.");
    }
} else {
    die("No se ha seleccionado una sucursal.");
}

$sql = "
    SELECT R.ID, T.fecha, T.hora_inicio, T.hora_fin, R.Num_Jugadores, R.Balas_Adicionales, R.Total, C.Nombre AS Nombre_Cliente
    FROM Reservas R
    JOIN Turnos T ON R.ID_turno = T.ID
    JOIN Canchas Ca ON T.ID_Cancha = Ca.ID
    JOIN Clientes C ON R.ID_Cliente = C.ID
    WHERE Ca.ID_Sucursal = $sucursal_id
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reservas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<h1>Reservas - <?php echo $nombre_sucursal; ?></h1>

<table border="1">
    <tr>
        <th>ID Reserva</th>
        <th>Fecha</th>
        <th>Hora de Inicio</th>
        <th>Hora de Fin</th>
        <th>Nombre del Cliente</th>
        <th>Número de Jugadores</th>
        <th>Balas Adicionales</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["fecha"] . "</td>";
            echo "<td>" . $row["hora_inicio"] . "</td>";
            echo "<td>" . $row["hora_fin"] . "</td>";
            echo "<td>" . $row["Nombre_Cliente"] . "</td>";
            echo "<td>" . $row["Num_Jugadores"] . "</td>";
            echo "<td>" . $row["Balas_Adicionales"] . "</td>";
            echo "<td><a href='editar_reservas.php?sucursal_id=" . $sucursal_id . "&id=" . $row["ID"] . "&rol=" . $rol . "'>Editar</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay reservas disponibles</td></tr>";
    }
    ?>
</table>

<a href="menu_sistema.php?sucursal_id=<?php echo $sucursal_id; ?>&rol=<?php echo $rol; ?>">Volver al Menú</a>

<?php
// Cerrar la conexión
$conn->close();
?>

</body>
</html>
