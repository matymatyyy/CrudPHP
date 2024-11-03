<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["usuario"])) {
    include_once("../../panel/include/connOOP.php");
    include_once("../../panel/controllers/comentarios/comentariosOOP.php");
    $data = json_decode(file_get_contents("php://input"), true);
    $comentarioID = isset($data["id_comentario"]) ? $data["id_comentario"]:"";
    $user=$_SESSION["usuario"];

    $database = new DataBase("users");
    $comentarios=new Comentarios($database,"comentarios");
    try{
        $comentarios->deleteComentario($comentarioID,$user);
        echo json_encode("1");
    }catch(error){
        echo json_encode("0");
    }    
}
