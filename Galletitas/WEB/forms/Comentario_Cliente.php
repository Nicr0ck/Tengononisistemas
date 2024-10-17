<?php
$ID = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Devolucion - Gallesistema</title>
</head>
<body>
    <h1>Administrador de Entregas y Devoluciones</h1>
    <a href="../registro_entregas.php">Registro de Entregas</a>
    <div class="container mt-5">
        <?php
        echo"
        <form action='../acciones/agregar_comentario.php?id=$ID' method='post' class='mt-4'>
        ";?>
            <table class="table table-form">
                <tr>
                    <td>
                        <h3>Ingresar Comentarios</h3>
                    </td>
                <tr>
                    <td>
                        <label for="comentario" class="form-label">Comentarios del Cliente:</label>
                        <input type="text" class="form-control form-control-sm" name="comentario" placeholder="Comentarios del Cliente" required>
                    </td>
                    <td>
                        <label for="devolucion" class="form-label" >Devolucion:</label>
                        <input type="checkbox" name="devolucion" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn">Agregar Conductor</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>