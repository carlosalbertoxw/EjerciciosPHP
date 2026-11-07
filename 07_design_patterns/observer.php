<?php

declare(strict_types=1);

/**
 * Patrón Observer (Observador)
 * ----------------------------
 * Define una relación "uno a muchos": cuando un objeto (el sujeto) cambia,
 * avisa automáticamente a todos los que están suscritos (los observadores).
 *
 * Ejemplo: un canal de noticias que notifica a sus suscriptores cada vez
 * que publica algo. Se pueden agregar o quitar suscriptores sin tocar el canal.
 * Ejecuta con:  php 07_design_patterns/observer.php
 */

// Contrato de un observador: debe saber reaccionar a una notificación.
interface Observador {
    public function actualizar(string $noticia): void;
}

class Suscriptor implements Observador {
    public function __construct(private string $nombre) {
    }

    public function actualizar(string $noticia): void {
        echo "{$this->nombre} recibió: \"$noticia\"" . PHP_EOL;
    }
}

// El sujeto observado: mantiene la lista de suscriptores y les avisa.
class CanalNoticias {

    /** @var Observador[] */
    private array $observadores = [];

    public function suscribir(Observador $o): void {
        $this->observadores[] = $o;
    }

    public function desuscribir(Observador $o): void {
        // array_filter conserva a todos menos al que se va.
        $this->observadores = array_filter($this->observadores, fn($actual) => $actual !== $o);
    }

    public function publicar(string $noticia): void {
        echo "Publicando: $noticia" . PHP_EOL;
        // Avisa a todos los suscriptores.
        foreach ($this->observadores as $o) {
            $o->actualizar($noticia);
        }
    }
}

$canal = new CanalNoticias();
$ana  = new Suscriptor('Ana');
$luis = new Suscriptor('Luis');
$canal->suscribir($ana);
$canal->suscribir($luis);

$canal->publicar('Hay una nueva versión de PHP');

// Luis deja de recibir noticias, sin tocar nada de la clase CanalNoticias.
$canal->desuscribir($luis);
$canal->publicar('Mañana hay mantenimiento');
