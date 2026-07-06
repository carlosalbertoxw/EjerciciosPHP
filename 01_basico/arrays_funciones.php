<?php

/**
 * Funciones útiles para arrays
 * ----------------------------
 * PHP trae funciones muy potentes para transformar y filtrar listas.
 * Ejecuta con:  php arrays_funciones.php
 */

$numeros = [1, 2, 3, 4, 5, 6];

echo '== array_map: transformar cada elemento ==' . PHP_EOL;
// Multiplica por 2 cada número. Recibe una función y el array.
$dobles = array_map(fn($n) => $n * 2, $numeros);
echo implode(', ', $dobles) . PHP_EOL; // 2, 4, 6, 8, 10, 12


echo PHP_EOL . '== array_filter: quedarse solo con algunos ==' . PHP_EOL;
// Conserva solo los que cumplen la condición (los pares).
$pares = array_filter($numeros, fn($n) => $n % 2 === 0);
echo implode(', ', $pares) . PHP_EOL; // 2, 4, 6


echo PHP_EOL . '== array_reduce: combinar todo en un solo valor ==' . PHP_EOL;
// Suma todos los números partiendo de 0.
$total = array_reduce($numeros, fn($acumulado, $n) => $acumulado + $n, 0);
echo 'Total: ' . $total . PHP_EOL; // 21


echo PHP_EOL . '== Buscar dentro de un array ==' . PHP_EOL;
$frutas = ['manzana', 'pera', 'uva'];

var_dump(in_array('pera', $frutas));    // true  -> ¿existe el valor?
echo array_search('uva', $frutas) . PHP_EOL; // 2 -> ¿en qué posición está?


echo PHP_EOL . '== Claves y valores ==' . PHP_EOL;
$edades = ['Ana' => 25, 'Luis' => 30];
echo 'Claves: '  . implode(', ', array_keys($edades))   . PHP_EOL; // Ana, Luis
echo 'Valores: ' . implode(', ', array_values($edades)) . PHP_EOL; // 25, 30
