<?php
include_once("../../include/verificarSesion.php");
echo "bienvenido ".$_SESSION["gmail"]." que desea ejecutar:";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Elija una opcion: </h2>
    <form action="crudOOP.php">
        <input type="submit" value="Listar usuarios o modificar">
    </form>
    <form action="../../controllers/users/eliminarSesion.php">
        <input type="submit" value="Cerrar sesion">
    </form>
</body>
</html>