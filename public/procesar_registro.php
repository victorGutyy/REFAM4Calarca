<?php
session_start();
require_once "../src/database.php"; // Conexión a la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario_nombre"])) {
    header("Location: login.php");
    exit();
}

// Validar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["registro_id"]) ? $_POST["registro_id"] : null;
    $nombre_completo = $_POST["nombre_completo"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo_electronico = $_POST["correo_electronico"];
    $tiempo_bautizado = !empty($_POST["tiempo_bautizado"]) ? $_POST["tiempo_bautizado"] : NULL;
    $promesado = $_POST["promesado"];
    $experiencia_refam = !empty($_POST["experiencia_refam"]) ? $_POST["experiencia_refam"] : NULL;
    $lugar_refam = !empty($_POST["lugar_refam"]) ? $_POST["lugar_refam"] : NULL;
    $nivel_clase = !empty($_POST["nivel_clase"]) ? $_POST["nivel_clase"] : NULL;

    // Si existe un ID, actualizamos el registro; si no, insertamos uno nuevo
    if (!empty($id)) {
        $sql = "UPDATE membresia SET nombre_completo=?, fecha_nacimiento=?, direccion=?, telefono=?, 
                correo_electronico=?, tiempo_bautizado=?, promesado=?, experiencia_refam=?, 
                lugar_de_refam=?, nivel_clase=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssisssi", $nombre_completo, $fecha_nacimiento, $direccion, $telefono, 
                          $correo_electronico, $tiempo_bautizado, $promesado, $experiencia_refam, 
                          $lugar_refam, $nivel_clase, $id);
        $mensaje = "Registro actualizado correctamente.";
    } else {
        $sql = "INSERT INTO membresia (nombre_completo, fecha_nacimiento, direccion, telefono, correo_electronico, 
                tiempo_bautizado, promesado, experiencia_refam, lugar_de_refam, nivel_clase) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssisss", $nombre_completo, $fecha_nacimiento, $direccion, $telefono, 
                          $correo_electronico, $tiempo_bautizado, $promesado, $experiencia_refam, 
                          $lugar_refam, $nivel_clase);
        $mensaje = "Registro exitoso.";
    }

    if ($stmt->execute()) {
        echo "<script>alert('$mensaje'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Error en la operación. Inténtalo de nuevo.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
