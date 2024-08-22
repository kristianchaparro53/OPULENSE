<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $mascota = $_POST['mascota'];
    $auto = $_POST['auto'];
    $numero = $_POST['numero'];
    $trabajo = $_POST['trabajo'];

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
    $mascota = mysqli_real_escape_string($conexion, $mascota);
    $auto = mysqli_real_escape_string($conexion, $auto);
    $numero = mysqli_real_escape_string($conexion, $numero);
    $trabajo = mysqli_real_escape_string($conexion, $trabajo);

    // Consulta para insertar preguntas de seguridad
    $consulta = "UPDATE personal SET mascota='$mascota', auto='$auto', numero='$numero', trabajo='$trabajo' WHERE correo='$correo'";

    if (mysqli_query($conexion, $consulta)) {
        echo "Preguntas de seguridad guardadas correctamente.";
    } else {
        echo "Error: " . $consulta . "<br>" . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
