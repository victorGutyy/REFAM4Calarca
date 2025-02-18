<?php
session_start();
require_once '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Usuario administrador único
    $usuario_autorizado = "refamipuc4calarca@gmail.com";
    $password_autorizado = "refam2025";

    if ($correo == $usuario_autorizado && $password == $password_autorizado) {
        $_SESSION["usuario"] = $correo;
        header("Location: ../public/index.php");
        exit();
    } else {
        echo "Error: Credenciales incorrectas.";
    }
}
?>
