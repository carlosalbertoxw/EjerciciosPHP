<?php

declare(strict_types=1);

/**
 * Interfaces (introducción)
 * -------------------------
 * Una interfaz es un "contrato": indica QUÉ métodos debe tener una clase,
 * pero no CÓMO los hace. Cada clase que la implementa escribe su propia versión.
 *
 * Ventaja: podemos tratar por igual a objetos distintos mientras cumplan
 * el mismo contrato (todos saben calcular su "area").
 * Ejecuta con:  php 02_poo/interfaces.php
 */

// El contrato: toda Figura debe saber calcular su área.
interface Figura {
    public function area(): float;
}

// Rectangulo cumple el contrato con "implements Figura".
class Rectangulo implements Figura {

    public function __construct(public float $base, public float $altura) {
    }

    // Su forma propia de calcular el área.
    public function area(): float {
        return $this->base * $this->altura;
    }
}

// Circulo también cumple el contrato, pero calcula el área a su manera.
class Circulo implements Figura {

    public function __construct(public float $radio) {
    }

    public function area(): float {
        return M_PI * $this->radio ** 2;
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
