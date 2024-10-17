<?php
$ID = intval($_GET["id"]);
$Comentario = $_POST["comentario"];

$Devolucion = isset($_POST["devolucion"]) ? 1 : 0;

require_once "../config/config.php";

$sql = "UPDATE entregas
        SET Comentarios_Cliente = ?, Devolucion = ?
        WHERE ID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $Comentario, $Devolucion, $ID);

if ($stmt->execute()) {
    header("Location: ../registro_entregas.php");
    exit();
} else {
    echo "Error al actualizar los datos. Contactarse con la gente de TengononiSistemas.";
}

$stmt->close();
$conn->close();
