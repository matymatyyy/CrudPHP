<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/users/usuariosOOP.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$error = isset($_GET["error"]) ? $_GET["error"] : 0;
$elimino =0;
$gmail = isset($_GET["gmail"]) ? $_GET["gmail"] : "";
$actualizo=isset($_GET["actualizo"]) ? $_GET["actualizo"] : 0;
$estado= isset($_POST["estado"]) ? $_POST["estado"] : 0;

$database = new DataBase("users","user");
$usuarios= new Usuarios($database);

if (!empty($id)) { 
    if ($estado == 1) {
        $usuarios->estado($id);
    }
    if (!empty($gmail) && $usuarios->detele($id)) { #la accion de un if se agrego a la condicion del mismo
        $elimino = 1;
    }
}
$user= $usuarios->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>

</head>
<body>
<form action="menu.php">
        <input type="submit" value="Volver al menu">
    </form>
    <br>
    <div align="center">
        <?php if ($error==1 && $elimino==1) {
                echo "no se puedo eliminar a $gmail <br>";
        } 
            if ($elimino==1 && $error==0) {
                echo "se elimino a $gmail <br>";
        } 
            if ($error==1 && $actualizo==1) {
                echo "no se puedo actualizar a $gmail <br>";
        } 
            if ($actualizo==1 && $error==0) {
                echo "se actualizo a $gmail <br>";
        } 
            ?>
            <br>
        <table border="1" >
            <thead>
                <tr>
                    <th>Email</th>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($user as $usuario) { ?>
                <tr>
                    <td><?php echo "Gmail: ".$usuario->gmail."<br>"; ?></td>
                    <td><?php echo "ID: ".$usuario->id."<br>"; ?> </td>

                   <td>
                        <form method="POST" action="crudOOP.php?">
                            <input type="submit" value="<?php echo $usuario->eliminado ? 'Desactivo' : 'Activo'; ?>"><input type="hidden" name="id" value=<?php echo $usuario->id ?>>
                            <input type="hidden" name="estado" value="1">
                        </form>
                    </td>

                    <td><form align="center" action=<?php echo "registrar.php" ?> method="POST"><input value="Actualizar" type="submit"><input type="hidden" name="id" value=<?php echo $usuario->id ?>></form></td>
                    
                    <td><form action="crudOOP.php?elimino=1&gmail=<?php echo $usuario->gmail ?>" method="POST" align="center"><input type="submit" value="X"><input type="hidden" name="id" value=<?php echo $usuario->id ?>><input type="hidden" name="gmail" value=<?php echo $usuario->gmail ?>> </form></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>