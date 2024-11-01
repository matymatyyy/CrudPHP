<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["usuario"])) {
    include_once("../../panel/include/connOOP.php");
    include_once("../../panel/controllers/comentarios/comentariosOOP.php");
    $data = json_decode(file_get_contents("php://input"), true);
    $comentarioID = isset($data["id_comentario"]) ? $data["id_comentario"]:"";

    $database = new DataBase("users");
    $comentarios=new Comentarios($database,"comentarios");
    try{
        $comentarios->delete($comentarioID);
        echo json_encode("1");
    }catch(error){
        echo json_encode("0");
    }    
}
