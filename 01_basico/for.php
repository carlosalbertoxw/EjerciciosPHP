<?php

/**
 * Bucle for
 * ---------
 * Se usa cuando sabemos CUÁNTAS veces queremos repetir algo.
 * Tiene tres partes: (inicio; condición; paso)
 */

// Cuenta del 0 al 10.
for ($i = 0; $i <= 10; $i++) {
    echo $i . PHP_EOL;
}

echo '---' . PHP_EOL;

// También puede contar hacia atrás (del 5 al 1).
for ($i = 5; $i >= 1; $i--) {
    echo $i . PHP_EOL;
}
