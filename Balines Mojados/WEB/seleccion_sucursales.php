<?php
include 'config/config.php';
$sql = "SELECT ID, Nombre FROM Sucursales";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Sucursal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<h1>Seleccionar Sucursal</h1>

<form action="acciones/procesar_sucursal.php" method="post">
    <label for="sucursal">Elija una sucursal:</label>
    <select name="sucursal" id="sucursal" required>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["ID"] . "'>" . $row["Nombre"] . "</option>";
            }
        } else {
            echo "<option>No hay sucursales disponibles</option>";
        }
        ?>
    </select>
    <br><br>
    <input type="submit" value="Seleccionar Sucursal">
</form>

<?php $conn->close(); ?>

</body>
</html>