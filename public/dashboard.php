<?php
session_start();
require_once "../src/database.php"; // Conexión a la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario_nombre"])) {
    header("Location: login.php");
    exit();
}

// Obtener registros de la tabla membresia
$query = "SELECT * FROM membresia ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - REFAM 2025</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo $_SESSION["usuario_nombre"]; ?> 🎉</h1>
        <a href="logout.php">Cerrar sesión</a>
        
        <h2>Formulario de Registro de Líderes y Auxiliares</h2>
        <h3>REFAM IPUC 4TA CALARCA</h3>
        <form action="procesar_registro.php" method="POST">
            <label for="nombre_completo">Nombre Completo:</label>
            <input type="text" id="nombre_completo" name="nombre_completo" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="correo_electronico">Correo Electrónico:</label>
            <input type="email" id="correo_electronico" name="correo_electronico" required>

            <label for="tiempo_bautizado">Tiempo de Bautizado:</label>
            <input type="text" id="tiempo_bautizado" name="tiempo_bautizado">

            <label for="promesado">¿Es Promesado?</label>
            <select id="promesado" name="promesado">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>

            <label for="experiencia_refam">Experiencia en REFAM:</label>
            <textarea id="experiencia_refam" name="experiencia_refam"></textarea>

            <label for="lugar_refam">¿Dónde das REFAM?</label>
            <input type="text" id="lugar_refam" name="lugar_refam">

            <label for="nivel_clase">Nivel y Clase:</label>
            <input type="text" id="nivel_clase" name="nivel_clase">

            <button type="submit">Registrar</button>
        </form>

        <h2>Registros de Miembros REFAM</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Tiempo Bautizado</th>
                    <th>Promesado</th>
                    <th>Experiencia en REFAM</th>
                    <th>Donde das REFAM</th>
                    <th>Nivel y Clase</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["nombre_completo"]; ?></td>
                    <td><?php echo $row["fecha_nacimiento"]; ?></td>
                    <td><?php echo $row["direccion"]; ?></td>
                    <td><?php echo $row["telefono"]; ?></td>
                    <td><?php echo $row["correo_electronico"]; ?></td>
                    <td><?php echo $row["tiempo_bautizado"]; ?></td>
                    <td><?php echo $row["promesado"] ? "Sí" : "No"; ?></td>
                    <td><?php echo $row["experiencia_refam"]; ?></td>
                    <td><?php echo $row["lugar_de_refam"]; ?></td>
                    <td><?php echo $row["nivel_clase"]; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
