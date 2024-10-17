<?php
include"../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignacion de Camion - Gallesistema</title>
</head>
<body>
    <h1>Asignacion de Camion</h1>
    <div class="container mt-5">
        <form action="../acciones/asignar_entrega.php" method="post" class="mt-4">
            <a href="../registro_camiones.php">Registro de Camiones</a>
            <table class="table table-form">
                <tr>
                    <td>
                        <h3>Datos de la Entrega</h3>
                    </td>
                <tr>
                    <td>
                    <label for="ID_Camionero" class="form-label">Camionero:</label>
                    <select name="ID_Camionero" id="ID_Camionero" class="form-select">
                        <?php
                        $sql = "SELECT * FROM camioneros;";
                        $result = $conn->query($sql);
                        while ($row_client = mysqli_fetch_array($result)) {
                            echo "
                            <option value='" . htmlspecialchars($row_client['ID']) . "'>" . htmlspecialchars($row_client['Nombre']) . " - " . htmlspecialchars($row_client['DNI']) . "</option>
                            ";
                        }
                        ?>
                    </select>
                    <a href="ingreso_camionero.php">Agregar Conductor</a>
                    </td>
                    </tr><tr>
                    <td>
                    <label for="ID_Camion" class="form-label">Camion:</label>
                    <select name="ID_Camion" id="ID_Camion" class="form-select">
                        <?php
                        $sql = "SELECT * FROM camiones;";
                        $result = $conn->query($sql);
                        while ($row_client = mysqli_fetch_array($result)) {
                            echo "
                            <option value='" . htmlspecialchars($row_client['ID']) . "'>Camion " . htmlspecialchars($row_client['ID']) . "</option>
                            ";
                        }
                        ?>
                    </select>
                    <a href="ingreso_camion.php">Agregar Camion</a>
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="ID" class="form-label">Entrega:</label>
                    <select name="ID" id="ID" class="form-select">
                        <?php
                        $sql = "SELECT
                            e.ID AS ID_Entrega,
                            c.Nombre AS Nombre_Cliente, 
                            c.Apellido AS Apellido_Cliente,
                            DATE_FORMAT(p.Fecha, '%d/%m/%y') AS Fecha_Pedido,
                            p.Cantidad_Pallets AS Cantidad_Pallets
                        FROM Pedidos p
                        JOIN Clientes c ON p.ID_Cliente = c.ID
                        JOIN Galletitas g ON p.ID = g.ID_Pedido
                        JOIN Entregas e ON p.ID = e.ID_Pedido
                        ORDER BY ID_Entrega;
                        ";
                        $result = $conn->query($sql);
                        while ($row_client = mysqli_fetch_array($result)) {
                            echo "
                            <option value='" . htmlspecialchars($row_client['ID_Entrega']) . "'>" . htmlspecialchars($row_client['Nombre_Cliente']) . " " . htmlspecialchars($row_client['Apellido_Cliente']) . " - " . htmlspecialchars($row_client['Cantidad_Pallets']) . " Pallets - " . htmlspecialchars($row_client['Fecha_Pedido']) . "</option>
                            ";
                        }
                        ?>    
                    </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn">Relacionar Entrega</button>
                    </td>
                </tr>
            </table>

</body>

</html>
</body>
</html>