<?php 
$user=isset($_POST["gmail"])?$_POST["gmail"]:"";
$pass=isset($_POST["password"])?$_POST["password"]:"";
include_once("../../panel/controllers/users/usuariosOOP.php");
include_once("../../panel/include/connOOP.php");

$database = new DataBase("users","user");
$usuario= new Usuarios($database);

if($usuario->existe($user,$pass)){
    session_start();
    $_SESSION["usuario"]=$user;
    header("Location: ../../index.php");
    exit();
}else{
    header("Location: ../../index.php?error=1");
    exit();
}

