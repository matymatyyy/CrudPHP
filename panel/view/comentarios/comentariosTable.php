<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <?php if ($elimino==1) {
        echo "<p>Se elimino el comentario de $userComentario</p>";
    }else if($actualizo==1){
        echo  "<p>Se Actualizo el comentario</p>";
    } ?>
            <br>
            <form class="text-end" action="updateComentario.php">
                <input type="submit" value="+" class="btn btn-secondary">
            </form>
            <p class="text-center">Lista de Comentarios</p>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Comentario</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Noticia</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($comentario  as $coment) { ?>
                    <tr>
                        <td class="limit-text"><?php echo htmlspecialchars($coment -> comentario); ?></td>
                        <td class="limit-text"><?php echo htmlspecialchars($coment -> fecha); ?></td>
                        <td class="limit-text"><?php echo $coment->name ; ?></td>
                        <td class="limit-text"><?php echo $coment->titulo ; ?></td>
                        <td>
                            <form align="center" action="updateComentario.php?actualizo=1" method="POST">
                                <input value="Actualizar" type="submit" class="btn btn-secondary">
                                <input type="hidden" name="id" value="<?php echo $coment -> id ; ?>">
                            </form>
                        </td>
                        <td>
                            <form action="comentarios.php?elimino=1"  method="POST" align="center">
                                <input type="submit" class="btn btn-secondary" value="X">
                                <input type="hidden" name="id" value="<?php echo $coment -> id ; ?>">
                                <input type="hidden" name="user" value="<?php echo $coment -> name ; ?>">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>