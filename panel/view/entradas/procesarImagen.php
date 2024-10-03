<?php
function ProcesarImag() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $target_dir = "/patronDiseño/panel/uploads/noticias/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        
        // Verificar si el archivo fue subido sin errores
        if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
            return "Error al subir el archivo: " . $_FILES["file"]["error"];
        }
        
        // Verificar si la carpeta de destino es escribible
        if (!is_writable($target_dir)) {
            return "Error: la carpeta de destino no tiene permisos de escritura.";
        }
        
        // Mover el archivo subido
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            return "El archivo se ha movido correctamente a: " . $target_file;
        } else {
            return "Error al mover el archivo. Verifique la ruta de destino: " . $target_file;
        }
    }
    return "No se envió ningún archivo.";
}
