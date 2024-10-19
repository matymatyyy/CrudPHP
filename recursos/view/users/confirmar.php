<?php
include_once("../../../panel/include/connOOP.php");
include_once("../../../panel/controllers/users/usuariosOOP.php");
$database = new DataBase("users");
$usuario = new Usuarios($database, "user");
$hash=isset($_GET["token"])?$_GET["token"]: "";

if (!empty($hash) && $usuario->confirmar($hash)) {
    echo "good";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmado</title>
</head>
<body>
    te activamos pa
</body>
</html>