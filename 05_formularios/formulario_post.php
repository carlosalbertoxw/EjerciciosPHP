<?php
/**
 * Formularios con POST
 * --------------------
 * Muestra un formulario y, cuando el usuario lo envía, procesa los datos que
 * llegan en $_POST. POST se usa para ENVIAR o guardar datos (no se ven en la URL).
 *
 * Cómo probar:
 *   docker compose up web
 *   abre http://localhost:8080/formularios/formulario_post.php
 *
 * IMPORTANTE (seguridad): nunca confíes en lo que escribe el usuario.
 *   - htmlspecialchars() evita que inyecten HTML/JavaScript (ataque XSS).
 *   - ?? '' da un valor por defecto si el campo no vino.
 */

$nombre  = '';
$mensaje = '';

// $_SERVER['REQUEST_METHOD'] nos dice si la página se abrió normal (GET)
// o si se envió el formulario (POST).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leemos y limpiamos los datos recibidos.
    $nombre = trim($_POST['nombre'] ?? '');

    if ($nombre === '') {
        $mensaje = 'Por favor escribe tu nombre.';
    } else {
        // htmlspecialchars protege contra código malicioso en el nombre.
        $mensaje = '¡Hola, ' . htmlspecialchars($nombre) . '! Formulario recibido.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario POST</title>
</head>
<body>
    <h1>Formulario con POST</h1>

    <?php if ($mensaje !== ''): ?>
        <p><strong><?= htmlspecialchars($mensaje) ?></strong></p>
    <?php endif; ?>

    <!-- method="post" hace que los datos viajen ocultos, no en la URL -->
    <form method="post">
        <label>
            Nombre:
            <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>">
        </label>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
