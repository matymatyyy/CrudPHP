<?php 
$error = isset($_GET["error"])?$_GET["error"]:0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Iniciar Sesión</h2>
    <p class="alert alert-danger" role="alert"><?php echo ($error==1)? "Usuario invalido":"Complete los campos";  ?></p> 
    
    <form class="form" id="formu" method="POST" action="../../controllers/Login.php">
        <div class="form-group">
            <label for="gmail">Correo Electrónico</label>
            <input type="email" class="form-control" name="gmail" id="gmail" placeholder="ejemplo@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="contraseña" required>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Iniciar Sesión">
    </form>
    <br>
    <a class="btn  btn-secondary w-100" href="registrar.php" value="Registrar">Registrar</a><br>
    <br>
    <a class="btn btn-info w-100" href="/patronDiseño/" value="Iniciar Sesión">volver</a>
</div>
<script src="../../scrips/regulares.js"></script>
</body>
</html>
