<?php
include_once("../../../panel/include/connOOP.php");
include_once("../../../panel/controllers/users/usuariosOOP.php");
$database = new DataBase("users");
$usuario = new Usuarios($database, "user");
$hash=isset($_GET["token"])?$_GET["token"]: "";

$message = "";

if (!empty($hash) && $usuario->confirmar($hash)) {
    $message = "¡Gracias por registrarte! Tu cuenta ha sido activada.";
} else {
    $message = "Lo sentimos, no se pudo activar tu cuenta. Por favor, verifica tu enlace.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cuenta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card text-center">
            <div class="card-header">
                <h1>Confirmacion de Registro</h1>
            </div>
            <div class="card-body">
                <p class="alert <?php echo ($message === '¡Gracias por registrarte! Tu cuenta ha sido activada.') ? 'alert-success' : 'alert-danger'; ?>">
                    <?php echo $message; ?>
                </p>
                <a href="inicioSesion.php" class="btn btn-primary w-100">Iniciar Sesion</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
