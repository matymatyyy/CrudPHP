<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/categorias/categoriasOOP.php");
include_once("../../include/connOOP.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$actualizo=isset($_GET["actualizar"])?$_GET["actualizar"]:0;
$registro=isset($_GET["registro"])?$_GET["registro"]:0;
$nombre= isset($_POST["nombre"])?$_POST["nombre"]:"";

$database = new DataBase("users","categorias");
$categorias= new Categorias($database);

if ($registro==1) {
    if ($categorias->create($nombre)) {
        header("Location:/patronDiseño/panel/view/categorias/categorias.php?registro=1&nombre=$nombre");
        exit();
    }
}

if (!empty($id)) {
    if (!empty($nombre)) {
        $categorias->update($nombre,$id);
        header("Location:/patronDiseño/panel/view/categorias/categorias.php?actualizo=1&nombre=$nombre");
        exit();
    }
    $cat=$categorias->read($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <link rel="stylesheet" href="../../styles/users/index.css">
</head>
<body>
<div class="centrar">
        <?php echo empty($id) ?  "<h1>Agregar</h1>" :  "<h1>actualizar</h1>"; ?>
        <form class="formulario" method="POST" action=<?php echo empty($id) ?  "update.php?registro=1" :  "update.php?actualizar=1"; ?>>
        <p class="error"></p>
            <input type="text" name="nombre" <?php echo empty($id) ?  "placeholder='tecnologia'" :  "value=$cat->nombre"; ?>>
            <?php if (!empty($id)) { ?>
                <input type="hidden" name="id" value="<?php echo $id ?>">
            <?php } ?>
            <input type="submit">
        </form><br>
        <form action="/patronDiseño/panel/view/categorias/categorias.php">
        <input type="submit" value="volver">
    </form>
    </div>
</body>
</html>