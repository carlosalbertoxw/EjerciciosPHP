<?php

declare(strict_types=1);

/**
 * Property hooks y visibilidad asimétrica (PHP 8.4)
 * -------------------------------------------------
 * Antes, validar una propiedad obligaba a escribir getters y setters (compara con
 * 02_poo/herencia.php). Ahora la lógica se pone en la propia propiedad.
 * Ejecuta con:  php 10_php_moderno/property_hooks.php
 */

class Producto {

    // Hook "set": se ejecuta al asignar. $value es el valor que se intenta guardar.
    public float $precio {
        set {
            if ($value < 0) {
                throw new InvalidArgumentException('El precio no puede ser negativo');
            }
            $this->precio = $value;
        }
    }

    // Propiedad virtual: no guarda nada, se calcula cada vez que se lee.
    public float $precioConIva {
        get => $this->precio * 1.16;
    }

    // Visibilidad asimétrica: se lee desde cualquier lado, pero solo se cambia aquí.
    public private(set) int $vendidos = 0;

    public function __construct(public string $nombre, float $precio) {
        $this->precio = $precio;
    }

    public function vender(): void {
        $this->vendidos++;
    }
}

$teclado = new Producto('Teclado', 500);
echo "Precio con IVA: {$teclado->precioConIva}" . PHP_EOL; // 580

$teclado->vender();
echo "Vendidos: {$teclado->vendidos}" . PHP_EOL;           // 1

try {
    $teclado->precio = -10;
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}

try {
    $teclado->vendidos = 100; // solo la propia clase puede cambiarlo
} catch (Error $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
