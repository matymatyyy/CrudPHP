<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 mx-auto">
    <?php if ($error == 1 && $elimino == 1) {
        echo "no se pudo eliminar a $titulo <br>";
    } 
    if ($elimino == 1 && $error == 0) {
        echo "se eliminó a $titulo <br>";
    } 
    if ($error == 1 && $actualizo == 1) {
        echo "no se pudo actualizar a $titulo <br>";
    } 
    if ($actualizo == 1 && $error == 0) {
        echo "se actualizó a $titulo <br>";
    } 
    if ($registro == 1) {
        echo "se registró $titulo <br>";
    }
    ?> 

    <br>

    <div class="d-flex justify-content-between">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filtros
            </button>
            <ul class="dropdown-menu p-3" style="min-width: 300px;">
                <form method="GET" action="entradas.php">
                    <div class="mb-3">
                        <label for="filtroTitulo" class="form-label">Filtrar por Titulo</label>
                        <input type="text" name="filtroTitulo" id="filtroTitulo" class="form-control" placeholder="Ingrese titulo">
                    </div>
                    <div class="mb-3">
                        <label for="filtroRedactor" class="form-label">Filtrar por Redactor</label>
                        <input type="text" name="filtroRedactor" id="filtroRedactor" class="form-control" placeholder="Ingrese redactor">
                    </div>
                    <div class="mb-3">
                        <label for="filtroCategoria" class="form-label">Filtrar por Categoria</label>
                        <select class="form-select" id="filtroCategoria" name="filtroCategoria">
                            <option selected value="">Seleccionar categoria</option>
                            <?php foreach ($categorias as $cat) { ?>
                                <option value="<?php echo $cat->id; ?>">
                                    <?php echo htmlspecialchars($cat->nombre, ENT_QUOTES); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="text-end">
                        <input type="submit" value="Filtrar" class="btn btn-primary">
                    </div>
                </form>
            </ul>
        </div>

        <form class="text-end" action="update.php">
            <input type="submit" value="+" class="btn btn-secondary">
        </form>
    </div>

    <p class="text-center">Lista de Entradas</p>
    <table class="table table-striped table-dark mx-auto" style="width: 100%;">
        <thead>
            <tr>
                <th class="text-center">Titulo</th>
                <th class="text-center">Descripcion</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Redactor</th>
                <th class="text-center">Categoria</th>
                <th class="text-center">Modificar</th>
                <th>Comentar</th>
                <th class="text-center">Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($entrada as $entra) { ?>
            <tr>
                <td class="text-center limit-text"><?php echo $entra->titulo; ?></td>
                <td class="text-center limit-text"><?php echo $entra->descripcion; ?></td>
                <td class="text-center limit-text"><?php echo $entra->fecha; ?></td>
                <td class="text-center"><?php echo $entra->gmail; #el nombre del user/admin esta como gmail ?></td>
                <td class="text-center limit-text"><?php echo $entra->nombre; ?></td>
                
                <td class="text-center">
                    <form align="center" action="update.php?actualizar=1" method="POST">
                        <input value="Actualizar" type="submit" class="btn btn-secondary">
                        <input type="hidden" name="id" value="<?php echo $entra->id; ?>">
                    </form>
                </td>
                <td>            
                    <form class="text-end" action="../comentarios/updateComentario.php" method="POST">
                        <input type="hidden" name="id_noticia" value="<?php echo $entra->id; ?>">
                        <input type="submit" value="Comentar" class="btn btn-secondary">
                    </form>
                </td>
                <td class="text-center">
                    <form action="entradas.php?elimino=1&titulo=<?php echo $entra->titulo; ?>" method="POST" align="center">
                        <input type="submit" class="btn btn-secondary" value="X">
                        <input type="hidden" name="id" value="<?php echo $entra->id; ?>">
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
