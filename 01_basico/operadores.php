<?php

/**
 * Operadores en PHP
 * -----------------
 * Este ejercicio muestra el RESULTADO de cada operador, no solo su sintaxis.
 * Ejecuta con:  php operadores.php
 */

echo '== Operadores aritméticos ==' . PHP_EOL;

$suma           = 5 + 5;   // 10
$resta          = 5 - 3;   // 2
$multiplicacion = 5 * 5;   // 25
$division       = 10 / 5;  // 2
$modulo         = 3 % 2;   // 1 (el resto de dividir 3 entre 2)
$potencia       = 2 ** 3;  // 8 (2 elevado a 3)

echo "Suma: $suma"                     . PHP_EOL;
echo "Resta: $resta"                   . PHP_EOL;
echo "Multiplicación: $multiplicacion" . PHP_EOL;
echo "División: $division"             . PHP_EOL;
echo "Módulo: $modulo"                 . PHP_EOL;
echo "Potencia: $potencia"             . PHP_EOL;


echo PHP_EOL . '== Operadores de comparación ==' . PHP_EOL;

$a = 5;
$b = '5'; // ojo: es un texto, no un número

// == compara solo el valor. === compara valor Y tipo de dato.
var_dump($a == $b);   // true  -> 5 y "5" valen lo mismo
var_dump($a === $b);  // false -> uno es número (int) y otro texto (string)
var_dump($a != 10);   // true  -> 5 es distinto de 10
var_dump($a > 3);     // true
var_dump($a <= 5);    // true


echo PHP_EOL . '== Operadores lógicos ==' . PHP_EOL;

$esMayor  = true;
$tieneINE = false;

// && (AND): verdadero solo si AMBOS lo son.
var_dump($esMayor && $tieneINE); // false

// || (OR): verdadero si AL MENOS UNO lo es.
var_dump($esMayor || $tieneINE); // true

// ! (NOT): invierte el valor.
var_dump(!$esMayor);             // false


echo PHP_EOL . '== Operadores de asignación ==' . PHP_EOL;

$contador = 10;
$contador += 5;  // igual que: $contador = $contador + 5  -> 15
$contador -= 3;  // 12
$contador *= 2;  // 24
echo "Contador: $contador" . PHP_EOL;

$texto = 'Hola';
$texto .= ' Mundo'; // .= concatena (une textos) -> "Hola Mundo"
echo "Texto: $texto" . PHP_EOL;


echo PHP_EOL . '== Incremento y decremento ==' . PHP_EOL;

$n = 5;
$n++; // ahora vale 6
$n++; // ahora vale 7
$n--; // ahora vale 6
echo "n: $n" . PHP_EOL;
