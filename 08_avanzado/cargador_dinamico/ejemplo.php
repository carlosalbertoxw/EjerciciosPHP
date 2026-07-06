<?php

/**
 * Cargador dinámico de clases
 * ---------------------------
 * Variante avanzada de una "fábrica": la clase Load recibe el NOMBRE de un
 * controlador, incluye automáticamente su archivo (nombre_controller.php) y
 * devuelve una instancia ya lista. Cada controlador vive en su propio archivo.
 *
 * Es una forma sencilla de la idea que hay detrás de los autoloaders y de los
 * frameworks MVC (cargar el controlador que corresponde a cada petición).
 * Para el patrón Factory clásico y autocontenido, mira design_patterns/factory.php
 *
 * Ejecuta con:  php avanzado/cargador_dinamico/ejemplo.php
 */

include_once 'load.php';

// La fábrica nos entrega el controlador de usuarios, sin que sepamos los detalles.
$user = Load::controller('user');
$user->hola('Carlos');

echo PHP_EOL;

// Lo mismo para el controlador de posts.
$post = Load::controller('post');
$post->post();

echo PHP_EOL;
