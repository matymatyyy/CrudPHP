<?php
$error=isset($_GET["error"])?$_GET["error"]:"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="styles/users/index.css">

</head>
<body>
    <div class="centrar">
    <h1>Panel de control</h1>
    <?php if ($error==1) { ?>
        <p>usuario invalido</p>
    <?php } ?>
    <p class="error"></p>
        <form action="controllers/users/validarOOP.php" method="POST" class="formulario">
            <input type="text" name="gmail" placeholder="ingrese su gmail" class="email">
            <input type="text" name="password" placeholder="ingrese su contraseña"  class="password">
            <input type="submit" class="boton">
        </form> 
    </div>
</body>
</html>