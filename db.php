<?php

$conexion = mysqli_connect("localhost", "root", "", "prueba");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

echo "Conexión exitosa";

?>
