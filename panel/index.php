<?php
$error=isset($_GET["error"])?$_GET["error"]:"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="icon" href="/patronDiseño/panel/uploads/panel/diario.png" type="image/png">
    <link rel="stylesheet" href="styles/users/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header text-center">
                <h1>Panel de Control</h1>
            </div>
            <div class="card-body">
                <?php if ($error == 1) { ?>
                    <div class="alert alert-danger text-center" role="alert">
                        Usuario invalido
                    </div>
                <?php } ?>
                <form action="controllers/users/validarOOP.php" method="POST" class="form">
                    <div class="form-group mb-3">
                        <label for="gmail">Usuario</label>
                        <input type="text" class="form-control" id="gmail" name="gmail" placeholder="Ingrese su usuario">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesion</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>