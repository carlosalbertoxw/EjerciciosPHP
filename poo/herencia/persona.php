<?php

class Persona {

    private $cve;
    private $nombre;
    private $apellido;
    private $edad;
    private $sexo;

    public function set_cve($cve) {
        $this->cve = $cve;
    }

    public function set_nombre($nombre) {
        $this->nombre = $nombre;
    }

    public function set_apellido($apellido) {
        $this->apellido = $apellido;
    }

    public function set_edad($edad) {
        $this->edad = $edad;
    }

    public function set_sexo($sexo) {
        $this->sexo = $sexo;
    }

    public function get_cve() {
        return $this->cve;
    }

    public function get_nombre() {
        return $this->nombre;
    }

    public function get_apellido() {
        return $this->apellido;
    }

    public function get_edad() {
        return $this->edad;
    }

    public function get_sexo() {
        return $this->sexo;
    }

}
