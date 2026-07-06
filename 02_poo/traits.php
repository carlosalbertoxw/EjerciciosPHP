<?php

/**
 * Traits
 * ------
 * Un trait es un conjunto de métodos que podemos "pegar" dentro de varias
 * clases para reutilizar código, incluso si esas clases no están relacionadas
 * por herencia. Se incluyen con la palabra "use" dentro de la clase.
 * Ejecuta con:  php poo/traits.php
 */

// Este trait agrega la capacidad de registrar mensajes.
trait Registrable {
    public function registrar(string $mensaje): void {
        echo '[LOG] ' . $mensaje . PHP_EOL;
    }
}

// Dos clases distintas reutilizan el mismo trait.
class Usuario {
    use Registrable;

    public function __construct(public string $nombre) {
    }

    public function crear(): void {
        $this->registrar("Usuario '{$this->nombre}' creado");
    }
}

class Pedido {
    use Registrable;

    public function __construct(public int $numero) {
    }

    public function confirmar(): void {
        $this->registrar("Pedido #{$this->numero} confirmado");
    }
}

$usuario = new Usuario('Ana');
$usuario->crear();

$pedido = new Pedido(1001);
$pedido->confirmar();

// Ambas clases obtuvieron el método registrar() sin repetir código.
