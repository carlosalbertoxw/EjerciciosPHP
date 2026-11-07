<?php

declare(strict_types=1);

/**
 * Enumeraciones (enum)
 * --------------------
 * Un enum define un conjunto cerrado de valores posibles. A diferencia de usar textos
 * sueltos como 'pagado', el error de escribir 'pagdo' se detecta de inmediato.
 * Ejecuta con:  php 10_php_moderno/enums.php
 */

// Enum respaldado: cada caso tiene un valor, útil para guardarlo en una base de datos.
enum Estado: string {
    case Pendiente = 'pendiente';
    case Pagado    = 'pagado';
    case Cancelado = 'cancelado';

    // Un enum puede tener métodos.
    public function etiqueta(): string {
        return match ($this) {
            self::Pendiente => 'Esperando el pago',
            self::Pagado    => 'Pago recibido',
            self::Cancelado => 'Pedido cancelado',
        };
    }
}

// Los parámetros pueden exigir un valor del enum: un texto no pasaría.
function describir(Estado $estado): string {
    return "{$estado->name}: {$estado->etiqueta()}";
}

echo describir(Estado::Pagado) . PHP_EOL;

echo PHP_EOL . '== Del texto al enum ==' . PHP_EOL;
echo Estado::from('cancelado')->name . PHP_EOL;              // Cancelado
var_dump(Estado::tryFrom('no-existe'));                      // NULL en lugar de un error

echo PHP_EOL . '== Todos los casos ==' . PHP_EOL;
foreach (Estado::cases() as $caso) {
    echo "{$caso->name} => {$caso->value}" . PHP_EOL;
}
