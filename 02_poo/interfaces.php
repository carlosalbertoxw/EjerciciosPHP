<?php

/**
 * Interfaces (introducción)
 * -------------------------
 * Una interfaz es un "contrato": indica QUÉ métodos debe tener una clase,
 * pero no CÓMO los hace. Cada clase que la implementa escribe su propia versión.
 *
 * Ventaja: podemos tratar por igual a objetos distintos mientras cumplan
 * el mismo contrato (todos saben calcular su "area").
 * Ejecuta con:  php poo/interfaces.php
 */

// El contrato: toda Figura debe saber calcular su área.
interface Figura {
    public function area();
}

// Rectangulo cumple el contrato con "implements Figura".
class Rectangulo implements Figura {

    public $base;
    public $altura;

    public function __construct($base, $altura) {
        $this->base = $base;
        $this->altura = $altura;
    }

    // Su forma propia de calcular el área.
    public function area() {
        return $this->base * $this->altura;
    }
}

// Circulo también cumple el contrato, pero calcula el área a su manera.
class Circulo implements Figura {

    public $radio;

    public function __construct($radio) {
        $this->radio = $radio;
    }

    public function area() {
        return 3.1416 * $this->radio ** 2;
    }
}

// Como ambas son Figura, podemos recorrerlas igual aunque sean distintas.
$figuras = [
    new Rectangulo(4, 5),
    new Circulo(3),
];

foreach ($figuras as $figura) {
    echo 'Área: ' . $figura->area() . PHP_EOL;
}
