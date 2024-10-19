<?php
include_once("../../panel/include/connOOP.php");
include_once("../../panel/controllers/entradas/entradasOOP.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $noticia_id = $_POST['noticia_id'];
    $id_usuario = $_SESSION["usuario"];
    $comentario = $_POST['comentario'];

    $database = new DataBase("users");
    $entradas = new Entradas($database, "noticias");

    $entradas->guardarComentario($noticia_id, $id_usuario, $comentario);

    header("Location: /patronDiseño/detalle.php?id=".$noticia_id);
}
