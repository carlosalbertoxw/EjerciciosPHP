<?php

declare(strict_types=1);

/**
 * Librería GD: manipular imágenes
 * -------------------------------
 * La extensión GD permite crear y transformar imágenes desde PHP.
 * Aquí hay funciones que reciben la ruta de una imagen, la transforman y la
 * envían al navegador como JPEG.
 *
 * Este archivo NO se ejecuta directamente: lo usa visor.php. Para ver los
 * resultados abre index.php en el navegador (docker compose up web).
 */

/** Abre una imagen del disco según su tipo (jpg, png o gif). */
function cargarImagen(string $ruta): GdImage {
    $tipo = getimagesize($ruta)['mime'];
    return match ($tipo) {
        'image/jpeg' => imagecreatefromjpeg($ruta),
        'image/png'  => imagecreatefrompng($ruta),
        'image/gif'  => imagecreatefromgif($ruta),
        default      => throw new RuntimeException("Tipo de imagen no soportado: $tipo"),
    };
}

/** Envía la imagen al navegador como JPEG. PHP libera su memoria automáticamente. */
function enviarJpeg(GdImage $imagen): void {
    header('Content-Type: image/jpeg');
    imagejpeg($imagen);
}


/**
 * Redimensiona la imagen para que quepa en 200x200 SIN deformarla: la escala es
 * la menor de las dos, para que ningún lado se pase del máximo.
 */
function imagenProporcional(string $ruta): void {
    [$anchoOrig, $altoOrig] = getimagesize($ruta);
    $escala = min(200 / $anchoOrig, 200 / $altoOrig);
    $ancho  = (int) round($anchoOrig * $escala);
    $alto   = (int) round($altoOrig * $escala);

    $lienzo = imagecreatetruecolor($ancho, $alto);
    imagecopyresampled($lienzo, cargarImagen($ruta), 0, 0, 0, 0, $ancho, $alto, $anchoOrig, $altoOrig);
    enviarJpeg($lienzo);
}


/**
 * Recorta la imagen a 200x100 centrándola: la escala es la mayor de las dos, para
 * que la imagen llene la caja, y se copia solo la zona central que cabe en ella.
 */
function imagenRecortada(string $ruta): void {
    $ancho = 200;
    $alto  = 100;

    [$anchoOrig, $altoOrig] = getimagesize($ruta);
    $escala = max($ancho / $anchoOrig, $alto / $altoOrig);

    // Tamaño de la zona de la imagen original que se va a copiar, y su posición.
    $anchoZona = (int) round($ancho / $escala);
    $altoZona  = (int) round($alto / $escala);
    $x = (int) (($anchoOrig - $anchoZona) / 2);
    $y = (int) (($altoOrig - $altoZona) / 2);

    $lienzo = imagecreatetruecolor($ancho, $alto);
    imagecopyresampled($lienzo, cargarImagen($ruta), 0, 0, $x, $y, $ancho, $alto, $anchoZona, $altoZona);
    enviarJpeg($lienzo);
}


/**
 * Ajusta la imagen a 200x200 exactos SIN respetar la proporción
 * (la estira o encoge para llenar toda la caja).
 */
function imagenEstirada(string $ruta): void {
    enviarJpeg(imagescale(cargarImagen($ruta), 200, 200));
}


/**
 * Crea una imagen que contiene el texto recibido.
 */
function imagenTexto(string $texto): void {
    // imagestring usa la codificación ISO-8859-1; convertimos desde UTF-8.
    $texto = mb_convert_encoding(mb_substr($texto, 0, 100), 'ISO-8859-1', 'UTF-8');

    $ancho = max(1, strlen($texto) * 9);
    $alto  = 20;

    $imagen = imagecreate($ancho, $alto);
    $fondo  = imagecolorallocate($imagen, 255, 255, 255); // blanco
    $tinta  = imagecolorallocate($imagen, 0, 0, 0);       // negro
    imagefill($imagen, 0, 0, $fondo);
    imagestring($imagen, 5, 2, 2, $texto, $tinta);
    enviarJpeg($imagen);
}
