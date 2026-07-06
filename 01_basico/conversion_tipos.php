<?php

/**
 * Conversión de tipos (casting)
 * -----------------------------
 * A veces necesitamos convertir un valor de un tipo a otro.
 * PHP puede hacerlo de forma automática o podemos forzarlo nosotros.
 * Ejecuta con:  php conversion_tipos.php
 */

echo '== Convertir a número ==' . PHP_EOL;

$textoNumero = '25';
$numero = (int) $textoNumero;   // convierte el texto "25" al número 25
echo $numero + 5 . PHP_EOL;     // 30

$textoDecimal = '3.5 kg';
echo (float) $textoDecimal . PHP_EOL; // 3.5 (toma la parte numérica del inicio)


echo PHP_EOL . '== Convertir a texto ==' . PHP_EOL;

$edad = 30;
$mensaje = 'Tengo ' . (string) $edad . ' años';
echo $mensaje . PHP_EOL;


echo PHP_EOL . '== Funciones de conversión ==' . PHP_EOL;

echo intval('100 pesos') . PHP_EOL; // 100
echo floatval('19.99')   . PHP_EOL; // 19.99


echo PHP_EOL . '== Comparación floja (==) vs estricta (===) ==' . PHP_EOL;

// == convierte los tipos antes de comparar (puede engañar).
var_dump(0 == 'texto');   // false en PHP 8 (antes era true, ¡ojo!)
var_dump('5' == 5);       // true  -> mismo valor
var_dump('5' === 5);      // false -> distinto tipo (texto vs número)

// Recomendación: usa siempre === para evitar sorpresas.
