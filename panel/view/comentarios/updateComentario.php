<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/comentarios/comentariosOOP.php");
include_once("../../include/connOOP.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$actualizo=isset($_GET["actualizar"])?$_GET["actualizar"]:0;
$registro=isset($_GET["registro"])?$_GET["registro"]:0;
$comentario = isset($_POST["Comentario"])?$_POST["Comentario"]:"";

$database = new DataBase("users");
$comentarios= new Comentarios($database,"comentarios");

if ($registro==1) { #falta modificar y a la hora de crear los comentarios darle a elegir que noticia va
    if ($comentarios->create(0,$_SESSION["usuario"],$comentario)) {
        header("Location:/patronDiseño/panel/view/comentarios/comentarios.php?registro=1");
        exit();
    }
}

if (!empty($id)) {
    if (!empty($comentario)) {
        $comentarios->update($comentario,$id);
        header("Location:/patronDiseño/panel/view/comentarios/comentarios.php?actualizo=1");
        exit();
    }
    $comen=$comentarios->read($id);
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
                <h1><?php echo empty($id) ? "Agregar Comentario" : "Actualizar Comentario"; ?></h1>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="<?php echo empty($id) ? "updateComentario.php?registro=1" : "updateComentario.php?actualizar=1"; ?>">
                    <p class="text-danger"></p>
                    <div class="form-group">
                        <label for="nombre">Comentario</label>
                        <input type="text" class="form-control" name="Comentario" id="nombre" 
                               <?php echo empty($id) ? "placeholder='Comentario'" : "value='" . htmlspecialchars($comen->comentario , ENT_QUOTES) . "'"; ?> required>
                    </div>
                    
                    <?php if (!empty($id)) { ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <?php } ?>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <br>
                <form action="/patronDiseño/panel/view/comentarios/comentarios.php">
                    <button type="submit" class="btn btn-secondary">Volver</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>