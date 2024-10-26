<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["usuario"])) {
    include_once("../../panel/include/connOOP.php");
    include_once("../../panel/controllers/entradas/entradasOOP.php");
    $data = json_decode(file_get_contents("php://input"), true);
    $noticia_id = isset($data["id_noticia"]) ? $data["id_noticia"]:"";
    $id_usuario = $_SESSION["usuario"];
    $comentario = isset($data["comentario"]) ? $data["comentario"]:"";

    $database = new DataBase("users");
    $entradas = new Entradas($database, "noticias");
    try{
        $entradas->guardarComentario($noticia_id, $id_usuario, $comentario);
        echo json_encode("1");
    }catch(error){
        echo json_encode("0");
    }    
}
