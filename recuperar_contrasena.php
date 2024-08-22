<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $respuesta = $_POST['respuesta'];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $database = "prueba";

    $conexion = mysqli_connect($servername, $username, $password_db, $database);

    if (!$conexion) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    // Escapar los datos para evitar inyección SQL
    $correo = mysqli_real_escape_string($conexion, $correo);
    $respuesta = mysqli_real_escape_string($conexion, $respuesta);

    // Seleccionar una pregunta al azar
    $preguntas = ["mascota"];
    $pregunta_seleccionada = $preguntas[array_rand($preguntas)];

    // Consulta para verificar la respuesta
    $consulta = "SELECT password FROM personal WHERE correo='$correo' AND $pregunta_seleccionada='$respuesta'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $password = $fila['password'];
        echo "<div class='password'>Tu contraseña es: " . htmlspecialchars($password) . "</div>";
        header("Location: home2.html");

    } else {
        //echo "<div class='password'>Correo o respuesta incorrecta.</div>";
        header("Location: recuperar.html");
        alert(" AHAA");

    }

    mysqli_close($conexion);
}
?>
