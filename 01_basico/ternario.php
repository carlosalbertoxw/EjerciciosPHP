<?php

/**
 * Operador ternario y "null coalescing"
 * -------------------------------------
 * Son atajos para escribir condiciones cortas en una sola línea.
 * Ejecuta con:  php ternario.php
 */

echo '== Operador ternario ( condición ? si : no ) ==' . PHP_EOL;

$edad = 20;

// Forma larga con if/else:
if ($edad >= 18) {
    $mensaje = 'Mayor de edad';
} else {
    $mensaje = 'Menor de edad';
}
echo $mensaje . PHP_EOL;

// Misma lógica, pero en una sola línea con el operador ternario:
$mensaje = $edad >= 18 ? 'Mayor de edad' : 'Menor de edad';
echo $mensaje . PHP_EOL;


echo PHP_EOL . '== Null coalescing ( ?? ) ==' . PHP_EOL;

// ?? devuelve el valor de la izquierda si existe; si no, el de la derecha.
// Muy útil para valores que podrían no estar definidos (ej. datos de un formulario).
$datos = ['nombre' => 'Carlos'];

$nombre = $datos['nombre'] ?? 'Invitado';
$ciudad = $datos['ciudad'] ?? 'Desconocida'; // 'ciudad' no existe -> usa el valor por defecto

echo "Nombre: $nombre" . PHP_EOL; // Carlos
echo "Ciudad: $ciudad" . PHP_EOL; // Desconocida
