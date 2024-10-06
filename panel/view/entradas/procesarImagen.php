<?php
function ProcesarImag($text = "") {
    if (isset($_FILES["file"]) && empty($text)) {
        $file = $_FILES["file"]; 
        $fileName = date('Y-m-d_H-i-s') . "_" . basename($file["name"]); # agregamos la fecha al nombre para que no tengamos duplicados
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; # verificamos el tipo del archivo y su extension

        $uploadDir = "../../uploads/noticias";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777); 
        }

        if (!in_array($file["type"], $allowedTypes)) {
            return "Tipo de archivo no permitido";
        }

        if (move_uploaded_file($file["tmp_name"], "$uploadDir/$fileName")) {
            return $fileName; 
        } else {
            return "error"; 
        }
    } else {
        return $text; # si no hay imagen devolvemos el mismo nombre de la que ya tenia antes
    }
}
