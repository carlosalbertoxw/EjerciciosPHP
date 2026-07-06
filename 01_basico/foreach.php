<?php

/**
 * Bucle foreach
 * -------------
 * Es la forma más cómoda de recorrer un array (una lista de valores).
 * No necesitamos un contador: PHP recorre todos los elementos por nosotros.
 */

$colores = ['rojo', 'verde', 'azul'];

// Solo el valor de cada elemento.
foreach ($colores as $color) {
    echo $color . PHP_EOL;
}

echo '---' . PHP_EOL;

// La clave (posición) y el valor de cada elemento.
foreach ($colores as $posicion => $color) {
    echo "$posicion => $color" . PHP_EOL;
}
