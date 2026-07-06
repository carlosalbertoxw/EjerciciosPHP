<?php

/**
 * Estructura switch
 * -----------------
 * Compara una variable contra varios valores posibles (casos).
 * Es más limpio que muchos if/else if cuando comparamos LA MISMA variable.
 *
 * Importante: cada caso debe terminar con "break", si no, PHP seguiría
 * ejecutando los casos siguientes.
 */

$dia = 3;

switch ($dia) {
    case 1:
        echo 'Lunes' . PHP_EOL;
        break;
    case 2:
        echo 'Martes' . PHP_EOL;
        break;
    case 3:
        echo 'Miércoles' . PHP_EOL;
        break;
    case 4:
        echo 'Jueves' . PHP_EOL;
        break;
    case 5:
        echo 'Viernes' . PHP_EOL;
        break;
    default:
        echo 'Fin de semana' . PHP_EOL;
        break;
}
