<div class="col-sm-12 col-md-8 col-lg-8 col-xl-4">
<?php if ($error==1 && $elimino==1) {
                    echo "no se puedo eliminar a $nombre <br>";
            } 
                if ($elimino==1 && $error==0) {
                    echo "se elimino a $nombre <br>";
            } 
                if ($error==1 && $actualizo==1) {
                    echo "no se puedo actualizar a $nombre <br>";
            } 
                if ($actualizo==1 && $error==0) {
                    echo "se actualizo a $nombre <br>";
            } if ($registro==1) {
                echo "se registro $nombre";
            }
                ?> 
<br>
                <form class="text-end" action="update.php">
                    <input type="submit" value="+" class="btn btn-secondary">
                </form>
                <p class="text-center">Lista de Categorias</p>
            <table class="table table-striped table-dark" >
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($categoria as $cat) { ?>
                    <tr>
                        <td><?php echo $cat->nombre; ?></td>
                        
                        <td><form align="center" action=<?php echo "update.php?actualizar=1" ?> method="POST"><input value="Actualizar" type="submit" class="btn btn-secondary"><input type="hidden" name="id" value=<?php echo $cat->id ?>></form></td>
                        
                        <td><form action="categorias.php?elimino=1&nombre=<?php echo $cat->nombre ?>" method="POST" align="center"><input type="submit" class="btn btn-secondary" value="X"><input type="hidden" name="id" value=<?php echo $cat->id ?>></form></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>