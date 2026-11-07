<?php

declare(strict_types=1);

/**
 * Proyecto: Calculadora por línea de comandos
 * -------------------------------------------
 * Junta: argumentos de consola, match, funciones y manejo de errores.
 *
 * Uso:  php 09_proyectos/calculadora.php <numero> <operador> <numero>
 * Ejemplos:
 *   php 09_proyectos/calculadora.php 5 + 3
 *   php 09_proyectos/calculadora.php 10 x 4     (usa "x" para multiplicar)
 *   php 09_proyectos/calculadora.php 20 / 5
 *
 * $argv es un array con los argumentos que se escriben en la terminal.
 * $argv[0] es el nombre del script; los datos vienen desde $argv[1].
 */

// Si no se pasan los 3 datos, mostramos la ayuda y salimos.
if ($argc !== 4) {
    echo 'Uso: php 09_proyectos/calculadora.php <numero> <operador> <numero>' . PHP_EOL;
    echo 'Operadores válidos: +  -  x  /' . PHP_EOL;
    exit(1); // salir con código de error
}

// is_numeric comprueba el texto antes de convertirlo: (float) 'abc' daría 0 sin avisar.
function leerNumero(string $texto): float {
    if (!is_numeric($texto)) {
        throw new InvalidArgumentException("No es un número: $texto");
    }
    return (float) $texto;
}

try {
    $a        = leerNumero($argv[1]);
    $operador = $argv[2];
    $b        = leerNumero($argv[3]);

    $resultado = match ($operador) {
        '+' => $a + $b,
        '-' => $a - $b,
        'x' => $a * $b,
        '/' => $b !== 0.0 ? $a / $b : throw new InvalidArgumentException('No se puede dividir entre cero'),
        default => throw new InvalidArgumentException("Operador no válido: $operador"),
    };

    echo "$a $operador $b = $resultado" . PHP_EOL;
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
    exit(1);
}
