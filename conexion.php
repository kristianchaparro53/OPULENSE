Luis Borja
<?php
// Archivo: conexion.php

$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root";
$password = "";
$dbname = "prueba";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa!";
}

?>