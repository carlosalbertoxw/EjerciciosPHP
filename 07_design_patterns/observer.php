<?php

/**
 * Patrón Observer (Observador)
 * ----------------------------
 * Define una relación "uno a muchos": cuando un objeto (el sujeto) cambia,
 * avisa automáticamente a todos los que están suscritos (los observadores).
 *
 * Ejemplo: un canal de noticias que notifica a sus suscriptores cada vez
 * que publica algo. Se pueden agregar o quitar suscriptores sin tocar el canal.
 * Ejecuta con:  php design_patterns/observer.php
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

    public function publicar(string $noticia): void {
        echo "Publicando: $noticia" . PHP_EOL;
        // Avisa a todos los suscriptores.
        foreach ($this->observadores as $o) {
            $o->actualizar($noticia);
        }
    }
}

$canal = new CanalNoticias();
$canal->suscribir(new Suscriptor('Ana'));
$canal->suscribir(new Suscriptor('Luis'));

$canal->publicar('PHP 8.4 ya está disponible');
