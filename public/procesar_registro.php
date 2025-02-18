<?php
session_start();
require_once "../src/database.php"; // Asegúrate de que este archivo contiene la conexión a MySQL

// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario_nombre"])) {
    header("Location: login.php");
    exit();
}

// Validar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST["nombre_completo"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo_electronico = $_POST["correo_electronico"];
    $tiempo_bautizado = $_POST["tiempo_bautizado"] ?? NULL;
    $promesado = $_POST["promesado"];
    $experiencia_refam = $_POST["experiencia_refam"] ?? NULL;
    $lugar_refam = $_POST["lugar_refam"] ?? NULL;
    $nivel_clase = $_POST["nivel_clase"] ?? NULL;

    // Conectar a la base de datos
    $conexion = new mysqli("localhost", "root", "042485", "db_refam_calarca4");

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO membresia (nombre_completo, fecha_nacimiento, direccion, telefono, correo_electronico, 
            tiempo_bautizado, promesado, experiencia_refam, lugar_de_refam, nivel_clase) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssisss", $nombre_completo, $fecha_nacimiento, $direccion, $telefono, 
                      $correo_electronico, $tiempo_bautizado, $promesado, $experiencia_refam, 
                      $lugar_refam, $nivel_clase);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso.'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Error en el registro. Inténtalo de nuevo.'); window.history.back();</script>";
    }

    $stmt->close();
    $conexion->close();
}
?>
