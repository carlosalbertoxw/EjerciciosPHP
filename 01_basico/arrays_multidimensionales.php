<?php

/**
 * Arrays multidimensionales
 * -------------------------
 * Son arrays que contienen otros arrays. Sirven para representar tablas,
 * listas de registros, etc.
 * Ejecuta con:  php arrays_multidimensionales.php
 */

// Una lista de alumnos; cada alumno es un array asociativo.
$alumnos = [
    ['nombre' => 'Ana',   'edad' => 25, 'promedio' => 9.1],
    ['nombre' => 'Luis',  'edad' => 30, 'promedio' => 8.4],
    ['nombre' => 'Marta', 'edad' => 22, 'promedio' => 9.8],
];

echo '== Recorrer la tabla ==' . PHP_EOL;
foreach ($alumnos as $alumno) {
    echo "{$alumno['nombre']} ({$alumno['edad']} años) - promedio: {$alumno['promedio']}" . PHP_EOL;
}

echo PHP_EOL . '== Acceder a un dato concreto ==' . PHP_EOL;
// Primer alumno, su nombre:
echo $alumnos[0]['nombre'] . PHP_EOL; // Ana


echo PHP_EOL . '== Un ejemplo tipo matriz (filas y columnas) ==' . PHP_EOL;
$tablero = [
    ['X', 'O', 'X'],
    ['O', 'X', 'O'],
    ['X', 'O', 'X'],
];

foreach ($tablero as $fila) {
    echo implode(' | ', $fila) . PHP_EOL;
}
