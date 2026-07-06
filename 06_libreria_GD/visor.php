<?php

/**
 * Visor de imágenes (router)
 * --------------------------
 * Lee de la URL el tipo de transformación (?type=) y el nombre de la imagen
 * (?img-name=), y llama a la función correspondiente de gd.php.
 * La respuesta es directamente una imagen JPEG; por eso este archivo se usa
 * dentro de un <img src="visor.php?..."> (ver index.php).
 */

include_once 'gd.php';

$tipo   = filter_input(INPUT_GET, 'type');
$nombre = filter_input(INPUT_GET, 'img-name') ?? '';

// basename() evita que se pida un archivo fuera de esta carpeta (seguridad).
$ruta = __DIR__ . '/' . basename($nombre);

match ($tipo) {
    'proporcional' => imagen_proporcional($ruta),
    'cortar'       => imagen_recortada($ruta),
    'estrechar'    => imagen_estirada($ruta),
    'text-img'     => imagen_texto($nombre), // aquí img-name es el TEXTO a dibujar
    default        => print('Parámetro "type" no válido'),
};
