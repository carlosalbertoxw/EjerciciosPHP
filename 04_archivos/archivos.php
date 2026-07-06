<?php

/**
 * Leer y escribir archivos de texto
 * ---------------------------------
 * PHP puede crear, leer y modificar archivos del disco.
 * Ejecuta con:  php archivos/archivos.php
 *
 * __DIR__ es la carpeta donde está este archivo. La usamos para guardar
 * el ejemplo junto a él sin importar desde dónde ejecutemos el script.
 */

$ruta = __DIR__ . '/ejemplo.txt';

echo '== Escribir un archivo ==' . PHP_EOL;
// file_put_contents crea (o reemplaza) el archivo con el texto indicado.
file_put_contents($ruta, "Primera línea\nSegunda línea\n");
echo "Archivo creado en: $ruta" . PHP_EOL;


echo PHP_EOL . '== Añadir más contenido (sin borrar lo anterior) ==' . PHP_EOL;
file_put_contents($ruta, "Tercera línea\n", FILE_APPEND);
echo 'Línea añadida' . PHP_EOL;


echo PHP_EOL . '== Leer todo el archivo ==' . PHP_EOL;
$contenido = file_get_contents($ruta);
echo $contenido;


echo PHP_EOL . '== Leer línea por línea ==' . PHP_EOL;
// file() devuelve un array con cada línea del archivo.
$lineas = file($ruta, FILE_IGNORE_NEW_LINES);
foreach ($lineas as $numero => $linea) {
    echo ($numero + 1) . ': ' . $linea . PHP_EOL;
}


// Limpiamos: borramos el archivo de ejemplo para no dejar basura.
unlink($ruta);
echo PHP_EOL . 'Archivo de ejemplo eliminado.' . PHP_EOL;
