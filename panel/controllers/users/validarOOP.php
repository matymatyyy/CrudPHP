<?php
$user=isset($_POST["gmail"])?$_POST["gmail"]:"";
$pass=isset($_POST["password"])?$_POST["password"]:"";
include_once("../../controllers/users/usuariosOOP.php");
include_once("../../include/connOOP.php");

$database = new DataBase("users");
$usuario= new Usuarios($database,"admin");
$existe=$usuario->existeAdmin($user,$pass);
$datos= $existe->fetch_object();

if($existe->num_rows > 0){
    session_start();
    $_SESSION["gmail"]=$datos->gmail;
    $_SESSION["id"]=$datos->id;
    header("Location: ../../view/crudOOP.php");
    exit();
}else{
    header("Location: ../../index.php?error=1");
    exit();
}

