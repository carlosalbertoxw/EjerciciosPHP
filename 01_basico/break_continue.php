<?php

/**
 * break y continue
 * ----------------
 * Dentro de un bucle:
 *   - break:    CORTA el bucle por completo y sale de él.
 *   - continue: SALTA el resto de esta vuelta y pasa a la siguiente.
 * Ejecuta con:  php break_continue.php
 */

echo '== break: detener al llegar al 5 ==' . PHP_EOL;

for ($i = 1; $i <= 10; $i++) {
    if ($i === 5) {
        break; // en cuanto $i vale 5, salimos del bucle
    }
    echo $i . PHP_EOL; // imprime 1, 2, 3, 4
}


echo PHP_EOL . '== continue: saltar los números pares ==' . PHP_EOL;

for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 === 0) {
        continue; // si es par, saltamos al siguiente número
    }
    echo $i . PHP_EOL; // imprime solo los impares: 1, 3, 5, 7, 9
}
