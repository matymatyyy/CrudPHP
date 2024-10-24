<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../../panel/controllers/users/usuariosOOP.php");
    include_once("../../panel/include/connOOP.php");
    include_once("enviarPost.php");
    $data = json_decode(file_get_contents("php://input"), true);
    $gmail = isset($data["gmail"]) ? $data["gmail"] : "";
    $name = isset($data["name"]) ? $data["name"] : "";
    $pass = isset($data["password"]) ? $data["password"] : "";
    $database = new DataBase("users");
    $usuario= new Usuarios($database,"user");
    if (!empty($gmail) && !empty($pass) && !empty($name)) {
            if (!$usuario->duplicado($gmail)) {
                echo json_encode("1"); 
                $token = bin2hex(random_bytes(16));
                $usuario->newUser($gmail, $name, $pass, $token);
                $data = array("gmail" => $gmail, "nombre" => $name, "token" => $token);
                sendPost("http://localhost/patronDiseño/recursos/controllers/enviarCorreo.php", $data); 
            } else {
                echo json_encode("2");
            }
    } else {
        echo json_encode("0"); 
    }
}
