<?php
include '../config/config.php';

if (isset($_GET['rol'])) {    
    $rol = $_GET['rol'];
} else {
    die('No se realizo el inicio de sesion');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = $_POST['reserva_id'];
    $cancha_id = $_POST['cancha'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora_inicio'];
    $num_jugadores = $_POST['num_jugadores'];
    $balas_adicionales = $_POST['balas_adicionales'];

    $nombre_cliente = $_POST['nombre_cliente'];
    $empresa = $_POST['empresa'];
    $telefono_cliente = $_POST['telefono_cliente'];
    $email_cliente = $_POST['email_cliente'];

    $sql_update_cliente = "UPDATE Clientes C
                           JOIN Reservas R ON C.ID = R.ID_Cliente
                           SET C.Nombre = '$nombre_cliente', C.Empresa = $empresa, C.Telefono = '$telefono_cliente', C.Email = '$email_cliente'
                           WHERE R.ID = $reserva_id";
    $conn->query($sql_update_cliente);

    $hora_fin = date("H:i", strtotime($hora_inicio . " +1 hour"));
    $sql_update_turno = "UPDATE Turnos T
                         JOIN Reservas R ON T.ID = R.ID_Turno
                         SET T.ID_Cancha = $cancha_id, T.fecha = '$fecha', T.hora_inicio = '$hora_inicio', T.hora_fin = '$hora_fin'
                         WHERE R.ID = $reserva_id";
    $conn->query($sql_update_turno);

    $sql_update_reserva = "UPDATE Reservas
                           SET Num_Jugadores = $num_jugadores, Balas_Adicionales = $balas_adicionales
                           WHERE ID = $reserva_id";
    if ($conn->query($sql_update_reserva) === TRUE) {
        echo "Reserva actualizada con éxito.";
    } else {
        echo "Error al actualizar la reserva: " . $conn->error;
    }

    header("Location: ../ver_reservas.php?sucursal_id=" . $_POST['sucursal_id']."&rol=".$rol);
    exit();
}

$conn->close();
?>
<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reserva_id = $_POST['reserva_id'];
    $sucursal_id = $_POST['sucursal_id'];
    $cancha_id = $_POST['cancha'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora_inicio'];
    $num_jugadores = $_POST['num_jugadores'];
    $balas_adicionales = $_POST['balas_adicionales'];

    $nombre_cliente = $_POST['nombre_cliente'];
    $empresa = $_POST['empresa'];
    $telefono_cliente = $_POST['telefono_cliente'];
    $email_cliente = $_POST['email_cliente'];

    // Actualizar datos del cliente
    $sql_update_cliente = "UPDATE Clientes C
                           JOIN Reservas R ON C.ID = R.ID_Cliente
                           SET C.Nombre = ?, C.Empresa = ?, C.Telefono = ?, C.Email = ?
                           WHERE R.ID = ?";
    $stmt = $conn->prepare($sql_update_cliente);
    $stmt->bind_param("sissi", $nombre_cliente, $empresa, $telefono_cliente, $email_cliente, $reserva_id);
    $stmt->execute();

    // Actualizar datos del turno
    $hora_fin = date("H:i", strtotime($hora_inicio . " +1 hour"));
    $sql_update_turno = "UPDATE Turnos T
                         JOIN Reservas R ON T.ID = R.ID_Turno
                         SET T.ID_Cancha = ?, T.fecha = ?, T.hora_inicio = ?, T.hora_fin = ?
                         WHERE R.ID = ?";
    $stmt = $conn->prepare($sql_update_turno);
    $stmt->bind_param("isssi", $cancha_id, $fecha, $hora_inicio, $hora_fin, $reserva_id);
    $stmt->execute();

    // Actualizar datos de la reserva
    $sql_update_reserva = "UPDATE Reservas
                           SET Num_Jugadores = ?, Balas_Adicionales = ?
                           WHERE ID = ?";
    $stmt = $conn->prepare($sql_update_reserva);
    $stmt->bind_param("iii", $num_jugadores, $balas_adicionales, $reserva_id);
    if ($stmt->execute()) {
        echo "Reserva actualizada con éxito.";
    } else {
        echo "Error al actualizar la reserva: " . $conn->error;
    }

    // Redireccionar a la página de ver reservas
    header("Location: ../ver_reservas.php?sucursal_id=" . $sucursal_id."&rol=".$rol);
    exit();
}

$conn->close();
?>
