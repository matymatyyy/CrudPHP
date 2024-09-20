<?php
$id=isset($_POST["id"])?$_POST["id"]:"";
$actualizo=isset($_GET["actualizar"])?$_GET["actualizar"]:0;
$registro=isset($_GET["registro"])?$_GET["registro"]:0;
$gmail=isset($_POST["gmail"])?$_POST["gmail"]:"";
$pass=isset($_POST["password"])?$_POST["password"]:"";
$flag=0;
include_once("../../controllers/users/usuariosOOP.php");

$database = new DataBase("users","user");
$usuario= new Usuarios($database);
if (!empty($gmail) && !empty($pass)) {
    if ($registro==1) {
        if($usuario->create($gmail,$pass)){
            $flag=1;
        }else{
            echo "error al crear";
        }
    }elseif($actualizo==1){
        if($usuario->update($gmail,$pass,$id)){
            header("Location: crudOOP.php?actualizo=1&gmail=$gmail");
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
    <title><?php echo empty($id) ?  "registrar" :  "actualizar"; ?></title>
    <link rel="stylesheet" href="../../styles/users/index.css">
</head>
<body>
    <div class="centrar">
        <?php if ($flag==1 && $registro==1) {
            echo "Se registro $gmail";
        }elseif ($flag==1 && $actualizo==1) {
            echo "Se actualizo $gmail";
        } ?>
        <?php echo empty($id) ?  "<h1>registrar</h1>" :  "<h1>actualizar</h1>"; ?>
        <form class="formulario" method="POST" action=<?php echo empty($id) ?  "registrar.php?registro=1" :  "registrar.php?actualizar=1"; ?>>
        <p class="error"></p>
            <input type="text" class="email" name="gmail" <?php echo empty($id) ?  "placeholder='ejemplo@gmail.com'" :  "value=$user->gmail"; ?>>
            <input class="password" type="text" name="password" <?php echo empty($id) ?  "placeholder='contraseña'" :  "value=$user->password"; ?>>
            <?php if (!empty($id)) { ?>
                <input type="hidden" name="id" value="<?php echo $id ?>">
            <?php } ?>
            <input type="submit">
        </form><br>
        <form action=<?php echo empty($id) ? "../../index.php" : "crudOOP.php"; ?>>
            <input type="submit" value="volver">
        </form>
    </div>
    <script src="../../scrips/users/regulares.js"></script>
</body>
</html>