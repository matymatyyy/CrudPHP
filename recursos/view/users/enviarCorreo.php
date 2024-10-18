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
$apellido = isset($_POST['apellido']) ? $_POST["apellido"] : "";
$email = isset($_POST['gmail']) ? $_POST["gmail"] : "";  
$asunto = isset($_POST['asunto']) ? $_POST["asunto"] : "";
$mensaje = isset($_POST['mensaje']) ? $_POST["mensaje"] : "";

if (empty(trim($nombre))) $nombre = 'anonimo';
if (empty(trim($apellido))) $apellido = '';

// Generar un token de confirmación
$token = bin2hex(random_bytes(16));  // Token aleatorio para el usuario

// Inicializar PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'matydominguez55@gmail.com';  // Correo de envío
    $mail->Password = 'dcto tabs oxel lrlj';  // Contraseña de la cuenta
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Configurar el correo de envío y el destinatario
    $mail->setFrom("matydominguez55@gmail.com", 'Matias');  // Desde tu propio correo
    $mail->addAddress($email);  // Correo del usuario registrado

    // Contenido del correo
    $mail->isHTML(true);  // Indicar que el contenido es HTML
    $mail->Subject = 'Confirma tu registro';
    $mail->Body    = "Gracias por registrarte. Por favor, confirma tu cuenta haciendo clic en el siguiente enlace: 
                      <a href='https://tu-dominio.com/confirmar.php?token=$token'>Confirmar cuenta</a>";

    // Enviar el correo
    $mail->send();
    echo 'El correo de confirmación ha sido enviado';
} catch (Exception $e) {
    echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
}
?>
