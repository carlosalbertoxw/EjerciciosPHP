<?php

/**
 * Constantes y miembros estáticos
 * -------------------------------
 * - const:  un valor fijo que no cambia, asociado a la clase.
 * - static: una propiedad o método que pertenece a la CLASE, no a cada objeto.
 *
 * Para acceder a constantes y miembros estáticos se usa :: (no ->),
 * porque no necesitamos crear un objeto con "new".
 * Ejecuta con:  php poo/constantes_y_estaticos.php
 */
class Configuracion {

    // Constante: su valor nunca cambia.
    const VERSION = '1.0';

    // Propiedad estática: es COMPARTIDA por toda la clase (una sola copia).
    public static $contadorUsuarios = 0;

    // Método estático: se puede llamar sin crear un objeto.
    // self:: se refiere a la propia clase.
    public static function saludar() {
        return 'Bienvenido a la app v' . self::VERSION;
    }
}

// Acceder a la constante y al método estático con :: (sin usar "new"):
echo Configuracion::VERSION . PHP_EOL;   // 1.0
echo Configuracion::saludar() . PHP_EOL; // Bienvenido a la app v1.0

// La propiedad estática es la misma para todos: cada cambio se acumula.
Configuracion::$contadorUsuarios++;
Configuracion::$contadorUsuarios++;
echo 'Usuarios registrados: ' . Configuracion::$contadorUsuarios . PHP_EOL; // 2
