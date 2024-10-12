<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/categorias/categoriasOOP.php");
include_once("../../include/connOOP.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$error = isset($_GET["error"]) ? $_GET["error"] : 0;
$elimino =0;
$nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : "";
$actualizo=isset($_GET["actualizo"]) ? $_GET["actualizo"] : 0;
$registro=isset($_GET["registro"])?$_GET["registro"]:0;

$database = new DataBase("users","categorias");
$categorias= new Categorias($database);

if (!empty($nombre) && !empty($id) && $categorias->detele($id)) { #la accion de un if se agrego a la condicion del mismo
    $elimino = 1;
}

$categoria= $categorias->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../styles/users/crudOOP.css" rel="stylesheet">
</head>
<body>
<?php include_once("../shared/nav.html") ?>
    <br>
        <div class="row">
            <?php include_once("../shared/botones.html");
            include_once("categoriasTable.php");
            ?>
    </div>   
<script src="../../scrips/users/limitText.js"></script>
</body>
</html>