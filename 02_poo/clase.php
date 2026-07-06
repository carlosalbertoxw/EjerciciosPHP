<?php

/**
 * Clases y objetos
 * ----------------
 * Una CLASE es como un molde o plantilla.
 * Un OBJETO es algo concreto creado a partir de ese molde.
 *
 * Definimos la clase Coche y luego creamos coches (objetos), cada uno con sus
 * propios datos. Una clase tiene tres partes principales.
 * Ejecuta con:  php 02_poo/clase.php
 */
class Coche {

    // 1) Propiedades: los datos que guarda cada objeto.
    public $marca;
    public $modelo;
    public $encendido = false;

    // 2) Constructor: se ejecuta AUTOMÁTICAMENTE al crear el objeto (new Coche).
    //    Sirve para dar los valores iniciales. $this se refiere al propio objeto.
    public function __construct($marca, $modelo) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    // 3) Métodos: las acciones que puede realizar el objeto.
    public function encender() {
        $this->encendido = true;
    }

    public function describir() {
        $estado = $this->encendido ? 'encendido' : 'apagado';
        return "Coche: {$this->marca} {$this->modelo} ($estado)";
    }
}

// --- Uso ---
// Creamos dos objetos distintos a partir del mismo molde (la clase Coche).
$coche1 = new Coche('Toyota', 'Corolla');
$coche2 = new Coche('Mazda', '3');

echo $coche1->describir() . PHP_EOL; // apagado
echo $coche2->describir() . PHP_EOL; // apagado

// Cada objeto es independiente: encender uno no afecta al otro.
$coche1->encender();

echo $coche1->describir() . PHP_EOL; // encendido
echo $coche2->describir() . PHP_EOL; // sigue apagado
