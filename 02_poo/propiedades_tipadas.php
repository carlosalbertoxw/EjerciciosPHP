<?php

/**
 * Propiedades tipadas y "constructor promotion" (PHP 8)
 * -----------------------------------------------------
 * Esta es la forma MODERNA de escribir clases, más corta que la clásica.
 * Compárala con poo/herencia/persona.php (versión con getters/setters manuales).
 *
 * Novedades que se muestran aquí:
 *   - Tipos en las propiedades (string, int...): PHP valida que el dato sea correcto.
 *   - Constructor promotion: declarar y asignar las propiedades en el propio
 *     constructor, sin repetirlas arriba.
 *   - readonly: una propiedad que solo se puede asignar una vez (no cambia después).
 * Ejecuta con:  php poo/propiedades_tipadas.php
 */

class Persona {

    // Antes necesitabas: declarar la propiedad + asignarla en el constructor.
    // Ahora se hace todo en una línea poniendo la visibilidad delante del parámetro.
    public function __construct(
        public readonly string $nombre,
        public int $edad,
        public string $ciudad = 'Desconocida', // valor por defecto
    ) {
    }

    public function saludar(): string {
        return "Hola, soy {$this->nombre} y tengo {$this->edad} años ({$this->ciudad}).";
    }
}

$persona = new Persona('Carlos', 30, 'México');
echo $persona->saludar() . PHP_EOL;

// Podemos leer las propiedades directamente:
echo 'Nombre: ' . $persona->nombre . PHP_EOL;

// La edad sí se puede cambiar:
$persona->edad = 31;
echo 'Nueva edad: ' . $persona->edad . PHP_EOL;

// nombre es readonly: intentar cambiarlo daría error (por eso está comentado).
// $persona->nombre = 'Otro'; // Error: Cannot modify readonly property

// El valor por defecto también funciona:
$otra = new Persona('Ana', 25);
echo $otra->saludar() . PHP_EOL; // ciudad = Desconocida
