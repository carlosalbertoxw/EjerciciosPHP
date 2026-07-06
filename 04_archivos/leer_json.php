<?php

/**
 * Trabajar con JSON
 * -----------------
 * JSON es un formato de texto muy usado para intercambiar datos (APIs, config).
 *   - json_encode: convierte un array/objeto de PHP a texto JSON.
 *   - json_decode: convierte texto JSON de vuelta a datos de PHP.
 * Ejecuta con:  php archivos/leer_json.php
 */

echo '== De PHP a JSON (json_encode) ==' . PHP_EOL;
$producto = [
    'nombre' => 'Teclado',
    'precio' => 499.90,
    'tags'   => ['gaming', 'usb'],
];

// JSON_PRETTY_PRINT lo formatea con saltos de línea para leerlo mejor.
$json = json_encode($producto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo $json . PHP_EOL;


echo PHP_EOL . '== De JSON a PHP (json_decode) ==' . PHP_EOL;
$textoJson = '{"nombre":"Ana","edad":25,"activo":true}';

// El segundo parámetro "true" lo convierte en array asociativo.
$datos = json_decode($textoJson, true);

echo 'Nombre: ' . $datos['nombre'] . PHP_EOL; // Ana
echo 'Edad: '   . $datos['edad']   . PHP_EOL; // 25
var_dump($datos['activo']); // bool(true)


echo PHP_EOL . '== Guardar y leer JSON en un archivo ==' . PHP_EOL;
$ruta = __DIR__ . '/datos.json';
file_put_contents($ruta, json_encode($producto));

$leido = json_decode(file_get_contents($ruta), true);
echo 'Producto leído del archivo: ' . $leido['nombre'] . PHP_EOL;

unlink($ruta); // limpiamos el archivo de ejemplo
