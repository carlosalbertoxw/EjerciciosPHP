<?php

/**
 * Condicionales: if / else if / else
 * -----------------------------------
 * Sirven para ejecutar un bloque de código solo cuando se cumple una condición.
 */

$edad = 20;

// if simple: se ejecuta solo si la condición es verdadera.
if ($edad >= 18) {
    echo 'Eres mayor de edad' . PHP_EOL;
}

// if / else: uno u otro camino.
if ($edad >= 18) {
    echo 'Puedes votar' . PHP_EOL;
} else {
    echo 'Todavía no puedes votar' . PHP_EOL;
}

// if / else if / else: varias condiciones en cadena.
$nota = 8;

if ($nota >= 9) {
    echo 'Calificación: Excelente' . PHP_EOL;
} else if ($nota >= 7) {
    echo 'Calificación: Aprobado' . PHP_EOL;
} else {
    echo 'Calificación: Reprobado' . PHP_EOL;
}
