<?php
// Inicia tu conexión a la base de datos aquí
include 'conexion.php'; // Asegúrate de incluir la conexión a tu base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Verificar que el token es válido y obtener el email asociado
    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token=?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Actualizar la contraseña en la base de datos
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE personal SET password=? WHERE correo=?");
        $update_stmt->bind_param("ss", $hashed_password, $email);
        $update_stmt->execute();

        // Eliminar el token para evitar reutilización
        $delete_stmt = $conn->prepare("DELETE FROM password_resets WHERE token=?");
        $delete_stmt->bind_param("s", $token);
        $delete_stmt->execute();

        echo "Contraseña restablecida con éxito.";
    } else {
        echo "Token inválido o expirado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
</head>
<body>
    <form action="restablecer_contraseña.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <p>Nueva Contraseña <input type="password" placeholder="Ingrese su nueva contraseña" name="new_password" required></p>
        <p>Confirmar Contraseña <input type="password" placeholder="Confirme su nueva contraseña" name="confirm_password" required></p>
        <input type="submit" value="Restablecer Contraseña">
    </form>
</body>
</html>