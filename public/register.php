<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Líderes REFAM</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <form action="register_process.php" method="POST" class="form">
            <h2>Formulario de Registro Líderes y Auxiliares</h2>
            <h3>REFAM IPUC 4TA CALARCA</h3>
            <p>Por favor, completa los datos correctamente.</p>
            
            <label>Nombre Completo:</label>
            <input type="text" name="nombre_completo" required>

            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" required>

            <label>Dirección:</label>
            <input type="text" name="direccion" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" pattern="[0-9]{10}" required>

            <label>Correo Electrónico:</label>
            <input type="email" name="correo_electronico" required>

            <label>Tiempo de Bautizado:</label>
            <input type="text" name="tiempo_bautizado">

            <label>Promesado:</label>
            <select name="promesado">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>

            <label>Experiencia en REFAM:</label>
            <textarea name="experiencia_refam"></textarea>

            <label>¿Dónde das REFAM?:</label>
            <input type="text" name="lugar_de_refam">

            <label>Nivel y Clase:</label>
            <input type="text" name="nivel_clase">

            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
