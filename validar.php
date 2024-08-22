<?php
// Cargar el autoload de Composer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('db.php');

// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $USUARIO = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $PASSWORD = mysqli_real_escape_string($conexion, $_POST['password']);

    // Consultar el usuario
    $consulta = "SELECT * FROM personal WHERE correo = '$USUARIO'";
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    $user = mysqli_fetch_assoc($resultado);

    if ($user && password_verify($PASSWORD, $user['password'])) {
        // Generar un token único
        $token = bin2hex(random_bytes(16));
        $token_expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Actualizar el token y su fecha de expiración en la base de datos
        $update_query = "UPDATE personal SET token = '$token', token_expiration = '$token_expiration' WHERE correo = '$USUARIO'";
        if (mysqli_query($conexion, $update_query)) {
            // Enviar el token al correo electrónico del usuario usando PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'luisbirja556@gmail.com';
                $mail->Password = 'weit uska xznw lgll'; // Asegúrate de usar contraseñas seguras y configurarlas correctamente
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Destinatarios
                $mail->setFrom('luisbirja556@gmail.com', 'VALIDACIONES KASHO');
                $mail->addAddress($USUARIO);

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Tu código de autenticación';
                $mail->Body    = "Tu código de autenticación es: $token. Este código expirará en una hora.";

                $mail->send();
                echo 'El token ha sido enviado a tu correo electrónico.';
                header("Location: home2.html");

            } catch (Exception $e) {
                echo "No se pudo enviar el token. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error al actualizar el token en la base de datos: " . mysqli_error($conexion);
        }
    } else {
        echo 'Correo o contraseña incorrectos.';
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
}
?>
