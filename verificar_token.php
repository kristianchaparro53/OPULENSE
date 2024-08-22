<?php
include('db.php');

if (isset($_POST['token'])) {
    $token = mysqli_real_escape_string($conexion, $_POST['token']);

    // Verificar el token en la base de datos
    $consulta = "SELECT * FROM personal WHERE token = '$token' AND token_expiration > NOW()";
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    $user = mysqli_fetch_assoc($resultado);

    if ($user) {
        // Limpiar el token después de la verificación
        $update_query = "UPDATE personal SET token = NULL, token_expiration = NULL WHERE token = '$token'";
        mysqli_query($conexion, $update_query);

        echo 'Autenticación exitosa. Bienvenido a tu cuenta.';
        header("Location: home2.html");
        exit();
    } else {
        echo 'Código incorrecto o expirado. Por favor, intenta nuevamente.';
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
} else {
    echo "No se ha proporcionado un código.";
}
?>
