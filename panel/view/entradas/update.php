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
    $entra=$entradas->read($id);
    if ($actualizo==1 && !empty($titulo) && !empty($descripcion) && !empty($texto)) {
        $entradas->update($titulo,$descripcion,$texto,$categoria,$users,ProcesarImag($entra->imagen),$id);
        header("Location:/patronDiseño/panel/view/entradas/entradas.php?actualizo=1&titulo=$titulo");
        exit();
    }
}
$cat=$categorias->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
</head>
<body>
<div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1><?php echo empty($id) ? "Agregar" : "Actualizar"; ?></h1>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="<?php echo empty($id) ? "update.php?registro=1" : "update.php?actualizar=1"; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" 
                               <?php echo empty($id) ? "placeholder='Título'" : "value='" . htmlspecialchars($entra->titulo, ENT_QUOTES) . "'"; ?>>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" 
                               <?php echo empty($id) ? "placeholder='Descripción'" : "value='" . htmlspecialchars($entra->descripcion, ENT_QUOTES) . "'"; ?>>
                    </div>
                    <div class="form-group">
                        <label for="texto">Texto</label>
                        <textarea class="form-control" rows="5" name="texto" id="texto"><?php echo empty($id) ? "Desarrollo" : htmlspecialchars($entra->texto, ENT_QUOTES); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Elige una categoría:</label>
                        <select class="form-control" id="category" name="categoria">
                            <?php foreach ($cat as $cate) { ?>
                                <option value="<?php echo $cate->id ?>"><?php echo htmlspecialchars($cate->nombre, ENT_QUOTES); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">Sube una imagen:</label>
                        <input type="file" class="form-control-file" name="file" id="file" accept="image/*">
                    </div>
                    <?php if (!empty($id)) { ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <?php } ?>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                <br>
                <form action="/patronDiseño/panel/view/entradas/entradas.php">
                    <button type="submit" class="btn btn-secondary">Volver</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>