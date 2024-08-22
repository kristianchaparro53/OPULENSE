<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';  // Asegúrate de que la ruta al archivo 'conexion.php' sea correcta

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Asegúrate de que la ruta sea correcta según tu estructura de directorios

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16)); // Genera un token aleatorio

    // Guardar el token en la base de datos junto con el correo
    $stmt = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    
    $resetLink = "http://localhost/validar/restablecer_contraseña.php?token=" . $token;

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'luisbirja556@gmail.com'; // Tu dirección de correo electrónico
        $mail->Password   = 'esqf ycdx iwdx hgst'; // Contraseña de aplicación generada
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom('luisbirja556@gmail.com', 'BORJA');
        $mail->addAddress($email); // Destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = 'Haz clic en el siguiente enlace para restablecer tu contraseña: <a href="' . $resetLink . '">Restablecer contraseña</a>';
        $mail->AltBody = 'Haz clic en el siguiente enlace para restablecer tu contraseña: ' . $resetLink;

        $mail->send();
        //echo "Correo de recuperación enviado. Por favor, revisa tu bandeja de entrada.";
    } catch (Exception $e) {
        echo "Error al enviar el correo. Mailerrrrr Error: {$mail->ErrorInfo}";
    }
}
?>