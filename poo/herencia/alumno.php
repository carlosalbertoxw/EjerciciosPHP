<?php

include_once 'persona.php';

class Alumno extends Persona {

    private $numero_control;

    public function set_numero_control($numero_control) {
        $this->numero_control = $numero_control;
    }

    public function get_numero_control() {
        return $this->numero_control;
    }

}
