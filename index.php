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
</head>
<body>
<?php include_once("recursos/view/shared/nav.php") ?>
    <hr>
    <div class="subTitulos text-center my-3">
        <?php foreach ($categoris as $cat) { ?>
           <a href="<?php echo "index.php?filtro=".$cat->id ?>"><?php echo $cat->nombre ?></a>
        <?php } ?>
    </div>
    <hr>
    <div class="desarrollo">
        <div class="container">
            <div id="contenedor-noticias" class="row">
            <?php foreach ($noticas as $entra) { ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo "/patronDiseño/panel/uploads/noticias/".$entra['imagen'] ?>" class="card-img-top" alt="Noticia">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $entra['titulo'] ?></h5>
                            <h6 class="card-text"><?php echo $entra['nombre'] ?></h6>
                            <p class="card-text"><?php
                            setlocale(LC_TIME, 'Spanish_Spain');
                            $dateTime = new DateTime($entra['fecha']);
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
    <script>
    let contador = 6;
    document.getElementById("ver-mas").addEventListener("click", async function() {
        const response = await fetch("recursos/controllers/verMas.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                traer : contador,
                <?php if (!empty($filtro)) {
                    echo "filtro: $filtro";
                } ?> 
            })
        });

        const noticias = await response.json();
        const contenedor = document.getElementById("contenedor-noticias");
        contador += 6;
        if (noticias.length === 0) {
            let boton = document.getElementById("ver-mas");
            boton.disabled = true;
            boton.innerText = "No hay más noticias";
        } else {
            noticias.forEach(noticia => {
                const fecha = new Date(noticia.fecha);
                const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
                const fechaFormateada = new Intl.DateTimeFormat('es-ES', opciones).format(fecha);
                const noticiaHTML = `
                    <div class="col-md-4">
                        <div class="card">
                            <img src="/patronDiseño/panel/uploads/noticias/${noticia.imagen}" class="card-img-top" alt="Noticia">
                            <div class="card-body">
                                <h5 class="card-title">${noticia.titulo}</h5>
                                <h6 class="card-text">${noticia.nombre}</h6>
                                <p class="card-text">${fechaFormateada}</p>
                                <p class="card-text">${noticia.descripcion}</p>
                                <a href="detalle.php?id=${noticia.id}" class="btn btn-primary">Leer mas</a>
                            </div>
                        </div>
                    </div>
                `;
                contenedor.innerHTML += noticiaHTML;
            });
        }
    });
</script>
</body>
</html>