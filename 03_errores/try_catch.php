<?php

/**
 * Manejo de errores con try / catch
 * ---------------------------------
 * Cuando algo puede fallar, lo ponemos dentro de "try". Si ocurre un error
 * (una excepción), PHP salta al bloque "catch" en vez de detener el programa.
 * "finally" (opcional) se ejecuta siempre, haya error o no.
 * Ejecuta con:  php errores/try_catch.php
 */

function dividir($a, $b) {
    if ($b === 0) {
        // "lanzamos" un error describiendo qué pasó.
        throw new InvalidArgumentException('No se puede dividir entre cero');
    }
    return $a / $b;
}

echo '== Caso correcto ==' . PHP_EOL;
try {
    echo dividir(10, 2) . PHP_EOL; // 5
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}


echo PHP_EOL . '== Caso con error ==' . PHP_EOL;
try {
    echo dividir(10, 0) . PHP_EOL; // esto lanza la excepción
    echo 'Esta línea NO se ejecuta' . PHP_EOL;
} catch (Exception $e) {
    // capturamos el error y mostramos un mensaje amigable.
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
} finally {
    echo '(finally: esto se ejecuta siempre)' . PHP_EOL;
}

echo PHP_EOL . 'El programa continúa normalmente.' . PHP_EOL;
