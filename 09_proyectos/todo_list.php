<?php

/**
 * Proyecto: Lista de tareas (en memoria)
 * --------------------------------------
 * Junta: arrays asociativos, funciones y bucles.
 *
 * Guardamos las tareas en un array. Cada tarea es un array con su texto y si
 * está completada o no. Como no usamos base de datos, los datos viven solo
 * mientras corre el script (en memoria).
 * Ejecuta con:  php proyectos/todo_list.php
 */

// El array de tareas se pasa por referencia (&) para poder modificarlo.
function agregarTarea(array &$tareas, string $texto): void {
    $tareas[] = ['texto' => $texto, 'hecha' => false];
}

function completarTarea(array &$tareas, int $indice): void {
    if (isset($tareas[$indice])) {
        $tareas[$indice]['hecha'] = true;
    }
}

function mostrarTareas(array $tareas): void {
    if (count($tareas) === 0) {
        echo '(no hay tareas)' . PHP_EOL;
        return;
    }
    foreach ($tareas as $i => $tarea) {
        $marca = $tarea['hecha'] ? '[x]' : '[ ]';
        echo "$i. $marca {$tarea['texto']}" . PHP_EOL;
    }
}

// --- Demostración ---
$tareas = [];

agregarTarea($tareas, 'Estudiar PHP');
agregarTarea($tareas, 'Hacer ejercicio');
agregarTarea($tareas, 'Comprar café');

echo '== Lista inicial ==' . PHP_EOL;
mostrarTareas($tareas);

// Marcamos la tarea 0 como completada.
completarTarea($tareas, 0);

echo PHP_EOL . '== Después de completar la primera ==' . PHP_EOL;
mostrarTareas($tareas);

// Un pequeño resumen.
$pendientes = count(array_filter($tareas, fn($t) => !$t['hecha']));
echo PHP_EOL . "Tareas pendientes: $pendientes de " . count($tareas) . PHP_EOL;
