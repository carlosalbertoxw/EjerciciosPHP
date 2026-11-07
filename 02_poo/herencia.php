<?php

declare(strict_types=1);

/**
 * Encapsulamiento y Herencia
 * --------------------------
 * Este ejercicio junta dos ideas clave de la POO:
 *
 * 1) ENCAPSULAMIENTO: las propiedades son "private", así que solo se pueden ver
 *    o cambiar desde DENTRO de la clase. Para usarlas desde fuera creamos
 *    métodos públicos:
 *      - los "set" (setters) sirven para ASIGNAR un valor.
 *      - los "get" (getters) sirven para LEER un valor.
 *    Así la clase controla cómo se usan sus datos.
 *
 * 2) HERENCIA: con "extends", la clase Alumno HEREDA todo lo de Persona
 *    (propiedades y métodos) y además agrega lo suyo (numeroControl).
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

    public function setCve($cve) {
        $this->cve = $cve;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getCve() {
        return $this->cve;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getSexo() {
        return $this->sexo;
    }
}

// Clase "hija": hereda de Persona y añade lo propio de un alumno.
class Alumno extends Persona {

    private $numeroControl;

    public function setNumeroControl($numeroControl) {
        $this->numeroControl = $numeroControl;
    }

    public function getNumeroControl() {
        return $this->numeroControl;
    }
}

// --- Uso ---
$alumno = new Alumno();

// Métodos heredados de Persona:
$alumno->setNombre('Carlos');
$alumno->setApellido('Sánchez');
$alumno->setEdad(30);
$alumno->setSexo('masculino');
$alumno->setCve(1);

// Método propio de Alumno:
$alumno->setNumeroControl(1409011110);

echo 'Nombre: '   . $alumno->getNombre()          . PHP_EOL;
echo 'Apellido: ' . $alumno->getApellido()        . PHP_EOL;
echo 'Edad: '     . $alumno->getEdad()            . PHP_EOL;
echo 'Sexo: '     . $alumno->getSexo()            . PHP_EOL;
echo 'NC: '       . $alumno->getNumeroControl()  . PHP_EOL;
echo 'Clave: '    . $alumno->getCve()             . PHP_EOL;
