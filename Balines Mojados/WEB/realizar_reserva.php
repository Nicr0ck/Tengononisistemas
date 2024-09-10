<?php
include 'config/config.php';

if (isset($_GET['rol'])) {    
    $rol = $_GET['rol'];
} else {
    die('No se realizo el inicio de sesion');
}
if (isset($_GET['sucursal_id'])) {
    $sucursal_id = $_GET['sucursal_id'];

    // Consultar el nombre de la sucursal
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

$sql_canchas = "SELECT ID, Nombre FROM Canchas WHERE ID_Sucursal = $sucursal_id";
$result_canchas = $conn->query($sql_canchas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<h1>Realizar Reserva - <?php echo $nombre_sucursal; ?></h1>

<form action="acciones/guardar_reserva.php?rol=<?php echo $rol; ?>" method="post">
    <label for="cancha">Seleccione una cancha:</label>
    <select name="cancha" id="cancha" required>
        <?php
        if ($result_canchas->num_rows > 0) {
            while ($row = $result_canchas->fetch_assoc()) {
                echo "<option value='" . $row["ID"] . "'>" . $row["Nombre"] . "</option>";
            }
        } else {
            echo "<option>No hay canchas disponibles</option>";
        }
        ?>
    </select><br><br>

    <label for="fecha">Seleccione una fecha:</label>
    <input type="date" name="fecha" id="fecha" required><br><br>

    <label for="hora_inicio">Seleccione una hora de inicio:</label>
    <select name="hora_inicio" id="hora_inicio" required>
        <?php
        $hora_inicio = new DateTime('08:00');
        while ($hora_inicio->format('H:i') !== '02:00') {
            $hora_fin = clone $hora_inicio;
            $hora_fin->add(new DateInterval('PT1H'));
            echo "<option value='" . $hora_inicio->format('H:i') . "'>" . $hora_inicio->format('h:i A') . " - " . $hora_fin->format('h:i A') . "</option>";
            $hora_inicio->add(new DateInterval('PT1H'));
        }
        ?>
    </select><br><br>

    <label for="num_jugadores">Número de Jugadores:</label>
    <input type="number" name="num_jugadores" id="num_jugadores" required><br><br>

    <label for="balas_adicionales">Balas Adicionales:</label>
    <select name="balas_adicionales" id="balas_adicionales">
        <option value="0">0</option>
        <option value="50">50</option>
        <option value="150">150</option>
        <option value="200">200</option>
        <option value="250">250</option>
        <option value="500">500</option>
    </select><br><br>

    <h2>Datos del Cliente:</h2>

    <label for="nombre_cliente">Nombre:</label>
    <input type="text" name="nombre_cliente" id="nombre_cliente" required><br><br>

    <label for="empresa">¿Representa a una empresa?:</label>
    <select name="empresa" id="empresa" required>
        <option value="0">No</option>
        <option value="1">Sí</option>
    </select><br><br>

    <label for="telefono_cliente">Teléfono:</label>
    <input type="text" name="telefono_cliente" id="telefono_cliente" required><br><br>

    <label for="email_cliente">Email:</label>
    <input type="email" name="email_cliente" id="email_cliente" required><br><br>

    <input type="hidden" name="sucursal_id" value="<?php echo $sucursal_id; ?>">
    <input type="submit" value="Realizar Reserva">
</form>

<a href="menu_sistema.php?sucursal_id=<?php echo $sucursal_id; ?>&rol=<?php echo $rol; ?>">Volver al Menú</a>

<?php $conn->close(); ?>

</body>
</html>

