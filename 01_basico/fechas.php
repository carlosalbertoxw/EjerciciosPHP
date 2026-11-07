<?php

/**
 * Fechas y horas
 * --------------
 * La función date() da formato a la fecha/hora actual.
 * Ejecuta con:  php 01_basico/fechas.php
 */

// Sin esto se usa la zona del servidor (en Docker, UTC) y la hora saldría distinta.
date_default_timezone_set('America/Mexico_City');

// Letras de formato más comunes:
//   d = día (01-31)     m = mes (01-12)     Y = año (4 dígitos)
//   H = hora (00-23)    i = minutos         s = segundos

echo 'Fecha de hoy: '   . date('d/m/Y')        . PHP_EOL;
echo 'Hora actual: '    . date('H:i:s')        . PHP_EOL;
echo 'Fecha y hora: '   . date('d/m/Y H:i:s')  . PHP_EOL;
echo 'Solo el año: '    . date('Y')            . PHP_EOL;


echo PHP_EOL . '== Trabajar con una fecha concreta (DateTimeImmutable) ==' . PHP_EOL;

// DateTimeImmutable no cambia al operar: cada método devuelve una fecha NUEVA.
$fecha = new DateTimeImmutable('2026-07-05');
echo 'Fecha creada: ' . $fecha->format('d/m/Y') . PHP_EOL;

// Sumar 7 días a la fecha:
$unaSemanaDespues = $fecha->modify('+7 days');
echo 'Una semana después: ' . $unaSemanaDespues->format('d/m/Y') . PHP_EOL;
echo 'La original no cambió: ' . $fecha->format('d/m/Y') . PHP_EOL;

// diff calcula la diferencia entre dos fechas.
echo 'Días de diferencia: ' . $fecha->diff($unaSemanaDespues)->days . PHP_EOL; // 7
