<?php

declare(strict_types=1);

/**
 * Novedades recientes de PHP 8.4 y 8.5
 * ------------------------------------
 * Ejecuta con:  php 10_php_moderno/novedades_recientes.php
 */

echo '== Buscar en arrays sin escribir un bucle (PHP 8.4) ==' . PHP_EOL;

$numeros = [3, 8, 12, 5];
$esMayorQueDiez = fn(int $n): bool => $n > 10;

var_dump(array_find($numeros, $esMayorQueDiez));  // 12: el primero que cumple
var_dump(array_any($numeros, $esMayorQueDiez));   // true: alguno cumple
var_dump(array_all($numeros, $esMayorQueDiez));   // false: no todos cumplen


echo PHP_EOL . '== new sin paréntesis extra (PHP 8.4) ==' . PHP_EOL;

class Saludo {
    public function texto(): string {
        return 'Hola';
    }
}

// Antes había que escribir (new Saludo())->texto().
echo new Saludo()->texto() . PHP_EOL;


echo PHP_EOL . '== Operador pipe |> (PHP 8.5) ==' . PHP_EOL;

// El resultado de cada paso pasa como argumento al siguiente, y se lee en orden.
$slug = '  Hola Mundo  '
    |> trim(...)
    |> strtolower(...)
    |> (fn(string $texto): string => str_replace(' ', '-', $texto));

echo $slug . PHP_EOL; // hola-mundo

// Sin el operador, habría que leerlo de adentro hacia afuera:
echo str_replace(' ', '-', strtolower(trim('  Hola Mundo  '))) . PHP_EOL;
