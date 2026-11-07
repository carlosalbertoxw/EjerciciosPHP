<?php

declare(strict_types=1);

/**
 * Validar datos de un formulario con filter_var
 * ---------------------------------------------
 * Nunca confíes en lo que llega del navegador: valida siempre en el servidor.
 * filter_var trae validadores probados para correos, enteros, URL, etc., así que
 * no hace falta escribir una expresión regular para cada caso.
 *
 * Cómo probar:
 *   docker compose up web
 *   abre http://localhost:8080/05_formularios/validar_datos.php
 */

$correo  = '';
$edad    = '';
$errores = [];
$enviado = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($enviado) {
    $correo = trim($_POST['correo'] ?? '');
    $edad   = trim($_POST['edad'] ?? '');

    if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
        $errores['correo'] = 'Escribe un correo válido.';
    }

    // Devuelve el entero, o false si no es un entero dentro del rango.
    $edadValida = filter_var($edad, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 0, 'max_range' => 120],
    ]);
    if ($edadValida === false) {
        $errores['edad'] = 'La edad debe ser un número entre 0 y 120.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validar datos</title>
</head>
<body>
    <h1>Validar datos con filter_var</h1>

    <?php if ($enviado && $errores === []): ?>
        <p><strong>Datos correctos:</strong> <?= htmlspecialchars($correo) ?>, <?= htmlspecialchars($edad) ?> años.</p>
    <?php endif; ?>

    <form method="post">
        <p>
            <label>Correo: <input type="text" name="correo" value="<?= htmlspecialchars($correo) ?>"></label>
            <?php if (isset($errores['correo'])): ?>
                <strong><?= htmlspecialchars($errores['correo']) ?></strong>
            <?php endif; ?>
        </p>
        <p>
            <label>Edad: <input type="text" name="edad" value="<?= htmlspecialchars($edad) ?>"></label>
            <?php if (isset($errores['edad'])): ?>
                <strong><?= htmlspecialchars($errores['edad']) ?></strong>
            <?php endif; ?>
        </p>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
