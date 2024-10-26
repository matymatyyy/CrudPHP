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