<?php

declare(strict_types=1);

/**
 * Carga automática de clases: cuando el código usa una clase que todavía no existe,
 * PHP llama a esta función para que incluya su archivo. Así funcionan los
 * autoloaders; en un proyecto real, Composer lo hace por ti con PSR-4.
 */
spl_autoload_register(function (string $clase): void {
    $ruta = __DIR__ . '/' . basename($clase) . '.php';
    if (is_file($ruta)) {
        require_once $ruta;
    }
});

class Cargador {

    // Lista permitida: el nombre recibido nunca se usa para armar una ruta. Si
    // viniera de la URL, sin esta lista alguien podría pedir "../../otro_archivo"
    // y hacer que el servidor ejecutara un archivo que no debe (inclusión de archivos).
    private const array CONTROLADORES = [
        'user' => UserController::class,
        'post' => PostController::class,
    ];

    // Método Factory parametrizado: recibe un nombre y devuelve el controlador.
    public static function controlador(string $nombre): object {
        $clase = self::CONTROLADORES[$nombre]
            ?? throw new InvalidArgumentException("Controlador no permitido: $nombre");
        return new $clase();
    }
}
