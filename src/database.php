<?php
$host = "localhost"; // Servidor
$user = "root"; // Usuario de MySQL
$password = "042485"; // Contraseña de MySQL
$database = "db_refam_calarca4"; // Nombre de la base de datos

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
