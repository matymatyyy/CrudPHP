<?php
$user=isset($_POST["gmail"])?$_POST["gmail"]:"";
$pass=isset($_POST["password"])?$_POST["password"]:"";
include_once("../../controllers/users/usuariosOOP.php");
include_once("../../include/connOOP.php");

$database = new DataBase("users","admin");
$usuario= new Usuarios($database);

if($usuario->existe($user,$pass)){
    session_start();
    $_SESSION["gmail"]=$user;
    header("Location: ../../view/crudOOP.php");
    exit();
}else{
    header("Location: ../../index.php?error=1");
    exit();
}

