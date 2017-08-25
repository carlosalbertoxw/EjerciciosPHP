<?php

/**
 * La estructura de una clase en php consta de tres partes
 */
class Clase {

    //1 - Declaración de variables
    public $hola;
    public $nombre;

    //2 - El constructor
    function __construct($nombre) {
        $this->hola = 'Hola';
        $this->nombre = $nombre;
        print $this->decir_hola();
        print ' ';
        print $this->imprimir_nombre();
    }

    //3 - Declaración de funciones
    public function decir_hola() {
        return $this->hola;
    }

    public function imprimir_nombre() {
        return $this->nombre;
    }

}
