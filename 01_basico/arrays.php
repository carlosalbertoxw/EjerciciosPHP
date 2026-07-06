<?php

/**
 * Arrays (listas)
 * ---------------
 * Un array guarda varios valores dentro de una sola variable.
 * Ejecuta con:  php arrays.php
 */

echo '== Array simple (indexado) ==' . PHP_EOL;

// Los elementos se numeran automáticamente empezando en 0.
$frutas = ['manzana', 'pera', 'plátano'];

echo $frutas[0] . PHP_EOL; // manzana
echo $frutas[2] . PHP_EOL; // plátano

// Agregar un elemento al final:
$frutas[] = 'uva';

echo 'Total de frutas: ' . count($frutas) . PHP_EOL;


echo PHP_EOL . '== Array asociativo (clave => valor) ==' . PHP_EOL;

// En vez de números, usamos nombres (claves) para identificar cada valor.
$persona = [
    'nombre' => 'Carlos',
    'edad'   => 30,
    'ciudad' => 'México',
];

echo $persona['nombre'] . PHP_EOL; // Carlos
echo $persona['edad']   . PHP_EOL; // 30

// Recorrer un array asociativo con foreach:
foreach ($persona as $clave => $valor) {
    echo "$clave: $valor" . PHP_EOL;
}


echo PHP_EOL . '== Algunas funciones útiles ==' . PHP_EOL;

$numeros = [5, 2, 8, 1, 9];

echo 'Cantidad: ' . count($numeros)   . PHP_EOL; // 5
echo 'Suma: '     . array_sum($numeros) . PHP_EOL; // 25
echo 'Máximo: '   . max($numeros)      . PHP_EOL; // 9
echo 'Mínimo: '   . min($numeros)      . PHP_EOL; // 1

sort($numeros); // ordena de menor a mayor
echo 'Ordenados: ' . implode(', ', $numeros) . PHP_EOL; // 1, 2, 5, 8, 9
