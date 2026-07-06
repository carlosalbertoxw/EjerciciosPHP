<?php

/**
 * Bucle do / while
 * ----------------
 * Parecido a while, pero la condición se comprueba AL FINAL.
 * Por eso el bloque siempre se ejecuta AL MENOS una vez.
 */

$x = 0;

do {
    $x++;
    echo $x . PHP_EOL;
} while ($x < 10);
