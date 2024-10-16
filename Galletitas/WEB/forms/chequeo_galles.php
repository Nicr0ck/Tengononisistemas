<?php
include '../config/config.php';
$ID = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chequeo de Galletitas - Gallesistema</title>
</head>
<body>
<h1>Chequeo de Estado de las galletitas</h1>
<a href="../Lista_galles.php">Lista de Galletitas</a>
<?php
echo"
<form action='../acciones/update_galletitas.php?id=$ID'method='post' class='mt-4'>
";
?>
<table class="table table-form">
                <tr>
                    <td>
                        <h3>Revision</h3>
                    </td>
                <tr>
                    <td>
                        <label for="Etapa" class="form-label">Etapa:</label>
                        <select name="Etapa" id="Etapa" class="form-select">
                        <option value="Empaquetado">Empaquetado</option>
                        <option value="Armado de Pallet">Armado de Pallet</option>
                        <option value="Almacenamiento">Almacenamiento</option>
                        <option value="Carga de Pallets">Carga de Pallets</option>
                        <option value="Traslado">Traslado</option>
                    </td>
                    <td>
                    <label for="Estado" class="form-label">Estado de las Galletitas:</label>
                        <select name="Estado" id="Estado" class="form-select">
                        <option value="Sin Revisar"> - </option>
                        <option value="En Perfecto Estado">Perfectas</option>
                        <option value="En Buen Estado">Buen Estado</option>
                        <option value="Dañadas">Dañadas</option>
                        <option value="Rotas">Rotas</option>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn">Subir Revision</button>
                    </td>
                </tr>
            </table>
</body>
</html>