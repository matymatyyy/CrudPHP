<nav class="navbar navbar-light bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="mx-auto">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="/patronDiseño/recursos/img/ch.png" alt="Logo" width="50" height="44" class="d-inline-block align-text-center">
                <span class="ms-2">CH Informa</span>
            </a>
        </div>
        <div class="d-flex">
            <?php if (isset($_SESSION["usuario"])) { ?>
                <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/controllers/eliminarSesion.php">Cerrar sesión</a>
            <?php } else { ?>
                <a class="btn btn-primary" type="button" href="/patronDiseño/recursos/view/users/inicioSesion.php">Iniciar sesión</a>
            <?php } ?>
        </div>
    </div>
</nav>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    <div class="mx-auto">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="/patronDiseño/recursos/img/ch.png" alt="Logo" width="50" height="44" class="d-inline-block align-text-center">
                <span class="ms-2">CH Informa</span>
            </a>
        </div>
        <hr>
        <?php
                        setlocale(LC_TIME, 'spanish');
                        echo strftime("%e de %B de %Y"); #mostramos la fehca de hoy
                        ?>
        <hr>
        <ul class="navbar-nav">
        <?php foreach ($categoris as $cat) { ?>
                <li class="nav-item">
                    <a href="<?php echo "index.php?filtro=".$cat->id ?>" class="nav-link text-dark">
                        <?php echo $cat->nombre ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
