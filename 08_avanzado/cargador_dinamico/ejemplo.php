<?php

declare(strict_types=1);

/**
 * Cargador dinámico de clases
 * ---------------------------
 * Variante avanzada de una "fábrica": la clase Cargador recibe el NOMBRE de un
 * controlador y devuelve una instancia ya lista. Cada controlador vive en su propio
 * archivo, y spl_autoload_register lo incluye automáticamente la primera vez que
 * se usa la clase.
 *
 * Es la idea que hay detrás de los autoloaders y de los frameworks MVC (cargar el
 * controlador que corresponde a cada petición). Fíjate en que Cargador solo acepta
 * los nombres de una lista: los datos del usuario nunca deben decidir qué archivo se
 * incluye.
 * Para el patrón Factory clásico y autocontenido, mira 07_design_patterns/factory.php
 *
 * Ejecuta con:  php 08_avanzado/cargador_dinamico/ejemplo.php
 */

require_once __DIR__ . '/Cargador.php';

// La fábrica nos entrega el controlador de usuarios, sin que sepamos los detalles.
$user = Cargador::controlador('user');
$user->hola('Carlos');

echo PHP_EOL;

// Lo mismo para el controlador de posts.
$post = Cargador::controlador('post');
$post->post();

echo PHP_EOL;

// Un nombre fuera de la lista se rechaza antes de tocar ningún archivo.
try {
    Cargador::controlador('../../otro_archivo');
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
