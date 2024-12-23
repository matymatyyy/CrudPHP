<?php 
include_once("../../panel/controllers/entradas/entradasOOP.php");
include_once("../../panel/include/connOOP.php");

$database = new DataBase("users");
$entradas = new Entradas($database, "noticias");

$data = json_decode(file_get_contents("php://input"), true);
$traer = isset($data["traer"]) ? $data["traer"] : 0;
$filtro = isset($data["filtro"]) ? $data["filtro"] : 0;

if (!empty($filtro)) {
    $noticas = $entradas->filtroAjax($filtro,$traer,6);
}else{
    $noticias = $entradas->readAjax($traer, 6);
}

if (empty($noticias)) {
    echo json_encode([]); #si esta vacio devolvemos un array vacio para que tire no hay mas noticas el boton
} else {
    echo json_encode($noticias); 
}
