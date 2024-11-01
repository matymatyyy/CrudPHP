<?php  
include_once("panel/controllers/entradas/entradasOOP.php");
include_once("panel/controllers/categorias/categoriasOOP.php");
include_once("panel/include/connOOP.php");

$database = new DataBase("users");
$categorias= new Categorias($database,"categorias");
$entradas = new Entradas($database, "noticias");
session_start();

$id = isset($_GET["id"]) ? $_GET["id"] : ""; 
$noticia = null;

$categoris= $categorias->read();

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
    <link rel="icon" href="/patronDiseño/recursos/img/ch.png" type="image/png">
    <link href="/patronDiseño/recursos/styles/index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include_once("recursos/view/shared/nav.php") ?>
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
                <div action="recursos/controllers/guardarComentarios.php" method="POST">
                    <input type="hidden" id="noticia_id" name="noticia_id" value="<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Escribe tu comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="3" required></textarea>
                    </div>
                    <button type="button" id="enviarComentario" class="btn btn-primary">Enviar comentario</button>
                </div>
            <?php } else { ?>
                <p>Debes <a href="recursos/view/users/inicioSesion.php">iniciar sesión</a> para comentar.</p>
            <?php } ?>
            <br>
            <h4>Comentarios anteriores:</h4>
            <div id="contedorComentarios">
                <?php
                $comentarios = $entradas->obtenerComentarios($id);
                if ($comentarios) {
                    foreach ($comentarios as $comentario) {
                        $fecha = new DateTime($comentario['fecha']);
                        echo "<div class='card my-2'>";
                        echo "<div class='card-body'>";
                        echo "<div class='d-flex justify-content-between align-items-center'>";
                        echo "<h6 class='card-title'>" . htmlspecialchars($comentario['name']) . "</h6>";
                        if (isset($_SESSION["usuario"])) {#falta hacer una verificacion interna para que no borren comentarios que no son suyos
                            if ($_SESSION["usuario"] == $comentario["id_usuario"]) {
                                echo "<button class='btn btn-danger btn-sm' onclick='eliminarComentario(" . $comentario['id'] . "," . $id . ")'>X</button>";
                            }
                        }
                        echo "</div>";
                        echo "<p class='card-muted'>" . htmlspecialchars(strftime("%e de %B de %Y", $fecha->getTimestamp())) . "</p>";
                        echo "<p class='text-muted'>" . htmlspecialchars($comentario['comentario']) . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No hay comentarios aún.</p>";
                } ?>
            </div>
        </div>
    <?php } ?>
</div>
<?php if (isset($_SESSION["usuario"])) {
    echo "<script src='recursos/scrips/AjaxComentarios.js'></script>"; } ?>
<?php include_once("recursos/view/shared/footer.html") ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
