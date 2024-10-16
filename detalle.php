<?php  
include_once("panel/controllers/entradas/entradasOOP.php");
include_once("panel/include/connOOP.php");

$database = new DataBase("users");
$entradas = new Entradas($database, "noticias");
session_start();

$id = isset($_GET["id"])?$_GET["id"]:""; 
$noticia = null;

if (!empty($id)) {
    $noticia = $entradas->read($id); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $noticia ? htmlspecialchars($noticia->titulo) : 'Detalle de Noticia'; ?></title>
    <link href="/patronDiseño/recursos/styles/index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="/patronDiseño/recursos/img/ch.png" alt="Logo" width="50" height="44" class="d-inline-block align-text-center">
            <span class="ms-2">CH Informa</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <?php
                    setlocale(LC_TIME, 'spanish');
                    echo strftime("%e de %B de %Y");
                ?>
                </li>
            </ul>

            <?php if (isset($_SESSION["usuario"])) { ?>
                <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/controllers/eliminarSesion.php">Cerrar sesion</a>
            <?php } else { ?>
                <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/view/users/inicioSesion.php">Iniciar sesion</a>
            <?php } ?>
        </div>
    </div>
</nav>
<hr>


    <?php if ($noticia) { ?>
            <div class="container my-5">
            <h1 class="display-1 text-center fw-bold"><?php echo htmlspecialchars($noticia->titulo); ?></h1><br>
            <h2 class="card-text "><?php echo htmlspecialchars($noticia->descripcion); ?></h2><br>
            <div class="card">
            <img src="<?php echo "/patronDiseño/panel/uploads/noticias/" . htmlspecialchars($noticia->imagen); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($noticia->titulo); ?>">
            <div class="card-body">
            <h4 class="fw-bold"><?php echo htmlspecialchars($noticia->nombre); ?></h4><br>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?php 
                    $fecha = new DateTime($noticia->fecha);
                    echo htmlspecialchars(strftime("%e de %B de %Y", $fecha->getTimestamp()));                
                    ?></h6><br>
                <p class="card-text"><?php echo htmlspecialchars($noticia->texto);?></p>
            </div>
        
    <?php } else { ?>
        <div class="alert alert-warning" role="alert">
            Noticia no encontrada.
        </div>
    <?php } ?>
    <a href="index.php" class="btn btn-secondary mt-3">Volver a la lista de noticias</a>
</div>

</body>
</html>
