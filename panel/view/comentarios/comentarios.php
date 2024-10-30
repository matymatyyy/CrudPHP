<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/comentarios/comentariosOOP.php");
include_once("../../include/connOOP.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$userComentario = isset($_POST["user"]) ? $_POST["user"] : "";
$elimino = isset($_GET["elimino"])?$_GET["elimino"]:0;
$actualizo=isset($_GET["actualizo"])?$_GET["actualizo"]:0;
$registro=isset($_GET["registro"])?$_GET["registro"]: 0;

$database = new DataBase("users");
$comentarios = new Comentarios($database, "comentarios");

if (!empty($userComentario) && $elimino == 1) {
    $comentarios->delete($id);
}


$comentario= $comentarios->read();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link rel="icon" href="/patronDiseño/panel/uploads/panel/diario.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="../../styles/users/crudOOP.css" rel="stylesheet">
</head>
<body>
<?php include_once("../shared/nav.html") ?>
<br>
<div class="container">
    <div class="row justify-content-center">
    <?php include_once("comentariosTable.php") ?>
    </div>
</div>

<script src="../scrips/users/limitText.js"></script>
</body>
</html>
