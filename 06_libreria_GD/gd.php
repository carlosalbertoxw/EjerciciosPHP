<?php

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

/** Abre una imagen del disco según su tipo (jpg, png o gif) y devuelve el recurso GD. */
function cargar_imagen(string $ruta) {
    $tipo = getimagesize($ruta)['mime'];
    return match ($tipo) {
        'image/jpeg', 'image/jpg' => imagecreatefromjpeg($ruta),
        'image/png'               => imagecreatefrompng($ruta),
        'image/gif'               => imagecreatefromgif($ruta),
        default                   => throw new RuntimeException("Tipo de imagen no soportado: $tipo"),
    };
}

/** Envía un recurso GD al navegador como JPEG y libera la memoria. */
function enviar_jpeg($imagen): void {
    header('Content-type: image/jpeg');
    imagejpeg($imagen);
    imagedestroy($imagen);
}


/**
 * Redimensiona la imagen para que quepa en 200x200 SIN deformarla
 * (mantiene la proporción original).
 */
function imagen_proporcional(string $ruta): void {
    $anchoMax = 200;
    $altoMax  = 200;

    [$anchoOrig, $altoOrig] = getimagesize($ruta);
    $proporcionOrig  = $anchoOrig / $altoOrig;
    $proporcionCaja  = $anchoMax / $altoMax;

    if ($proporcionOrig > $proporcionCaja) {
        $ancho = $anchoMax;
        $alto  = $anchoMax / $proporcionOrig;
    } elseif ($proporcionOrig < $proporcionCaja) {
        $ancho = $altoMax * $proporcionOrig;
        $alto  = $altoMax;
    } else {
        $ancho = $anchoMax;
        $alto  = $altoMax;
    }

    $original = cargar_imagen($ruta);
    $lienzo   = imagecreatetruecolor((int) $ancho, (int) $alto);
    imagecopyresampled($lienzo, $original, 0, 0, 0, 0, (int) $ancho, (int) $alto, $anchoOrig, $altoOrig);
    enviar_jpeg($lienzo);
}


/**
 * Recorta la imagen a 200x100 centrándola (rellena la caja y corta lo que sobra).
 */
function imagen_recortada(string $ruta): void {
    $ancho = 200;
    $alto  = 100;

    [$anchoOrig, $altoOrig] = getimagesize($ruta);
    $proporcionOrig = $anchoOrig / $altoOrig;
    $proporcionCaja = $ancho / $alto;

    if ($proporcionOrig > $proporcionCaja) {
        $anchoTmp = $alto * $proporcionOrig;
        $altoTmp  = $alto;
    } elseif ($proporcionOrig < $proporcionCaja) {
        $anchoTmp = $ancho;
        $altoTmp  = $ancho / $proporcionOrig;
    } else {
        $anchoTmp = $ancho;
        $altoTmp  = $alto;
    }

    // Desplazamiento para centrar el recorte.
    $x = (int) (($anchoTmp - $ancho) / 2);
    $y = (int) (($altoTmp - $alto) / 2);

    $original    = cargar_imagen($ruta);
    $lienzo      = imagecreatetruecolor($ancho, $alto);
    $lienzoTemp  = imagecreatetruecolor((int) $anchoTmp, (int) $altoTmp);

    imagecopyresampled($lienzoTemp, $original, 0, 0, 0, 0, (int) $anchoTmp, (int) $altoTmp, $anchoOrig, $altoOrig);
    imagecopy($lienzo, $lienzoTemp, 0, 0, $x, $y, $ancho, $alto);
    enviar_jpeg($lienzo);
}


/**
 * Ajusta la imagen a 200x200 exactos SIN respetar la proporción
 * (la estira o encoge para llenar toda la caja).
 */
function imagen_estirada(string $ruta): void {
    $ancho = 200;
    $alto  = 200;

    [$anchoOrig, $altoOrig] = getimagesize($ruta);

    $original = cargar_imagen($ruta);
    $lienzo   = imagecreatetruecolor($ancho, $alto);
    imagecopyresampled($lienzo, $original, 0, 0, 0, 0, $ancho, $alto, $anchoOrig, $altoOrig);
    enviar_jpeg($lienzo);
}


/**
 * Crea una imagen que contiene el texto recibido.
 */
function imagen_texto(string $texto): void {
    // imagestring usa la codificación ISO-8859-1; convertimos desde UTF-8
    // (reemplazo moderno de utf8_decode, que quedó obsoleto en PHP 8).
    $texto = mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');

    $ancho = max(1, strlen($texto) * 9);
    $alto  = 20;

    $imagen  = imagecreate($ancho, $alto);
    $fondo   = imagecolorallocate($imagen, 255, 255, 255); // blanco
    $tinta   = imagecolorallocate($imagen, 0, 0, 0);       // negro
    imagefill($imagen, 0, 0, $fondo);
    imagestring($imagen, 5, 2, 2, $texto, $tinta);
    enviar_jpeg($imagen);
}
