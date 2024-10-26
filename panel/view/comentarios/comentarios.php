<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/comentarios/comentariosOOP.php");
include_once("../../include/connOOP.php");

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
