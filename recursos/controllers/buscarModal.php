<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../../panel/include/connOOP.php");
    include_once("../../panel/controllers/entradas/entradasOOP.php");
    $data = json_decode(file_get_contents("php://input"), true);
    $busqueda = isset($data["busqueda"]) ? $data["busqueda"]:"";
    $database = new DataBase("users");
    $entradas = new Entradas($database, "noticias");
    try{
        $resultado=$entradas->filtroBusca("","",$busqueda);
        echo json_encode($resultado);
    }catch(error){
        echo json_encode("0");
    }    
}