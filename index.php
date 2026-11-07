<?php

declare(strict_types=1);

/**
 * Índice de los ejercicios que se ven en el navegador.
 * Los demás se ejecutan por consola: revisa el README.
 *
 * Cómo abrirlo:
 *   docker compose up web
 *   abre http://localhost:8080
 */

$ejercicios = [
    '05_formularios/formulario_post.php'  => 'Formulario con POST',
    '05_formularios/formulario_get.php'   => 'Formulario con GET (buscador)',
    '05_formularios/validar_datos.php'    => 'Validar datos con filter_var',
    '05_formularios/sesion_contador.php'  => 'Sesiones: contador de visitas',
    '06_libreria_GD/index.php'            => 'Imágenes con la librería GD',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicios de PHP</title>
</head>
<body>
    <h1>Ejercicios de PHP para el navegador</h1>
    <ul>
        <?php foreach ($ejercicios as $ruta => $titulo): ?>
            <li><a href="<?= htmlspecialchars($ruta) ?>"><?= htmlspecialchars($titulo) ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
