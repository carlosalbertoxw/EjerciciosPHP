<?php

/**
 * Trabajar con CSV
 * ----------------
 * Un CSV es un archivo de texto donde los datos van separados por comas.
 * Es el formato típico para exportar/importar tablas (Excel, hojas de cálculo).
 * Ejecuta con:  php archivos/leer_csv.php
 */

$ruta = __DIR__ . '/personas.csv';

echo '== Escribir un CSV ==' . PHP_EOL;
// Abrimos el archivo en modo escritura ('w').
$archivo = fopen($ruta, 'w');
// El último parámetro ('') es el carácter de escape; en PHP 8.4 conviene indicarlo.
fputcsv($archivo, ['nombre', 'edad', 'ciudad'], ',', '"', ''); // fila de encabezados
fputcsv($archivo, ['Ana', 25, 'Madrid'], ',', '"', '');
fputcsv($archivo, ['Luis', 30, 'Lima'], ',', '"', '');
fclose($archivo);
echo 'CSV creado.' . PHP_EOL;


echo PHP_EOL . '== Leer un CSV fila por fila ==' . PHP_EOL;
$archivo = fopen($ruta, 'r'); // modo lectura ('r')

$encabezados = fgetcsv($archivo, 0, ',', '"', ''); // la primera fila son los títulos
echo 'Columnas: ' . implode(', ', $encabezados) . PHP_EOL;

// fgetcsv devuelve un array por cada fila; false cuando ya no hay más.
while (($fila = fgetcsv($archivo, 0, ',', '"', '')) !== false) {
    echo "- {$fila[0]}, {$fila[1]} años, {$fila[2]}" . PHP_EOL;
}
fclose($archivo);

unlink($ruta); // limpiamos el archivo de ejemplo
