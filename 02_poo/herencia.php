<?php

/**
 * Encapsulamiento y Herencia
 * --------------------------
 * Este ejercicio junta dos ideas clave de la POO:
 *
 * 1) ENCAPSULAMIENTO: las propiedades son "private", así que solo se pueden ver
 *    o cambiar desde DENTRO de la clase. Para usarlas desde fuera creamos
 *    métodos públicos:
 *      - los "set_" (setters) sirven para ASIGNAR un valor.
 *      - los "get_" (getters) sirven para LEER un valor.
 *    Así la clase controla cómo se usan sus datos.
 *
 * 2) HERENCIA: con "extends", la clase Alumno HEREDA todo lo de Persona
 *    (propiedades y métodos) y además agrega lo suyo (numero_control).
 *    Se reutiliza código sin repetirlo: un Alumno ES una Persona.
 *
 * (Para la versión moderna y más corta de una clase, mira propiedades_tipadas.php)
 * Ejecuta con:  php 02_poo/herencia.php
 */

// Clase base o "padre".
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

// Clase "hija": hereda de Persona y añade lo propio de un alumno.
class Alumno extends Persona {

    private $numero_control;

    public function set_numero_control($numero_control) {
        $this->numero_control = $numero_control;
    }

    public function get_numero_control() {
        return $this->numero_control;
    }
}

// --- Uso ---
$alumno = new Alumno();

// Métodos heredados de Persona:
$alumno->set_nombre('Carlos');
$alumno->set_apellido('Sánchez');
$alumno->set_edad(30);
$alumno->set_sexo('masculino');
$alumno->set_cve(1);

// Método propio de Alumno:
$alumno->set_numero_control(1409011110);

echo 'Nombre: '   . $alumno->get_nombre()          . PHP_EOL;
echo 'Apellido: ' . $alumno->get_apellido()        . PHP_EOL;
echo 'Edad: '     . $alumno->get_edad()            . PHP_EOL;
echo 'Sexo: '     . $alumno->get_sexo()            . PHP_EOL;
echo 'NC: '       . $alumno->get_numero_control()  . PHP_EOL;
echo 'Clave: '    . $alumno->get_cve()             . PHP_EOL;
