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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="/patronDiseño/recursos/img/ch.png" alt="Logo" width="50" height="44" class="d-inline-block align-text-center">
                <span class="ms-2">CH Informa</span>
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <?php
                        setlocale(LC_TIME, 'spanish');
                        echo strftime("%e de %B de %Y"); #mostramos la fehca de hoy
                        ?>
                    </li>
                </ul>

                <?php if (isset($_SESSION["usuario"])) { ?>
                    <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/controllers/eliminarSesion.php">Cerrar sesion</a>
                <?php }else{ ?>
                    <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/view/users/inicioSesion.php">Iniciar sesion</a>
                <?php } ?>
            </div>
        </div>
    </nav>
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
<footer class="bg-light text-dark pt-3 pb-3"><!-- tanto footer como nav se repiten varias veces por lo cual abria que hacer un archivo 1 vez y despues incluirlo en la view -->
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