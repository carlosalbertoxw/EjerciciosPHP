<?php

/**
 * Constantes
 * ----------
 * Una constante es un valor que se define una vez y NO cambia durante el programa.
 * Por convención se escriben en MAYÚSCULAS.
 * Ejecuta con:  php constantes.php
 */

// Forma 1: con define()
define('NOMBRE_APP', 'Mi Aplicación');
define('VERSION', '1.0');

// Forma 2: con const (debe ir en el nivel principal del archivo)
const MAX_INTENTOS = 3;

echo NOMBRE_APP . PHP_EOL;   // Mi Aplicación
echo 'Versión: ' . VERSION . PHP_EOL;
echo 'Intentos permitidos: ' . MAX_INTENTOS . PHP_EOL;

// A diferencia de las variables, las constantes NO llevan el símbolo $.
// Si intentáramos cambiarlas, PHP daría un error.

echo PHP_EOL . '== Constantes que ya trae PHP ==' . PHP_EOL;
echo 'Versión de PHP: ' . PHP_VERSION . PHP_EOL;
echo 'Número máximo (int): ' . PHP_INT_MAX . PHP_EOL;
