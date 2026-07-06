<?php

/**
 * Clases abstractas
 * -----------------
 * Una clase abstracta es una plantilla incompleta: NO se puede usar con "new"
 * directamente. Sirve como base para otras clases.
 *
 * Puede tener:
 *   - métodos normales (código compartido por todas las hijas), y
 *   - métodos abstractos (solo el nombre; cada hija los debe completar).
 *
 * Diferencia con una interfaz: la clase abstracta SÍ puede incluir código.
 * Ejecuta con:  php poo/clases_abstractas.php
 */

abstract class Animal {

    public string $nombre;

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    // Método abstracto: cada animal hace su propio sonido (obligatorio definirlo).
    abstract public function hacerSonido(): string;

    // Método normal: lo heredan todas las hijas tal cual.
    public function presentarse(): string {
        return "{$this->nombre} dice: " . $this->hacerSonido();
    }
}

class Perro extends Animal {
    public function hacerSonido(): string {
        return 'Guau';
    }
}

class Gato extends Animal {
    public function hacerSonido(): string {
        return 'Miau';
    }
}

$animales = [
    new Perro('Firulais'),
    new Gato('Michi'),
];

foreach ($animales as $animal) {
    echo $animal->presentarse() . PHP_EOL;
}

// new Animal('X'); // <- esto daría error: no se puede instanciar una clase abstracta.
