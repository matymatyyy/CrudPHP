<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["usuario"])) {
    include_once("../../panel/include/connOOP.php");
    include_once("../../panel/controllers/entradas/entradasOOP.php");
    $database = new DataBase("users");
    $entradas = new Entradas($database, "noticias");
    $data = json_decode(file_get_contents("php://input"), true);
    $noticia_id = isset($data["id_noticia"]) ? $data["id_noticia"]:"";
    $comentarios= $entradas->obtenerComentarios($noticia_id);
    echo json_encode($comentarios);
}