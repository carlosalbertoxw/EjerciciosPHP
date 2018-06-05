<?php

include_once 'alumno.php';

$alumno = new Alumno();
$alumno->set_nombre('Carlos');
$alumno->set_apellido('Sanches');
$alumno->set_edad('30');
$alumno->set_sexo('masculino');
$alumno->set_numero_control(1409011110);
$alumno->set_cve(1);

print 'Nombre: ' . $alumno->get_nombre() . '<br>';
print 'Apellido: ' . $alumno->get_apellido() . '<br>';
print 'Edad: ' . $alumno->get_edad() . '<br>';
print 'Sexo: ' . $alumno->get_sexo() . '<br>';
print 'NC: ' . $alumno->get_numero_control() . '<br>';
print 'Clave: ' . $alumno->get_cve() . '<br>';
