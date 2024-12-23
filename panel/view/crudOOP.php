<?php
include_once("../include/verificarSesion.php");
include_once("../controllers/users/usuariosOOP.php");
include_once("../include/connOOP.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$error = isset($_GET["error"]) ? $_GET["error"] : 0;
$elimino = 0;
$gmail = isset($_GET["gmail"]) ? $_GET["gmail"] : "";
$actualizo = isset($_GET["actualizo"]) ? $_GET["actualizo"] : 0;
$estado = isset($_POST["estado"]) ? $_POST["estado"] : 0;

$database = new DataBase("users");
$usuarios = new Usuarios($database, "user");

if (!empty($id)) { 
    if ($estado == 1) {
        $usuarios->estado($id);
        header("Location:/patronDiseño/panel/view/crudOOP.php");
        exit();
    }
    if (!empty($gmail) && $usuarios->detele($id)) {
        $elimino = 1;
    }
}
$user = $usuarios->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="icon" href="/patronDiseño/panel/uploads/panel/diario.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="../styles/users/crudOOP.css" rel="stylesheet">
</head>
<body>
<?php include_once("shared/nav.html") ?>
<br>
<div class="container">
    <div class="row justify-content-center">
        <?php include_once("users/users.php") ?>
    </div>
</div>

<script src="../scrips/users/limitText.js"></script>
</body>
</html>
