<?php

/**
 * Cambia la proporción de una imgen a los valores establecidos en la función
 * @param type $img
 */
function proportional_image($img) {
    $image_path = $img;

    $width = 200;
    $high = 200;

    $image_information = getimagesize($image_path);
    $image_width = $image_information[0];
    $image_high = $image_information[1];
    $image_type = $image_information['mime'];


    $original_image = $image_width / $image_high;
    $new_image = $width / $high;

    if ($original_image > $new_image) {
        $new_width = $width;
        $new_high = $width / $original_image;
    } else if ($original_image < $new_image) {
        $new_width = $width * $original_image;
        $new_high = $high;
    } else {
        $new_width = $width;
        $new_high = $high;
    }

    switch ($image_type) {
        case "image/jpg":
        case "image/jpeg":
            $image = imagecreatefromjpeg($image_path);
            break;
        case "image/png":
            $image = imagecreatefrompng($image_path);
            break;
        case "image/gif":
            $image = imagecreatefromgif($image_path);
            break;
    }

    $canvas = imagecreatetruecolor($new_width, $new_high);

    imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_high, $image_width, $image_high);

    //imagejpeg($canvas, "ruta/de/la/nueva_imagen.jpg", 80);//Para guardar la imagen en una carpeta
    Header("Content-type: image/jpeg");
    imagejpeg($canvas);
    imagedestroy($canvas);
}

/**
 * Recorta una imagen a los valores establecidos en la función
 * @param type $img
 */
function cut_image($img) {
    $image_path = $img;

    $width = 200;
    $high = 100;

    $image_information = getimagesize($image_path);
    $image_width = $image_information[0];
    $image_high = $image_information[1];
    $image_type = $image_information['mime'];


    $original_image = $image_width / $image_high;
    $new_image = $width / $high;

    if ($original_image > $new_image) {
        $new_width = $high * $original_image;
        $new_high = $high;
    } else if ($original_image < $new_image) {
        $new_width = $width;
        $new_high = $width / $original_image;
    } else {
        $new_width = $width;
        $new_high = $high;
    }


    $x = ( $new_width - $width ) / 2;
    $y = ( $new_high - $high ) / 2;

    switch ($image_type) {
        case "image/jpg":
        case "image/jpeg":
            $image = imagecreatefromjpeg($image_path);
            break;
        case "image/png":
            $image = imagecreatefrompng($image_path);
            break;
        case "image/gif":
            $image = imagecreatefromgif($image_path);
            break;
    }

    $canvas = imagecreatetruecolor($width, $high);
    $temporary_canvas = imagecreatetruecolor($new_width, $new_high);

    imagecopyresampled($temporary_canvas, $image, 0, 0, 0, 0, $new_width, $new_high, $image_width, $image_high);
    imagecopy($canvas, $temporary_canvas, 0, 0, $x, $y, $width, $high);

    //imagejpeg($canvas, "ruta/de/la/nueva_imagen.jpg", 80);//Para guardar la imagen en una carpeta
    Header("Content-type: image/jpeg");
    imagejpeg($canvas);
    imagedestroy($canvas);
}

/**
 * Estecha una imagen a los valores establecidos en la función
 * @param type $img
 */
function narrow_image($img) {
    $image_path = $img;

    $width = 200;
    $high = 200;

    $image_information = getimagesize($image_path);
    $image_width = $image_information[0];
    $image_high = $image_information[1];
    $image_type = $image_information['mime'];

    switch ($image_type) {
        case "image/jpg":
        case "image/jpeg":
            $image = imagecreatefromjpeg($image_path);
            break;
        case "image/png":
            $image = imagecreatefrompng($image_path);
            break;
        case "image/gif":
            $image = imagecreatefromgif($image_path);
            break;
    }

    $canvas = imagecreatetruecolor($width, $high);

    imagecopyresampled($canvas, $image, 0, 0, 0, 0, $width, $high, $image_width, $image_high);


    //imagejpeg($canvas, "ruta/de/la/nueva_imagen.jpg", 80);//Para guardar la imagen en una carpeta
    Header("Content-type: image/jpeg");
    imagejpeg($canvas);
    imagedestroy($canvas);
}

/**
 * Crea una imagen con el texto pasado en el parametro de la función
 * @param type $texto
 */
function text_image($text) {
    $string = utf8_decode($text);

    $width = (strlen($string) * 9);
    $high = 20;
    $image = imagecreate($width, $high);
    $background_color = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $background_color);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    imagestring($image, 12, 0, 0, $string, $text_color);
    header("Content-type: image/jpg");
    imagejpeg($image);
    imagedestroy($image);
}
