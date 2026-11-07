<?php

declare(strict_types=1);

/**
 * Atributos
 * ---------
 * Son metadatos que se agregan al código con #[...]. PHP trae algunos, como #[Override],
 * y puedes crear los tuyos y leerlos con Reflection; así declaran rutas los frameworks.
 * Ejecuta con:  php 10_php_moderno/atributos.php
 */

// Un atributo propio es una clase marcada con #[Attribute].
#[Attribute(Attribute::TARGET_METHOD)]
class Ruta {
    public function __construct(public string $url) {
    }
}

class Base {
    public function saludar(): string {
        return 'Hola';
    }
}

class Paginas extends Base {

    // #[Override] avisa con un error si el método del padre deja de existir
    // o si te equivocas al escribir el nombre.
    #[Override]
    public function saludar(): string {
        return 'Hola desde Paginas';
    }

    #[Ruta('/inicio')]
    public function inicio(): string {
        return 'Página de inicio';
    }

    #[Ruta('/contacto')]
    public function contacto(): string {
        return 'Página de contacto';
    }
}

// Reflection permite inspeccionar la clase y leer sus atributos.
$paginas = new Paginas();
foreach ((new ReflectionClass($paginas))->getMethods() as $metodo) {
    foreach ($metodo->getAttributes(Ruta::class) as $atributo) {
        $ruta = $atributo->newInstance();
        echo "{$ruta->url} -> " . $metodo->invoke($paginas) . PHP_EOL;
    }
}
