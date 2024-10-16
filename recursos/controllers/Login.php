<?php 
$user=isset($_POST["gmail"])?$_POST["gmail"]:"";
$pass=isset($_POST["password"])?$_POST["password"]:"";
include_once("../../panel/controllers/users/usuariosOOP.php");
include_once("../../panel/include/connOOP.php");

$database = new DataBase("users");
$usuario= new Usuarios($database,"user");

if($usuario->existe($user,$pass)->num_rows > 0){
    session_start();
    $_SESSION["usuario"]=$user;
    header("Location: ../../index.php");
    exit();
}else{
    header("Location: ../view/users/inicioSesion.php");
    exit();
}

