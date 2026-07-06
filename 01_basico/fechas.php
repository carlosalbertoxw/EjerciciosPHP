<?php

/**
 * Fechas y horas
 * --------------
 * La función date() da formato a la fecha/hora actual.
 * Ejecuta con:  php fechas.php
 */

// Letras de formato más comunes:
//   d = día (01-31)     m = mes (01-12)     Y = año (4 dígitos)
//   H = hora (00-23)    i = minutos         s = segundos

echo 'Fecha de hoy: '   . date('d/m/Y')        . PHP_EOL; // 05/07/2026
echo 'Hora actual: '    . date('H:i:s')        . PHP_EOL;
echo 'Fecha y hora: '   . date('d/m/Y H:i:s')  . PHP_EOL;
echo 'Solo el año: '    . date('Y')            . PHP_EOL;


echo PHP_EOL . '== Trabajar con una fecha concreta (DateTime) ==' . PHP_EOL;

// DateTime es una clase moderna para manejar fechas.
$fecha = new DateTime('2026-07-05');
echo 'Fecha creada: ' . $fecha->format('d/m/Y') . PHP_EOL;

// Sumar 7 días a la fecha:
$fecha->modify('+7 days');
echo 'Una semana después: ' . $fecha->format('d/m/Y') . PHP_EOL;
