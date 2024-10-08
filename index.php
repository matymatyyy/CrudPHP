<?php 
include_once("panel/controllers/entradas/entradasOOP.php");
include_once("panel/controllers/categorias/categoriasOOP.php");
include_once("panel/include/connOOP.php");

$database = new DataBase("users","noticias");
$entradas= new Entradas($database);
$database2 = new DataBase("users","categorias");
$categorias= new Categorias($database2);

$noticas = $entradas->read();
$categoris= $categorias->read();
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/patronDiseño/recursos/styles/index.css" rel="stylesheet">
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
                        setlocale(LC_TIME, 'es_ES.UTF-8');
                        echo strftime("%e de %B de %Y"); #mostramos la fehca de hoy
                        ?>
                    </li>
                </ul>

                <?php if (isset($_SESSION["usuario"])) { ?>
                    <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/controllers/eliminarSesion.php">Cerrar sesion</a>
                <?php }else{ ?>
                    <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/view/users/inicioSesion.php">Iniciar sesión</a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <hr>

    <div class="subTitulos text-center my-3">
        <?php foreach ($categoris as $cat) { ?>
           <a href="<?php echo "index.php?".$cat->id ?>"><?php echo $cat->nombre ?></a>
        <?php } ?>
    </div>

    <hr>

    <div class="desarrollo">
        <div class="container">
            <div class="row">
                <?php foreach ($noticas as $entra) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?php echo "/patronDiseño/panel/uploads/noticias/".$entra->imagen ?>" class="card-img-top" alt="Noticia">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $entra->titulo ?></h5>
                                <h6 class="card-text"><?php echo $entra->nombre ?></h6>
                                <p class="card-text"><?php echo $entra->descripcion ?></p>
                                <a href="<?php echo "detalle.php?id=$entra->id" ?>" class="btn btn-primary">Leer más</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>
</html>