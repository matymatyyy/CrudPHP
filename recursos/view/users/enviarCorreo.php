<?php 
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: /registrar.php" );
    exit();
}

require '../../librerias/PHPmailer/src/PHPMailer.php';
require '../../librerias/PHPmailer/src/Exception.php';
require '../../librerias/PHPmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

$nombre = isset($_POST['nombre']) ? $_POST["nombre"] : "";
$email = isset($_POST['gmail']) ? $_POST["gmail"] : "";
$token = isset($_POST["token"])? $_POST["token"]: "";  

if (empty(trim($nombre))) $nombre = 'anonimo';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; #servidor smtp de mail
    $mail->SMTPAuth = true;
    $mail->Username = 'matydominguez55@gmail.com';  
    $mail->Password = 'dcto tabs oxel lrlj';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom("matydominguez55@gmail.com", 'Matias');
    $mail->addAddress($email);

    $mail->isHTML(true); #indicamos que html el correo
    $mail->Subject = 'Confirma tu registro';
    $mail->Body    = "<h1>Gracias por registrarte $nombre</h1><br> Por favor, confirma tu cuenta haciendo clic en el siguiente enlace: <a href='http://localhost/patronDiseño/recursos/view/users/confirmar.php?token=$token'>Confirmar cuenta</a>";

    $mail->send();
} catch (Exception $e) {
    echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
}
?>
