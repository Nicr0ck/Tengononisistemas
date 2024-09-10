<?php
include '../config/config.php';

$administrador = "Administrador";

$usuario = $_POST["usuario"];
$contraseña = $_POST["contrasena"];

$sql = "SELECT Nombre, Contraseña, Rol, ID_Sucursal FROM Usuarios WHERE Nombre ='$usuario';"; 
$result = $conn->query($sql); 

if ($result->num_rows > 0) {
    while ($row_client = $result->fetch_assoc()) {
        if ($contraseña == $row_client['Contraseña']) {
            if( $administrador == $row_client['Rol']) {
                header("Location: ../seleccion_sucursales.php");
                exit();
            }else{
                $sucursal_id = $row_client["ID_Sucursal"];
                header("Location: ../menu_sistema.php?sucursal_id=$sucursal_id&rol=Empleado");
                exit();
            }
        } else {
            header("Location: ../index.php?e=CIncorrecta");
            exit();
        }
    }
} else {
    header("Location: ./index.php?e=UIncorrecto");
    exit();
}