<?php
/**
 * Galería de la librería GD
 * -------------------------
 * Página que muestra dos imágenes de ejemplo y las mismas imágenes ya
 * transformadas por gd.php (proporcional, recortada, estirada y texto).
 * Cada versión transformada se pide a visor.php mediante un <img src="...">.
 *
 * Cómo probar:
 *   docker compose up web
 *   abre http://localhost:8080/06_libreria_GD/
 */

// Imágenes de ejemplo incluidas en la carpeta.
$imagenes = ['image1.jpg', 'image2.jpg'];

// Transformaciones disponibles: etiqueta => valor del parámetro ?type=
$transformaciones = [
    'Original'     => null,
    'Proporcional' => 'proporcional',
    'Recortada'    => 'cortar',
    'Estirada'     => 'estrechar',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería GD</title>
</head>
<body>
    <h1>Manipulación de imágenes con GD</h1>
    <p>Cada fila muestra la transformación aplicada a las imágenes de ejemplo.</p>

    <table cellpadding="8">
        <?php foreach ($transformaciones as $etiqueta => $type): ?>
            <tr>
                <th colspan="2" style="text-align:left"><?= $etiqueta ?></th>
            </tr>
            <tr>
                <?php foreach ($imagenes as $img): ?>
                    <td>
                        <?php if ($type === null): ?>
                            <img src="<?= $img ?>" width="200" alt="original">
                        <?php else: ?>
                            <img src="visor.php?type=<?= $type ?>&img-name=<?= $img ?>" alt="<?= $etiqueta ?>">
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

        <!-- Fila especial: imagen generada a partir de un texto -->
        <tr>
            <th colspan="2" style="text-align:left">Texto</th>
        </tr>
        <tr>
            <td colspan="2">
                <img src="visor.php?type=text-img&img-name=Hola+desde+GD" alt="texto">
            </td>
        </tr>
    </table>
</body>
</html>
