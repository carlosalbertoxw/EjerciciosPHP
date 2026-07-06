<?php

/**
 * Expresiones regulares (introducción)
 * ------------------------------------
 * Una expresión regular es un "patrón" para buscar o validar texto.
 * En PHP se escriben entre delimitadores, normalmente barras: /patrón/
 * Ejecuta con:  php expresiones_regulares.php
 */

echo '== preg_match: ¿el texto cumple el patrón? ==' . PHP_EOL;

// \d = un dígito, + = uno o más. Este patrón busca un número dentro del texto.
$texto = 'Mi pedido es el 12345';
if (preg_match('/\d+/', $texto, $coincidencias)) {
    echo 'Número encontrado: ' . $coincidencias[0] . PHP_EOL; // 12345
}


echo PHP_EOL . '== Validar un formato completo ==' . PHP_EOL;
// ^ = inicio, $ = fin. Así exigimos que TODO el texto cumpla el patrón.
$codigoPostal = '28080';
$esValido = preg_match('/^\d{5}$/', $codigoPostal); // exactamente 5 dígitos
echo $esValido ? 'Código postal válido' : 'No válido';
echo PHP_EOL;


echo PHP_EOL . '== Validar un email sencillo ==' . PHP_EOL;
$email = 'correo@ejemplo.com';
$patronEmail = '/^[^@\s]+@[^@\s]+\.[^@\s]+$/';
echo preg_match($patronEmail, $email) ? 'Email válido' : 'Email no válido';
echo PHP_EOL;


echo PHP_EOL . '== preg_replace: buscar y reemplazar con patrón ==' . PHP_EOL;
// Reemplaza todos los dígitos por un asterisco.
echo preg_replace('/\d/', '*', 'Tel: 555-1234') . PHP_EOL; // Tel: ***-****
