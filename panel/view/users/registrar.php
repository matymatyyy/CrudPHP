<?php
$id=isset($_POST["id"])?$_POST["id"]:""; 
$actualizo=isset($_GET["actualizar"])?$_GET["actualizar"]:0;
$registro=isset($_GET["registro"])?$_GET["registro"]:0;
$gmail=isset($_POST["gmail"])?$_POST["gmail"]:"";
$pass=isset($_POST["password"])?$_POST["password"]:"";
$flag=0;
include_once("../../controllers/users/usuariosOOP.php");
include_once("../../include/connOOP.php");

$database = new DataBase("users","user");
$usuario= new Usuarios($database);
if (!empty($gmail) && !empty($pass)) {
    if ($registro==1) {
        if($usuario->create($gmail,$pass)){
            header("Location:/patronDiseño/panel/view/crudOOP.php?gmail=$gmail");
            exit();
        }else{
            echo "error al crear";
        }
    }elseif($actualizo==1){
        if($usuario->update($gmail,$pass,$id)){
            header("Location: /patronDiseño/panel/view/crudOOP.php?actualizo=1&gmail=$gmail");
            exit();
        }else{
            echo "no actualizaste los datos";
        }
    }
}
if (!empty($id)) {
    $user=$usuario->read($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo empty($id) ?  "Agregar" :  "actualizar"; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
</head>
<body>
<div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1><?php echo empty($id) ? "Agregar Usuario" : "Actualizar Usuario"; ?></h1>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <?php if ($flag==1 && $registro==1) {
                        echo "<div class='alert alert-success'>Se registró $gmail</div>";
                    } elseif ($flag==1 && $actualizo==1) {
                        echo "<div class='alert alert-success'>Se actualizó $gmail</div>";
                    } ?>
                </div>
                <p class="error"></p>
                <form class="form formulario" method="POST" action="<?php echo empty($id) ? "registrar.php?registro=1" : "registrar.php?actualizar=1"; ?>">
                    <div class="form-group">
                        <label for="gmail">Correo Electrónico</label>
                        <input type="text" class="form-control email" name="gmail" id="gmail"
                               <?php echo empty($id) ? "placeholder='ejemplo@gmail.com'" : "value='" . htmlspecialchars($user->gmail, ENT_QUOTES) . "'"; ?>>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control password" name="password" id="password"
                               <?php echo empty($id) ? "placeholder='contraseña'" : "value='" . htmlspecialchars($user->password, ENT_QUOTES) . "'"; ?>>
                    </div>
                    <?php if (!empty($id)) { ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <?php } ?>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <br>
                <form action="/patronDiseño/panel/view/crudOOP.php">
                    <button type="submit" class="btn btn-secondary">Volver</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../../scrips/users/regulares.js"></script>
</body>
</html>