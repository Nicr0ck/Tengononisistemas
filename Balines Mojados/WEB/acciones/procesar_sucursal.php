<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sucursal_id = $_POST['sucursal'];
    header("Location: ../menu_sistema.php?sucursal_id=" . $sucursal_id . "&rol=Administrador");
    exit();
}
?>
