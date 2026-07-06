<?php

/**
 * Bucle while
 * -----------
 * Repite un bloque MIENTRAS la condición sea verdadera.
 * La condición se comprueba ANTES de cada vuelta.
 */

$x = 20;

// Se repite mientras $x sea mayor o igual a 10.
while ($x >= 10) {
    echo $x . PHP_EOL;
    $x--; // importante: modificar la variable para que el bucle termine
}
