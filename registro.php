<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Procesamiento</title>
</head>
<body>
    <h1>Registro - Procesamiento de Datos</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];
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
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $correo = mysqli_real_escape_string($conexion, $correo);
        $password = mysqli_real_escape_string($conexion, $password);
        $mascota = mysqli_real_escape_string($conexion, $mascota);
        $auto = mysqli_real_escape_string($conexion, $auto);
        $numero = mysqli_real_escape_string($conexion, $numero);
        $trabajo = mysqli_real_escape_string($conexion, $trabajo);

        // Hash de la contraseña
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Consulta de inserción
        $consulta = "INSERT INTO personal (nombre, correo, password,mascota,auto,numero,trabajo) VALUES ('$nombre', '$correo', '$password_hash','$mascota','$auto','$numero','$trabajo')";

        if (mysqli_query($conexion, $consulta)) {
            echo "<p>Los datos se han insertado correctamente en la base de datos.</p>";
            header("Location: index.html");

        } else {
            echo "Error: " . $consulta . "<br>" . mysqli_error($conexion);
        }

        mysqli_close($conexion);
    } else {
        echo "<p>No se han recibido datos del formulario.</p>";
    }
    ?>

    <form action="registro.php" method="post">
        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
        <input type="hidden" name="correo" value="<?php echo htmlspecialchars($correo); ?>">
        <input type="hidden" name="password" value="<?php echo htmlspecialchars($password); ?>">
        <input type="submit" value="Guardar en la base de datos">
    </form>
</body>
</html>
