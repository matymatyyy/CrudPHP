<?php  
include_once("panel/controllers/entradas/entradasOOP.php");
include_once("panel/include/connOOP.php");

$database = new DataBase("users");
$entradas = new Entradas($database, "noticias");
session_start();

$id = isset($_GET["id"]) ? $_GET["id"] : ""; 
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
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary sticky-top">
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
                <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/controllers/eliminarSesion.php">Cerrar sesión</a>
            <?php } else { ?>
                <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/view/users/inicioSesion.php">Iniciar sesión</a>
            <?php } ?>
        </div>
    </div>
</nav>
<hr>

<div class="container my-5">
    <?php if ($noticia) { ?>
        <div class="card">
            <div class="card-header text-center">
                <h1 class="display-1 text-center fw-bold"><?php echo htmlspecialchars($noticia->titulo); ?></h1>
            </div>
            <div class="container my-1">
                <div class="card-body">
                    <h2 class="card-text"><?php echo htmlspecialchars($noticia->descripcion); ?></h2>
                    <br>
                    <img src="<?php echo "/patronDiseño/panel/uploads/noticias/" . htmlspecialchars($noticia->imagen); ?>" class="card-img-top w-75 mx-auto d-block" alt="<?php echo htmlspecialchars($noticia->titulo); ?>">
                    <br>
                    <h4 class="fw-bold"><?php echo htmlspecialchars($noticia->nombre); ?></h4>
                    <br>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php 
                        $fecha = new DateTime($noticia->fecha);
                        echo htmlspecialchars(strftime("%e de %B de %Y", $fecha->getTimestamp()));                
                        ?>
                    </h6>
                    <br>
                    <p class="card-text"><?php echo htmlspecialchars($noticia->texto); ?></p>
                </div>
            </div>
            <a href="index.php" class="btn btn-secondary mt-3">Volver a la lista de noticias</a>
        </div>
        <br>
    <?php } else { ?>
        <div class="alert alert-warning" role="alert">
            Noticia no encontrada.
        </div>
    <?php } ?>
    <?php if ($noticia) { ?>
        <div class="my-5">
            <h3>Comentarios</h3>
            <?php if (isset($_SESSION["usuario"])) { ?>
                <form action="recursos/controllers/guardarComentarios.php" method="POST">
                    <input type="hidden" name="noticia_id" value="<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Escribe tu comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar comentario</button>
                </form>
            <?php } else { ?>
                <p>Debes <a href="recursos/view/users/inicioSesion.php">iniciar sesión</a> para comentar.</p>
            <?php } ?>
            <br>
            <h4>Comentarios anteriores:</h4>
            <?php
            $comentarios = $entradas->obtenerComentarios($id);
            if ($comentarios) {
                foreach ($comentarios as $comentario) {
                    $fecha = new DateTime($comentario['fecha']);
                    echo "<div class='card my-2'>";
                    echo "<div class='card-body'>";
                    echo "<h6 class='card-title'>" . htmlspecialchars($comentario['name']) . "</h6>";
                    echo "<p class='card-muted'>" . htmlspecialchars(strftime("%e de %B de %Y", $fecha->getTimestamp())) . "</p>";
                    echo "<p class='text-muted'>" . htmlspecialchars($comentario['comentario']) . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay comentarios aún.</p>";
            }
            ?>
        </div>
    <?php } ?>
</div>
<footer class="bg-light text-dark pt-3 pb-3">
    <div class="container text-center text-md-start">
        <div class="text-center">
                <a class="navbar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <img src="/patronDiseño/recursos/img/ch.png" alt="Logo" width="50" height="44" class="d-inline-block align-text-center">
                    <span class="ms-2 text-uppercase">CH Informa</span>
                </a>
        </div><hr class="mb-2">
        <div class="row text-center text-md-start">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-2">
                <h5 class="text-uppercase mb-2 font-weight-bold text-primary fs-6">Nosotros</h5>
                <hr class="mb-2">
                <p class="fs-6">Lorem, ipsum dolor sit amet consectetur adipisicing elit. In distinctio aspernatur asperiores ut. Voluptatem sequi voluptate tempora velit mollitia. Maiores commodi iste, tempore doloremque eveniet officiis quis quaerat magni voluptatem.</p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-2">
                <h5 class="text-uppercase mb-2 font-weight-bold text-primary fs-6">Dejanos ayudar</h5>
                <hr class="mb-2">
                <p><a href="#" class="text-dark fs-6">lorem</a></p>
                <p><a href="#" class="text-dark fs-6">lorem</a></p>
                <p><a href="#" class="text-dark fs-6">lorem</a></p>
                <p><a href="#" class="text-dark fs-6">lorem</a></p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-2">
                <h5 class="text-uppercase mb-2 font-weight-bold text-primary fs-6">Aca va otro texto</h5>
                <hr class="mb-2">
                <p><a href="#" class="text-dark fs-6">lorem</a></p>
                <p><a href="#" class="text-dark fs-6">lorem</a></p>
                <p><a href="#" class="text-dark fs-6">lorem</a></p>
                <p><a href="#" class="text-dark fs-6">lorem</a></p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-2">
                <h5 class="text-uppercase mb-2 font-weight-bold text-primary fs-6">Contacto</h5>
                <hr class="mb-2">
                <p class="fs-6"><i class="fas fa-home me-2"></i> Argentina, Buenos Aires, Chacabuco</p>
                <p class="fs-6"><i class="fas fa-envelope me-2"></i> matydominguez555@gmail.com</p>
                <p class="fs-6"><i class="fas fa-phone me-2"></i> +54 2352 551599</p>
                <p class="fs-6"><i class="fas fa-print me-2"></i> +54 2352 551599</p>
            </div>
            <hr class="mb-2">
            <div class="text-center mb-2">
                <p class="fs-6">
                    Copyright de
                    <a href="#"><strong class="text-primary">CH Informa</strong></a>
                </p>
            </div>
            <div class="text-center">
                <ul class="list-unstyled list-inline">
                    <li class="list-inline-item">
                        <a href="#" class="text-dark fs-5"><i class="fab fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-dark fs-5"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-dark fs-5"><i class="fab fa-google-plus"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-dark fs-5"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-dark fs-5"><i class="fab fa-youtube"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
