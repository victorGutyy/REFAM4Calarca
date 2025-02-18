<?php
session_start();
require_once(__DIR__ . "/../src/database.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario_nombre"])) {
    header("Location: login.php");
    exit();
}

// Obtener todos los registros de la base de datos
$sql = "SELECT * FROM membresia";
$resultado = $conn->query($sql);
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
        <form action="logout.php" method="POST">
                <button type="submit" class="boton-cerrar">Cerrar sesión</button>
            </form>

        <h2>Formulario de Registro de Líderes y Auxiliares</h2>
        <h3>REFAM IPUC 4TA CALARCA</h3>
        <form action="procesar_registro.php" method="POST">
            <input type="hidden" id="registro_id" name="registro_id">

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

            <button type="submit" id="boton_formulario">Registrar</button>
        </form>

        <h2>Registros Actuales</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Fecha de Nacimiento</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
                <th>Tiempo Bautizado</th>
                <th>Promesado</th>
                <th>Experiencia REFAM</th>
                <th>¿Dónde das REFAM?</th>
                <th>Nivel y Clase</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $resultado->fetch_assoc()) { ?>
                <tr id="fila_<?php echo $row["id"]; ?>">
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
                    <td>
                        <button class="boton-accion boton-editar" onclick='cargarRegistro(<?php echo json_encode($row); ?>)'>Editar</button>
                        <button class="boton-accion boton-eliminar" onclick="eliminarRegistro(<?php echo $row['id']; ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <script>
    function cargarRegistro(datos) {
        document.getElementById("registro_id").value = datos.id;
        document.getElementById("nombre_completo").value = datos.nombre_completo;
        document.getElementById("fecha_nacimiento").value = datos.fecha_nacimiento;
        document.getElementById("direccion").value = datos.direccion;
        document.getElementById("telefono").value = datos.telefono;
        document.getElementById("correo_electronico").value = datos.correo_electronico;
        document.getElementById("tiempo_bautizado").value = datos.tiempo_bautizado;
        document.getElementById("promesado").value = datos.promesado;
        document.getElementById("experiencia_refam").value = datos.experiencia_refam;
        document.getElementById("lugar_refam").value = datos.lugar_refam;
        document.getElementById("nivel_clase").value = datos.nivel_clase;

        // Cambiar el botón de "Registrar" a "Actualizar"
        document.getElementById("boton_formulario").innerText = "Actualizar";
    }

    function eliminarRegistro(id) {
        if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
            fetch("eliminar_registro.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Registro eliminado exitosamente");
                    document.getElementById("fila_" + id).remove();  // Eliminar fila en la tabla
                } else {
                    alert("Error al eliminar el registro");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    }
    </script>
</body>
</html>
