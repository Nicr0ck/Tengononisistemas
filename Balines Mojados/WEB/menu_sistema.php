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

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<?php 
    if($rol=='Administrador'){
        echo"<li><a href='seleccion_sucursales.php'>Seleccion de Sucursales</a></li>";
    }else{
        echo"";
    }
    ?>
<h1>Menú  - <?php echo $nombre_sucursal; ?></h1>

<p>Seleccione una opción:</p>

<ul>
    <li><a href="ver_reservas.php?sucursal_id=<?php echo $sucursal_id; ?>&rol=<?php echo $rol; ?>">Ver Reservas</a></li>
    <li><a href="realizar_reserva.php?sucursal_id=<?php echo $sucursal_id; ?>&rol=<?php echo $rol; ?>">Realizar Reserva</a></li>
    <?php 
    if($rol=='Administrador'){
        echo"<li><a href='lista_facturas.php?sucursal_id=" . $sucursal_id . "&rol=".$rol."'>Lista de Facturas</a></li>";
    }else{
        echo"";
    }
    ?>
</ul>

</body>
</html>
