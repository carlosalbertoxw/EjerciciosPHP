<?php

declare(strict_types=1);

/**
 * Guardar contraseñas de forma segura
 * -----------------------------------
 * Una contraseña NUNCA se guarda como texto, ni con md5 o sha1, que son demasiado
 * rápidos de atacar. password_hash genera un hash lento, con su propia sal, y
 * password_verify lo comprueba sin que exista forma de recuperar el original.
 * Ejecuta con:  php 11_base_de_datos/contrasenas.php
 */

$contrasena = 'mi-Contraseña-de-ejemplo';

// PASSWORD_DEFAULT usa el algoritmo recomendado en cada versión de PHP.
$hash = password_hash($contrasena, PASSWORD_DEFAULT);
echo 'Esto es lo que se guarda en la base de datos:' . PHP_EOL . $hash . PHP_EOL;

// La sal es aleatoria: la misma contraseña genera cada vez un hash distinto.
var_dump($hash === password_hash($contrasena, PASSWORD_DEFAULT)); // false

echo PHP_EOL . '== Comprobar al iniciar sesión ==' . PHP_EOL;
var_dump(password_verify($contrasena, $hash));       // true
var_dump(password_verify('otra-contraseña', $hash)); // false

// Al iniciar sesión se puede actualizar el hash si el algoritmo recomendado cambió.
echo PHP_EOL . '¿Hay que volver a generarlo? ';
echo password_needs_rehash($hash, PASSWORD_DEFAULT) ? 'Sí' : 'No';
echo PHP_EOL;
