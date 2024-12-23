<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
            <?php if ($error == 1 && $elimino == 1) {
                echo "No se pudo eliminar a $gmail <br>";
            } 
            if ($elimino == 1 && $error == 0) {
                echo "Se eliminó a $gmail <br>";
            } 
            if ($error == 1 && $actualizo == 1) {
                echo "No se pudo actualizar a $gmail <br>";
            } 
            if ($actualizo == 1 && $error == 0) {
                echo "Se actualizó a $gmail <br>";
            } 
            ?>
            <br>
            <form class="text-end" action="users/registrar.php">
                <input type="submit" value="+" class="btn btn-secondary">
            </form>
            <p class="text-center">Lista de usuarios</p>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Users</th>
                        <th>Estado</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($user as $usuario) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario->gmail); ?></td>
                        <td class="limit-text"><?php echo htmlspecialchars($usuario->name); ?></td>
                        <td>
                            <form method="POST" action="crudOOP.php?" align="center">
                                <input type="submit" value="<?php echo $usuario->eliminado ? 'Desactivar' : 'Activar'; ?>" class="btn btn-secondary">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                <input type="hidden" name="estado" value="1">
                            </form>
                        </td>
                        <td>
                            <form align="center" action="users/registrar.php" method="POST">
                                <input value="Actualizar" type="submit" class="btn btn-secondary">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                            </form>
                        </td>
                        <td>
                            <form action="crudOOP.php?elimino=1&gmail=<?php echo urlencode($usuario->gmail); ?>" method="POST" align="center">
                                <input type="submit" class="btn btn-secondary" value="X">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                <input type="hidden" name="gmail" value="<?php echo htmlspecialchars($usuario->gmail); ?>">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>