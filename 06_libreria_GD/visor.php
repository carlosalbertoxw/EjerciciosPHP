<?php

declare(strict_types=1);

/**
 * Visor de imágenes (router)
 * --------------------------
 * Lee de la URL el tipo de transformación (?type=) y el nombre de la imagen
 * (?img-name=), y llama a la función correspondiente de gd.php.
 * La respuesta es directamente una imagen JPEG; por eso este archivo se usa
 * dentro de un <img src="visor.php?..."> (ver index.php).
 */

require_once __DIR__ . '/gd.php';

$tipo   = filter_input(INPUT_GET, 'type');
$nombre = filter_input(INPUT_GET, 'img-name') ?? '';

// Aquí img-name es el TEXTO a dibujar, no un archivo.
if ($tipo === 'text-img') {
    imagenTexto($nombre);
    exit;
}

$funcion = match ($tipo) {
    'proporcional' => imagenProporcional(...),
    'cortar'       => imagenRecortada(...),
    'estrechar'    => imagenEstirada(...),
    default        => null,
};

if ($funcion === null) {
    http_response_code(400);
    exit('Parámetro "type" no válido');
}

// basename() evita que se pida un archivo fuera de esta carpeta (seguridad).
$ruta = __DIR__ . '/' . basename($nombre);

if (!is_file($ruta) || getimagesize($ruta) === false) {
    http_response_code(404);
    exit('Imagen no encontrada');
}

$funcion($ruta);
