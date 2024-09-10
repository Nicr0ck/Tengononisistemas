<?php
include '../config/config.php';

if (isset($_GET['rol'])) {    
    $rol = $_GET['rol'];
} else {
    die('No se realizo el inicio de sesion');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $cancha_id = $_POST['cancha'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora_inicio'];
    $num_jugadores = $_POST['num_jugadores'];
    $balas_adicionales = $_POST['balas_adicionales'];

    $nombre_cliente = $_POST['nombre_cliente'];
    $empresa = $_POST['empresa'];
    $telefono_cliente = $_POST['telefono_cliente'];
    $email_cliente = $_POST['email_cliente'];
    $sucursal_id = $_POST['sucursal_id'];

    // Insertar cliente
    $sql_insert_cliente = "INSERT INTO Clientes (Nombre, Empresa, Telefono, Email)
                           VALUES ('$nombre_cliente', $empresa, '$telefono_cliente', '$email_cliente')";
    if ($conn->query($sql_insert_cliente) === TRUE) {
        $cliente_id = $conn->insert_id; // Obtener el ID del cliente insertado
    } else {
        die("Error al insertar cliente: " . $conn->error);
    }

    // Insertar turno
    $hora_fin = date("H:i", strtotime($hora_inicio . " +1 hour"));
    $sql_insert_turno = "INSERT INTO Turnos (ID_Cancha, fecha, hora_inicio, hora_fin, estado)
                         VALUES ($cancha_id, '$fecha', '$hora_inicio', '$hora_fin', 'Reservado')";
    if ($conn->query($sql_insert_turno) === TRUE) {
        $turno_id = $conn->insert_id; // Obtener el ID del turno insertado
    } else {
        die("Error al insertar turno: " . $conn->error);
    }

    // Insertar reserva
    $sql_insert_reserva = "INSERT INTO Reservas (ID_Cliente, ID_Turno, Num_Jugadores, Balas_Adicionales)
                           VALUES ($cliente_id, $turno_id, $num_jugadores, $balas_adicionales)";
    if ($conn->query($sql_insert_reserva) === TRUE) {
        // Redirigir al menú si la reserva fue exitosa
        header("Location: ../menu_sistema.php?sucursal_id=$sucursal_id&rol=$rol");
        exit();
    } else {
        die("Error al insertar reserva: " . $conn->error);
    }
}

$conn->close();
?>
