<!DOCTYPE html>
<html>
<head>
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .eye-icon {
            position: absolute;
            right: 15px;
            top: 68%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
if (isset($_GET['e'])) {
    if ($_GET['e'] == "CIncorrecta") {
        echo "<script>alert('Contraseña Incorrecta, por favor intente de nuevo.');</script>";
    } elseif ($_GET['e'] == "UIncorrecto") {
        echo "<script>alert('Usuario Incorrecto o Inexistente, por favor intente de nuevo.');</script>";
    }
}
?>
<div class="container mt-5">
    <h1>Balines Mojados</h1>
    <form id="loginForm" action="acciones/Confirmar_Usuario.php" method="post">
        <table>
            <tr>    
                <td>
                    <h3>Iniciar Sesión</h3>
                </td>       
            </tr>
            <tr>
                <td colspan="2">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" name="usuario" placeholder="Nombre de Usuario" required>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="position-relative">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" id="contrasena" required>
                    <span class="eye-icon" id="togglePassword">
                        <i class="bi bi-eye-slash"></i>
                    </span>
                </td>    
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn">Iniciar Sesión</button>
                </td>    
            </tr>
        </table>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('contrasena');
        const eyeIcon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        }
    });
</script>
</body>
</html>
