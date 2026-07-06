<?php

/**
 * Estructura match (PHP 8)
 * ------------------------
 * match es una versión moderna y más segura de switch:
 *   - devuelve un valor directamente (podemos asignarlo a una variable),
 *   - compara de forma estricta (=== , compara valor Y tipo),
 *   - no necesita "break".
 * Ejecuta con:  php match.php
 */

$codigo = 404;

$mensaje = match ($codigo) {
    200         => 'OK',
    301, 302    => 'Redirección',      // varios valores comparten resultado
    404         => 'No encontrado',
    500         => 'Error del servidor',
    default     => 'Código desconocido',
};

echo "HTTP $codigo: $mensaje" . PHP_EOL;


echo PHP_EOL . '== Comparación estricta ==' . PHP_EOL;

$valor = '1'; // texto, no número

// switch usaría comparación floja; match compara con === (tipo incluido).
$resultado = match ($valor) {
    1       => 'número uno',
    '1'     => 'texto uno',   // este coincide, porque $valor es un string
    default => 'ninguno',
};

echo $resultado . PHP_EOL; // texto uno
