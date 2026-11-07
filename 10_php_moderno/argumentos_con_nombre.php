<?php

declare(strict_types=1);

/**
 * Argumentos con nombre y operador nullsafe
 * -----------------------------------------
 * Dos comodidades de PHP 8 para escribir menos y equivocarse menos.
 * Ejecuta con:  php 10_php_moderno/argumentos_con_nombre.php
 */

echo '== Argumentos con nombre ==' . PHP_EOL;

function crearUsuario(string $nombre, bool $activo = true, string $rol = 'lector'): string {
    return "$nombre, rol: $rol, activo: " . ($activo ? 'sí' : 'no');
}

// Se ve qué significa cada valor y se pueden saltar los que tienen valor por defecto.
echo crearUsuario('Ana', rol: 'admin') . PHP_EOL;

// También funciona con las funciones de PHP.
echo str_pad(string: '7', length: 3, pad_string: '0', pad_type: STR_PAD_LEFT) . PHP_EOL; // 007


echo PHP_EOL . '== Operador nullsafe ( ?-> ) ==' . PHP_EOL;

class Direccion {
    public function __construct(public string $ciudad) {
    }
}

class Cliente {
    public function __construct(public ?Direccion $direccion = null) {
    }
}

$conDireccion = new Cliente(new Direccion('Puebla'));
$sinDireccion = new Cliente();

// Si la parte izquierda es null, devuelve null en lugar de lanzar un error.
echo $conDireccion->direccion?->ciudad . PHP_EOL;                    // Puebla
echo $sinDireccion->direccion?->ciudad ?? 'Sin ciudad', PHP_EOL;     // Sin ciudad
