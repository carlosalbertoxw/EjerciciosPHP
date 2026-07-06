<?php

/**
 * Funciones
 * ---------
 * Una función es un bloque de código con nombre que podemos reutilizar.
 * Recibe datos de entrada (parámetros) y normalmente devuelve un resultado
 * con "return".
 * Ejecuta con:  php funciones.php
 */

// Función que recibe un nombre y devuelve un saludo.
function saludar($nombre) {
    return "Hola, $nombre :)";
}

echo saludar('Carlos') . PHP_EOL;
echo saludar('Ana')    . PHP_EOL;


// Función con varios parámetros.
function sumar($a, $b) {
    return $a + $b;
}

echo 'Suma: ' . sumar(3, 4) . PHP_EOL; // 7


// Parámetro con valor por defecto: si no se envía, usa el valor indicado.
function saludarConIdioma($nombre, $idioma = 'es') {
    if ($idioma === 'en') {
        return "Hello, $nombre";
    }
    return "Hola, $nombre";
}

echo saludarConIdioma('Luis')       . PHP_EOL; // usa 'es' por defecto
echo saludarConIdioma('Luis', 'en') . PHP_EOL;


// Una función puede llamar a otra.
function esPar($numero) {
    return $numero % 2 === 0;
}

echo '¿4 es par? ';
echo esPar(4) ? 'Sí' : 'No';
echo PHP_EOL;
