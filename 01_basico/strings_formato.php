<?php

/**
 * Dar formato a textos y números
 * ------------------------------
 * Funciones para presentar la información de forma ordenada.
 * Ejecuta con:  php strings_formato.php
 */

echo '== sprintf: armar un texto con formato ==' . PHP_EOL;
// %s = texto, %d = número entero, %.2f = número con 2 decimales
$nombre = 'Ana';
$puntos = 1234;
$precio = 19.5;

echo sprintf('Jugador: %s | Puntos: %d | Precio: $%.2f', $nombre, $puntos, $precio) . PHP_EOL;


echo PHP_EOL . '== number_format: separar miles y decimales ==' . PHP_EOL;
echo number_format(1234567.891, 2, '.', ',') . PHP_EOL; // 1,234,567.89


echo PHP_EOL . '== str_pad: rellenar hasta cierto ancho ==' . PHP_EOL;
// Útil para alinear en columnas o para folios tipo 0007.
echo str_pad('7', 4, '0', STR_PAD_LEFT) . PHP_EOL; // 0007
echo str_pad('Ana', 10, '.', STR_PAD_RIGHT) . '|' . PHP_EOL; // Ana.......|


echo PHP_EOL . '== substr: recortar parte de un texto ==' . PHP_EOL;
$texto = 'Desarrollo';
echo substr($texto, 0, 7) . PHP_EOL;  // Desarro (desde la posición 0, 7 letras)
echo substr($texto, -5)   . PHP_EOL;  // rollo   (las últimas 5 letras)
// Nota: substr cuenta bytes. Para textos con acentos o ñ usa mb_substr().


echo PHP_EOL . '== ucfirst / ucwords: mayúsculas iniciales ==' . PHP_EOL;
echo ucfirst('hola mundo')  . PHP_EOL; // Hola mundo
echo ucwords('hola mundo')  . PHP_EOL; // Hola Mundo
