<?php
$host = "localhost";
$user = "root";
$password = "042485"; // Coloca aquí tu contraseña de MySQL
$database = "db_refam_calarca4";

$conexion = new mysqli($host, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
echo "✅ Conexión a la base de datos exitosa";
?>
