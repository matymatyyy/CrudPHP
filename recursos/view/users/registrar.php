<?php
$gmail = isset($_POST["gmail"]) ? $_POST["gmail"] : "";
$name=isset($_POST["name"]) ? $_POST["name"] : "";
$pass = isset($_POST["password"]) ? $_POST["password"] : "";
$registro = isset($_GET["registro"]) ? $_GET["registro"] : 0;
$flag = isset($_GET["flag"]) ? $_GET["flag"] : 0;
$error=0;

include_once("../../../panel/include/connOOP.php");
include_once("../../../panel/controllers/users/usuariosOOP.php");

$database = new DataBase("users");
$usuario = new Usuarios($database, "user");

if (!empty($gmail) && !empty($pass)) {
    if ($registro == 1) {
        if (!$usuario->duplicado($gmail)) {
            $usuario->create($gmail,$name, $pass);
            header("Location: registrar.php?registro=1&flag=1");
        } else {
            $error=1;
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
                    echo "<div class='alert-success'>Se registro correctamente </div><br>";
                }
                if ($error) {
                    echo "<p class='alert-danger' role='alert' >Este gmail ya existe</p> ";
                } ?>
            </div>
            <form class="form text-center" id="formu" method="POST" action="registrar.php?registro=1">
            <p class="alert alert-danger" role="alert" >Complete los campos</p> 
                <div class="form-group">
                    <label for="gmail">Correo Electrónico</label>
                    <input type="text" class="form-control" name="gmail" id="gmail" placeholder="ejemplo@gmail.com">
                </div>
                <div class="form-group">
                    <label for="text">Usuario</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="usuario">
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