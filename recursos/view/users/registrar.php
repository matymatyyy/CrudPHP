<?php
$gmail = isset($_POST["gmail"]) ? $_POST["gmail"] : "";
$pass = isset($_POST["password"]) ? $_POST["password"] : "";
$registro = isset($_GET["registro"]) ? $_GET["registro"] : 0;
$flag = 0;

include_once("../../../panel/include/connOOP.php");
include_once("../../../panel/controllers/users/usuariosOOP.php");

$database = new DataBase("users", "user");
$usuario = new Usuarios($database);

if (!empty($gmail) && !empty($pass)) {
    if ($registro == 1) {
        if ($usuario->create($gmail, $pass)) {
            $flag=1;
            header("Location: ");
        } else {
            echo "Error al crear el usuario";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h1>registrar Usuario</h1>
        </div>
        <div class="card-body">
            <div class="text-center">
                <?php if ($flag == 1 && $registro == 1) {
                    echo "<div class='alert alert-success'>Se registró $gmail</div>";
                } ?>
            </div>
            <form class="form text-center" id="formu" method="POST" action="registrar.php?registro=1">
            <p class="alert alert-danger" role="alert" >Complete los campos</p> 
                <div class="form-group">
                    <label for="gmail">Correo Electrónico</label>
                    <input type="text" class="form-control" name="gmail" id="gmail" placeholder="ejemplo@gmail.com">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="contraseña">
                </div>
                <br>
                <input type="submit" class="btn btn-primary w-100">
            </form>
            <br>
            <form action="inicioSesion.php">
                <button type="submit" class="btn btn-secondary w-100">Volver</button>
            </form>
        </div>
    </div>
</div>
<script src="../../scrips/regulares.js"></script>
</body>
</html>