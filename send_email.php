<?php
// Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar autoload de Composer
require 'vendor/autoload.php';

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);
try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'luisbirja556@gmail.com'; // Corrección del error tipográfico
    $mail->Password = 'Borja1716';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinatarios
    $mail->setFrom('luisbirja556@gmail.com', 'Mailer');
    $mail->addAddress('luisbirja556@gmail.com', 'Recipient Name');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // Enviar el correo
    $mail->send();
    echo 'Ha sido enviado';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
