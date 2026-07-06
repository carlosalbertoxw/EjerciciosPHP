<?php

/**
 * Tipos de datos
 * --------------
 * PHP guarda distintos tipos de valores. var_dump() nos dice el tipo y el valor,
 * y gettype() nos da solo el nombre del tipo. Muy útil para depurar.
 * Ejecuta con:  php tipos_de_datos.php
 */

$entero  = 42;          // int    -> número sin decimales
$decimal = 3.14;        // float  -> número con decimales
$texto   = 'Hola';      // string -> texto
$logico  = true;        // bool   -> verdadero o falso
$nada    = null;        // null   -> "sin valor"
$lista   = [1, 2, 3];   // array  -> lista de valores

var_dump($entero);
var_dump($decimal);
var_dump($texto);
var_dump($logico);
var_dump($nada);
var_dump($lista);

echo PHP_EOL . '== Solo el nombre del tipo (gettype) ==' . PHP_EOL;
echo gettype($entero)  . PHP_EOL; // integer
echo gettype($decimal) . PHP_EOL; // double
echo gettype($texto)   . PHP_EOL; // string
echo gettype($logico)  . PHP_EOL; // boolean

echo PHP_EOL . '== Preguntar por un tipo ==' . PHP_EOL;
var_dump(is_int($entero));   // true
var_dump(is_string($texto)); // true
var_dump(is_array($lista));  // true
