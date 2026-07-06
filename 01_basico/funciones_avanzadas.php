<?php

/**
 * Funciones avanzadas
 * -------------------
 * Formas más flexibles de trabajar con funciones.
 * Ejecuta con:  php funciones_avanzadas.php
 */

echo '== Paso por referencia (&) ==' . PHP_EOL;
// Normalmente una función recibe una COPIA. Con & modifica la variable original.
function incrementar(&$numero) {
    $numero++;
}
$x = 10;
incrementar($x);
echo $x . PHP_EOL; // 11 (se modificó la variable original)


echo PHP_EOL . '== Número variable de argumentos (...) ==' . PHP_EOL;
// Recibe todos los argumentos que le pasen, dentro de un array.
function sumarTodos(...$numeros) {
    return array_sum($numeros);
}
echo sumarTodos(1, 2, 3)       . PHP_EOL; // 6
echo sumarTodos(10, 20, 30, 40) . PHP_EOL; // 100


echo PHP_EOL . '== Funciones anónimas (closures) ==' . PHP_EOL;
// Una función guardada en una variable.
$multiplicar = function ($a, $b) {
    return $a * $b;
};
echo $multiplicar(4, 5) . PHP_EOL; // 20


echo PHP_EOL . '== Arrow functions (flecha) ==' . PHP_EOL;
// Versión corta de una función anónima. Ideal para operaciones simples.
$cuadrado = fn($n) => $n * $n;
echo $cuadrado(6) . PHP_EOL; // 36


echo PHP_EOL . '== Usar "use" para capturar una variable externa ==' . PHP_EOL;
$iva = 0.16;
$conIva = function ($precio) use ($iva) {
    return $precio + ($precio * $iva);
};
echo $conIva(100) . PHP_EOL; // 116
