<?php
// Incluir el archivo de conexión a la base de datos
include 'config/config.php';

if (isset($_GET['rol'])) {    
    $rol = $_GET['rol'];
} else {
    die('No se realizo el inicio de sesion');
}

if (isset($_GET['sucursal_id'])) {
    $sucursal_id = $_GET['sucursal_id'];
} else {
    die('No se ha seleccionado la sucursal.');
}

if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];
} else {
    die("No se ha seleccionado una reserva.");
}

// Obtener los datos actuales de la reserva
$sql = "
    SELECT R.ID, R.ID_Turno, R.Num_Jugadores, R.Balas_Adicionales, C.Nombre AS Nombre_Cliente, C.Empresa, C.Telefono, C.Email, T.ID_Cancha, T.fecha, T.hora_inicio
    FROM Reservas R
    JOIN Turnos T ON R.ID_Turno = T.ID
    JOIN Clientes C ON R.ID_Cliente = C.ID
    WHERE R.ID = $reserva_id
";
$result = $conn->query($sql);
$reserva = $result->fetch_assoc();

// Verificar si se encontró la reserva
if (!$reserva) {
    die("Reserva no encontrada.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
</head>
<body>

<h1>Editar Reserva</h1>

<form action="acciones/alter_reserva.php?sucursal_id=<?php echo $_GET['sucursal_id'] . "&rol=".$rol .""; ?>" method="POST">
    <input type="hidden" name="reserva_id" value="<?php echo $reserva['ID']; ?>">
    <input type="hidden" name="sucursal_id" value="<?php echo $sucursal_id; ?>">

    <label for="cancha">Cancha:</label>
    <select name="cancha" id="cancha" required>
        <?php
        // Obtener las canchas disponibles
        $sql_canchas = "SELECT ID, Nombre FROM Canchas WHERE ID_Sucursal = $sucursal_id";
        $result_canchas = $conn->query($sql_canchas);
        while ($cancha = $result_canchas->fetch_assoc()) {
            $selected = ($cancha['ID'] == $reserva['ID_Cancha']) ? 'selected' : '';
            echo "<option value='{$cancha['ID']}' $selected>{$cancha['Nombre']}</option>";
        }
        ?>
    </select><br>

    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" value="<?php echo $reserva['fecha']; ?>" required><br>

    <label for="hora_inicio">Hora de Inicio:</label>
    <select name="hora_inicio" id="hora_inicio" required>
        <?php
        for ($hora = 8; $hora <= 23; $hora++) {
            $hora_formateada = sprintf("%02d:00", $hora);
            $selected = ($hora_formateada == $reserva['hora_inicio']) ? 'selected' : '';
            echo "<option value='$hora_formateada' $selected>$hora_formateada</option>";
        }
        ?>
    </select><br>

    <label for="num_jugadores">Número de Jugadores:</label>
    <input type="number" name="num_jugadores" id="num_jugadores" value="<?php echo $reserva['Num_Jugadores']; ?>" required><br>

    <label for="balas_adicionales">Balas Adicionales:</label>
    <select name="balas_adicionales" id="balas_adicionales" required>
        <?php
        $balas_options = [0,50, 150, 200, 250, 500];
        foreach ($balas_options as $balas) {
            $selected = ($balas == $reserva['Balas_Adicionales']) ? 'selected' : '';
            echo "<option value='$balas' $selected>$balas</option>";
        }
        ?>
    </select><br>

    <h3>Datos del Cliente</h3>
    
    <label for="nombre_cliente">Nombre del Cliente:</label>
    <input type="text" name="nombre_cliente" id="nombre_cliente" value="<?php echo $reserva['Nombre_Cliente']; ?>" required><br>

    <label for="empresa">Es Empresa:</label>
    <select name="empresa" id="empresa">
        <option value="1" <?php echo ($reserva['Empresa'] == 1) ? 'selected' : ''; ?>>Sí</option>
        <option value="0" <?php echo ($reserva['Empresa'] == 0) ? 'selected' : ''; ?>>No</option>
    </select><br>

    <label for="telefono_cliente">Teléfono del Cliente:</label>
    <input type="text" name="telefono_cliente" id="telefono_cliente" value="<?php echo $reserva['Telefono']; ?>" required><br>

    <label for="email_cliente">Email del Cliente:</label>
    <input type="email" name="email_cliente" id="email_cliente" value="<?php echo $reserva['Email']; ?>" required><br>

    <input type="submit" value="Guardar Cambios">
</form>

<a href="ver_reservas.php?sucursal_id=<?php echo $_GET['sucursal_id'] . "&rol=".$rol .""; ?>">Volver a Ver Reservas</a>

<?php
$conn->close();
?>

</body>
</html>
