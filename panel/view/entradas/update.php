<?php
include_once("../../include/verificarSesion.php");
include_once("../../controllers/entradas/entradasOOP.php");
include_once("../../controllers/categorias/categoriasOOP.php");
include_once("../../include/connOOP.php");
include_once("procesarImagen.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$actualizo=isset($_GET["actualizar"])?$_GET["actualizar"]:0;
$registro=isset($_GET["registro"])?$_GET["registro"]:0;
$titulo= isset($_POST["titulo"])?$_POST["titulo"]:"";
$descripcion= isset($_POST["descripcion"])?$_POST["descripcion"]:"";
$texto= isset($_POST["texto"])?$_POST["texto"]:"";
$categoria= isset($_POST["categoria"])?$_POST["categoria"]:"";
$users= 1;#falta el id users

$database = new DataBase("users","noticias");
$entradas= new Entradas($database);
$database = new DataBase("users","categorias");
$categorias= new Categorias($database);


#falta modificar todo el archivo para adaptarlo
if ($registro==1) {
    if ($entradas->create($titulo,$descripcion,$texto,$categoria,1,ProcesarImag())) {
        header("Location:/patronDiseño/panel/view/entradas/entradas.php");
        exit();
    }
}

if (!empty($id)) {
    if (!empty($nombre)) {
        $categorias->update($nombre,$id);
        header("Location:/patronDiseño/panel/view/categorias/categorias.php?actualizo=1&nombre=$nombre");
        exit();
    }
    $entra=$entradas->read($id);
}
$cat=$categorias->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
</head>
<body>
<div class="centrar">
        <?php echo empty($id) ?  "<h1>Agregar</h1>" :  "<h1>actualizar</h1>"; ?>
        <form class="formulario" method="POST" action=<?php echo empty($id) ?  "update.php?registro=1" :  "update.php?actualizar=1"; ?> enctype="multipart/form-data">
        <p class="error"></p>
            <input type="text" name="titulo" <?php echo empty($id) ?  "placeholder='titulo'" :  "value=$entra->titulo"; ?>>
            <input type="text" name="descripcion" <?php echo empty($id) ?  "placeholder='descripcion'" :  "value=$entra->descripcion"; ?>>
            <textarea type="text" name="texto" <?php echo empty($id) ?  "placeholder='desarrollo'" :  "value=$entra->texto"; ?>> </textarea>
            <label for="category">Elige una categoría:</label>
                <select id="category" name="categoria">
                <?php foreach($cat as $cate) { ?>
                    <option value=<?php echo $cate->id ?>><?php echo $cate->nombre ?></option>
                <?php } ?>
            </select>
            <input type="hidden" name="users" value=<?php echo $_SESSION["gmail"] ?> >
            <label for="file">Sube una imagen:</label>
            <input type="file" name="file" id="file" accept="image/*">
            <?php if (!empty($id)) { ?>
                <input type="hidden" name="id" value="<?php echo $id ?>">
            <?php } ?>
            <input type="submit">
        </form><br>
        <form action="/patronDiseño/panel/view/entradas/entradas.php">
        <input type="submit" value="volver">
    </form>
    </div>
</body>
</html>