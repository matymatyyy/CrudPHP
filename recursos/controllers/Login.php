<?php 
$user=isset($_POST["gmail"])?$_POST["gmail"]:"";
$pass=isset($_POST["password"])?$_POST["password"]:"";
include_once("../../panel/controllers/users/usuariosOOP.php");
include_once("../../panel/include/connOOP.php");

$database = new DataBase("users");
$usuario= new Usuarios($database,"user");
$datos=$usuario->existe($user,$pass);

if($datos->num_rows > 0){
    session_start();
    $_SESSION["usuario"]=$datos->fetch_object()->id;
    header("Location: ../../index.php");
    exit();
}else{
    header("Location: ../view/users/inicioSesion.php");
    exit();
}

