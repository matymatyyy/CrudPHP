<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/categorias/categoriasOOP.php");
include_once("../../include/connOOP.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$actualizo=isset($_GET["actualizar"])?$_GET["actualizar"]:0;
$registro=isset($_GET["registro"])?$_GET["registro"]:0;
$nombre= isset($_POST["nombre"])?$_POST["nombre"]:"";

$database = new DataBase("users");
$categorias= new Categorias($database,"categorias");

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
</head>
<body>
<div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1><?php echo empty($id) ? "Agregar Categoria" : "Actualizar Categoria"; ?></h1>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="<?php echo empty($id) ? "update.php?registro=1" : "update.php?actualizar=1"; ?>">
                    <p class="text-danger"></p>
                    
                    <div class="form-group">
                        <label for="nombre">Nombre de la Categoria</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" 
                               <?php echo empty($id) ? "placeholder='Tecnología'" : "value='" . htmlspecialchars($cat->nombre, ENT_QUOTES) . "'"; ?> required>
                    </div>
                    
                    <?php if (!empty($id)) { ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <?php } ?>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <br>
                <form action="/patronDiseño/panel/view/categorias/categorias.php">
                    <button type="submit" class="btn btn-secondary">Volver</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>