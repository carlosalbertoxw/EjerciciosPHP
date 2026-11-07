<?php

declare(strict_types=1);

/**
 * Proyecto: Agenda de contactos (CRUD con POO + JSON)
 * ---------------------------------------------------
 * Junta: clases, encapsulamiento, arrays, excepciones, JSON y archivos.
 * La clase está en Agenda.php, separada de esta demostración para poder probarla.
 *
 * CRUD = las 4 operaciones básicas sobre datos:
 *   Create (crear), Read (leer), Update (actualizar), Delete (borrar).
 *
 * Los contactos se guardan en un archivo .json, así que persisten aunque
 * cerremos el programa (a diferencia de todo_list.php, que vive en memoria).
 * Ejecuta con:  php 09_proyectos/agenda_contactos.php
 */

require_once __DIR__ . '/Agenda.php';

$ruta   = __DIR__ . '/contactos.json';
$agenda = new Agenda($ruta);

// Create
$agenda->agregar('Ana',  '555-1111');
$agenda->agregar('Luis', '555-2222');

// Read
echo 'Teléfono de Ana: ' . $agenda->buscar('Ana') . PHP_EOL;

// Update
$agenda->actualizar('Ana', '555-9999');
echo 'Teléfono de Ana actualizado: ' . $agenda->buscar('Ana') . PHP_EOL;

// Actualizar a alguien que no existe es un error, no crea un contacto nuevo.
try {
    $agenda->actualizar('Pedro', '555-0000');
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}

// Delete
$agenda->eliminar('Luis');

echo PHP_EOL . '== Contactos en la agenda ==' . PHP_EOL;
foreach ($agenda->todos() as $nombre => $telefono) {
    echo "- $nombre: $telefono" . PHP_EOL;
}

// Comprobamos que persistió: creamos otra Agenda que lee el mismo archivo.
echo PHP_EOL . '== Releyendo desde el archivo ==' . PHP_EOL;
$agenda2 = new Agenda($ruta);
echo 'Total de contactos guardados: ' . count($agenda2->todos()) . PHP_EOL;

unlink($ruta); // limpiamos el archivo de ejemplo
