<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/entradas/entradasOOP.php");
include_once("../../include/connOOP.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$error = isset($_GET["error"]) ? $_GET["error"] : 0;
$elimino =0;
$titulo = isset($_GET["titulo"]) ? $_GET["titulo"] : "";
$actualizo=isset($_GET["actualizo"]) ? $_GET["actualizo"] : 0;
$registro=isset($_GET["registro"])?$_GET["registro"]:0;

$database = new DataBase("users","noticias");
$entradas= new Entradas($database);

if (!empty($id) && !empty($titulo) && $entradas->detele($id)) {
    $elimino=1;
}

$entrada= $entradas->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../styles/users/crudOOP.css" rel="stylesheet">
</head>
<body>
<?php include_once("../shared/nav.html") ?>
    <br>
        <div class="row">
            <?php include_once("../shared/botones.html");
            include_once("entradasTable.php");
            ?>
    </div>    
</body>
</html>