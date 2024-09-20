<?php
$user=isset($_POST["gmail"])?$_POST["gmail"]:"";
$pass=isset($_POST["password"])?$_POST["password"]:"";
include_once("../../controllers/users/usuariosOOP.php");

$database = new DataBase("users","user");
$usuario= new Usuarios($database);

if($usuario->existe($user,$pass)){
    session_start();
    $_SESSION["gmail"]=$user;
    header("Location: ../../view/users/menu.php");
    exit();
}else{
    header("Location: ../../index.php?error=1");
    exit();
}

