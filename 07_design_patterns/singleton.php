<?php

/**
 * Patrón Singleton
 * ----------------
 * Garantiza que una clase tenga UNA SOLA instancia en todo el programa y
 * ofrece un punto global para acceder a ella.
 * Típico para: conexión a base de datos, configuración, logs.
 *
 * Cómo se logra:
 *   - el constructor es private (nadie puede hacer "new" desde fuera),
 *   - un método estático getInstancia() crea el objeto la primera vez
 *     y luego siempre devuelve el mismo.
 * Ejecuta con:  php design_patterns/singleton.php
 */

class Configuracion {

    private static ?Configuracion $instancia = null; // aquí se guarda la única instancia
    private array $valores = [];

    // private: impide crear objetos con "new Configuracion()" desde fuera.
    private function __construct() {
    }

    public static function getInstancia(): Configuracion {
        if (self::$instancia === null) {
            self::$instancia = new Configuracion();
            echo '(se creó la instancia por primera vez)' . PHP_EOL;
        }
        return self::$instancia;
    }

    public function set(string $clave, string $valor): void {
        $this->valores[$clave] = $valor;
    }

    public function get(string $clave): ?string {
        return $this->valores[$clave] ?? null;
    }
}

// Primera llamada: se crea la instancia.
$config1 = Configuracion::getInstancia();
$config1->set('idioma', 'es');

// Segunda llamada: NO se crea otra, devuelve la misma de antes.
$config2 = Configuracion::getInstancia();

echo 'Idioma leído desde config2: ' . $config2->get('idioma') . PHP_EOL; // es

// Comprobamos que ambas variables apuntan al MISMO objeto.
var_dump($config1 === $config2); // true
