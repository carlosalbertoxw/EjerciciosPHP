<?php
/**
 * Formularios con GET
 * -------------------
 * GET envía los datos en la URL (los ves después del signo ?).
 * Se usa para BUSCAR o filtrar, cuando no hay problema en que los datos se vean.
 * Ejemplo típico: un buscador.
 *
 * Cómo probar:
 *   docker compose up web
 *   abre http://localhost:8080/formularios/formulario_get.php
 *   al buscar, fíjate cómo cambia la URL a  ...?q=tu_busqueda
 */

// Leemos el término de búsqueda que viene en la URL (?q=...).
$q = trim($_GET['q'] ?? '');

// Una "base de datos" de ejemplo (en memoria).
$frutas = ['manzana', 'pera', 'plátano', 'piña', 'papaya', 'uva'];

// Filtramos las frutas que contienen el texto buscado.
$resultados = [];
if ($q !== '') {
    $resultados = array_filter(
        $frutas,
        fn($fruta) => stripos($fruta, $q) !== false // stripos: busca sin importar mayúsculas
    );
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario GET</title>
</head>
<body>
    <h1>Buscador (GET)</h1>

    <!-- method="get" pone los datos en la URL -->
    <form method="get">
        <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Buscar fruta...">
        <button type="submit">Buscar</button>
    </form>

    <?php if ($q !== ''): ?>
        <p>Resultados para "<strong><?= htmlspecialchars($q) ?></strong>":</p>
        <ul>
            <?php if (count($resultados) === 0): ?>
                <li>Sin resultados.</li>
            <?php else: ?>
                <?php foreach ($resultados as $fruta): ?>
                    <li><?= htmlspecialchars($fruta) ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
