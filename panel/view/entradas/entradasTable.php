<div class="col-sm-12 col-md-8 col-lg-8 col-xl-4">
<?php if ($error==1 && $elimino==1) {
                    echo "no se puedo eliminar a $titulo <br>";
            } 
                if ($elimino==1 && $error==0) {
                    echo "se elimino a $titulo <br>";
            } 
                if ($error==1 && $actualizo==1) {
                    echo "no se puedo actualizar a $titulo <br>";
            } 
                if ($actualizo==1 && $error==0) {
                    echo "se actualizo a $titulo <br>";
            } if ($registro==1) {
                echo "se registro $titulo";
            }
                ?> 
<br>
                <form class="text-end" action="update.php">
                    <input type="submit" value="+" class="btn btn-secondary">
                </form>
                <p class="text-center">Lista de Entradas</p>
            <table class="table table-striped table-dark" >
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>ID</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($entrada as $entra) { ?>
                    <tr>
                        <td><?php echo $entra->titulo; ?></td>
                        <td><?php echo $entra->id; ?> </td>
                        
                        <td><form align="center" action=<?php echo "update.php?actualizar=1" ?> method="POST"><input value="Actualizar" type="submit" class="btn btn-secondary"><input type="hidden" name="id" value=<?php echo $entra->id ?>></form></td>
                        
                        <td><form action="entradas.php?elimino=1&titulo=<?php echo $entra->titulo ?>" method="POST" align="center"><input type="submit" class="btn btn-secondary" value="X"><input type="hidden" name="id" value=<?php echo $entra->id ?>></form></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>