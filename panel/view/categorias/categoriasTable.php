<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 mx-auto">
    <?php if ($error == 1 && $elimino == 1) {
        echo "no se pudo eliminar a $nombre <br>";
    } 
    if ($elimino == 1 && $error == 0) {
        echo "se eliminó a $nombre <br>";
    } 
    if ($error == 1 && $actualizo == 1) {
        echo "no se pudo actualizar a $nombre <br>";
    } 
    if ($actualizo == 1 && $error == 0) {
        echo "se actualizó a $nombre <br>";
    } 
    if ($registro == 1) {
        echo "se registró $nombre";
    }
    ?> 
    <br>
    <form class="text-end" action="update.php">
        <input type="submit" value="+" class="btn btn-secondary">
    </form>
    <p class="text-center">Lista de Categorías</p>
    <table class="table table-striped table-dark mx-auto" style="width: 100%;">
        <thead>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Modificar</th>
                <th class="text-center">Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($categoria as $cat) { ?>
            <tr>
                <td class="text-center"><?php echo $cat->nombre; ?></td>
                
                <td class="text-center">
                    <form align="center" action="update.php?actualizar=1" method="POST">
                        <input value="Actualizar" type="submit" class="btn btn-secondary">
                        <input type="hidden" name="id" value="<?php echo $cat->id; ?>">
                    </form>
                </td>
                
                <td class="text-center">
                    <form action="categorias.php?elimino=1&nombre=<?php echo $cat->nombre; ?>" method="POST" align="center">
                        <input type="submit" class="btn btn-secondary" value="X">
                        <input type="hidden" name="id" value="<?php echo $cat->id; ?>">
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
