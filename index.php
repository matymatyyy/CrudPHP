<?php 
include_once("panel/controllers/entradas/entradasOOP.php");
include_once("panel/controllers/categorias/categoriasOOP.php");
include_once("panel/include/connOOP.php");

$database = new DataBase("users");
$entradas= new Entradas($database,"noticias");
$categorias= new Categorias($database,"categorias");

$categoris= $categorias->read();
$filtro=isset($_GET["filtro"])? $_GET["filtro"]:"";
session_start();

if (!empty($filtro)) {
    $noticas = $entradas->filtroAjax($filtro,0,6);
}else{
    $noticas = $entradas->readAjax(0,6);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticas</title>
    <link href="/patronDiseño/recursos/styles/index.css" rel="stylesheet">
    <link rel="icon" href="/patronDiseño/recursos/img/ch.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<?php include_once("recursos/view/shared/nav.php") ?>
    <hr>
    <div class="subTitulos row my-3" >
        <span id="contenerExtras" class="d-flex justify-content-center text-center flex-wrap gap-3">
        </span>
    </div>
    <hr>
    <div class="desarrollo">
        <div class="container">
            <?php if (!empty($filtro)) {
                if($cat = $categorias->read($filtro)){
                echo "<h1>$cat->nombre</h1><hr>";
                }
            } ?>
            <div id="contenedor-noticias" class="row">
            <?php foreach ($noticas as $entra) { ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo "/patronDiseño/panel/uploads/noticias/".$entra['imagen'] ?>" class="card-img-top" alt="Noticia">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $entra['titulo'] ?></h5>
                            <h6 class="card-text"><?php echo $entra['nombre'] ?></h6>
                            <p class="card-text"><?php
                            setlocale(LC_TIME, 'Spanish_Spain');#seteo de localidad 
                            $dateTime = new DateTime($entra['fecha']);#se muestra en el formato puesto
                            echo $fechaFormateada = strftime('%d de %B de %Y', $dateTime->getTimestamp()); ?></p>
                            <p class="card-text"><?php echo $entra['descripcion'] ?></p>
                            <a href="<?php echo "detalle.php?id=".$entra['id'] ?>" class="btn btn-primary">Leer mas</a>
                        </div>
                    </div>
                </div>
            <?php } if (count($noticas)==0) {
                echo "<div class='alert alert-warning' role='alert'>Noticias no encontradas.</div>";
            } ?>
            </div>
        </div>
    </div>
    <?php if(count($noticas)>5){
        echo "<button id='ver-mas' class='btn btn-secondary w-100'>Ver mas</button>";
    } ?>
<?php include_once("recursos/view/shared/footer.html") ?>
<script src="/patronDiseño/recursos/scrips/AjaxVerMas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/patronDiseño/recursos/scrips/dolaresApi.js"></script>
</body>
</html>