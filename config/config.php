<?php
// Configuración de la conexión a la base de datos
$host = "localhost"; // Cambia esto si tu base de datos está en otro servidor
$dbname = "db_refam_calarca4";
$username = "root"; // Ajusta esto si tienes otro usuario
$password = "042485"; // Ingresa la contraseña de MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
