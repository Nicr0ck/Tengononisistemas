<?php
require_once "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallesistema - Ingreso de Pedido</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <style>
        tr {
            border: 1px;
        }
        td{
            border: white;
        }
    </style>
    <h1>Ingreso de Galletitas</h1>
    <a href="../MenuPedidos.html">Menu de Pedidos</a>
    <div class="container mt-5">
        <form action="../acciones/insert_pedido.php" method="post" class="mt-4">
            <table class="table table-form">
                <tr>
                    <td>
                        <h3>Datos del Pedido</h3>
                    </td>
                <tr>
                    <td>
                    <label for="ID_Cliente" class="form-label">Cliente:</label>
                    <select name="ID_Cliente" id="ID_Cliente" class="form-select">
                        <?php
                        $sql = "SELECT * FROM clientes;";
                        $result = $conn->query($sql);
                        while ($row_client = mysqli_fetch_array($result)) {
                            echo "
                            <option value='" . htmlspecialchars($row_client['ID']) . "'>" . htmlspecialchars($row_client['Nombre']) . " " . htmlspecialchars($row_client['Apellido']) . " - " . htmlspecialchars($row_client['Localidad']) .  " - " . htmlspecialchars($row_client['Direccion']) . "</option>
                            ";
                        }
                        ?>
                    </select>
                    </td>
                    </tr><tr>
                    <td>
                        <label for="Cantidad_Pallets" class="form-label">Cantidad de Pallets:</label>
                        <input type="number" class="form-control form-control-sm" name="Cantidad_Pallets" placeholder="Cantidad de Pallets" min="1" max="999" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn">Realizar Pedido</button>
                    </td>
                </tr>
            </table>

</body>

</html>