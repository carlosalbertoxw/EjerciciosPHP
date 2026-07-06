<?php

/**
 * Cadenas de texto (strings)
 * --------------------------
 * PHP incluye muchas funciones para trabajar con texto.
 * Ejecuta con:  php strings.php
 */

$texto = 'Hola Mundo';

echo 'Largo: '      . strlen($texto)      . PHP_EOL; // 10 caracteres
echo 'Mayúsculas: ' . strtoupper($texto)  . PHP_EOL; // HOLA MUNDO
echo 'Minúsculas: ' . strtolower($texto)  . PHP_EOL; // hola mundo


echo PHP_EOL . '== Buscar y reemplazar ==' . PHP_EOL;

// str_replace(qué busco, por qué lo cambio, dónde)
echo str_replace('Mundo', 'PHP', $texto) . PHP_EOL; // Hola PHP

// str_contains: ¿el texto contiene otra palabra? (PHP 8+)
var_dump(str_contains($texto, 'Mundo')); // true


echo PHP_EOL . '== Unir y separar ==' . PHP_EOL;

// Concatenar (unir) textos con el punto:
$nombre   = 'Carlos';
$apellido = 'Sánchez';
echo $nombre . ' ' . $apellido . PHP_EOL;

// Separar un texto en un array usando un separador:
$csv    = 'rojo,verde,azul';
$colores = explode(',', $csv);
echo $colores[1] . PHP_EOL; // verde

// Volver a unir un array en un texto:
echo implode(' - ', $colores) . PHP_EOL; // rojo - verde - azul


echo PHP_EOL . '== Limpiar espacios ==' . PHP_EOL;

$conEspacios = '   texto con espacios   ';
echo '[' . trim($conEspacios) . ']' . PHP_EOL; // quita espacios de los extremos
