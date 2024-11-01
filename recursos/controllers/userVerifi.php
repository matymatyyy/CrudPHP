<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["usuario"])) {
    $data = json_decode(file_get_contents("php://input"), true);
    $idUser = isset($data["id_user"]) ? $data["id_user"]:"";
    try{
        if ($idUser===$_SESSION["usuario"]) {
            echo json_encode(array("valido" => true));
        }else{
            echo json_encode(array("valido" => false));
        }
    }catch(error){
        echo json_encode(array("valido" => false));
    }    
}
