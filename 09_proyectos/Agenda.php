<?php

declare(strict_types=1);

/**
 * Agenda de contactos con persistencia en un archivo JSON.
 * La demostración está en agenda_contactos.php.
 */
class Agenda {

    /** @var array<string, string> nombre => teléfono */
    private array $contactos = [];

    public function __construct(private string $archivo) {
        $this->cargar(); // al iniciar, leemos lo que haya en el archivo
    }

    // CREATE
    public function agregar(string $nombre, string $telefono): void {
        if (isset($this->contactos[$nombre])) {
            throw new InvalidArgumentException("Ya existe el contacto: $nombre");
        }
        $this->contactos[$nombre] = $telefono;
        $this->guardar();
    }

    // READ
    public function buscar(string $nombre): ?string {
        return $this->contactos[$nombre] ?? null;
    }

    /** @return array<string, string> */
    public function todos(): array {
        return $this->contactos;
    }

    // UPDATE
    public function actualizar(string $nombre, string $telefono): void {
        $this->comprobarQueExiste($nombre);
        $this->contactos[$nombre] = $telefono;
        $this->guardar();
    }

    // DELETE
    public function eliminar(string $nombre): void {
        $this->comprobarQueExiste($nombre);
        unset($this->contactos[$nombre]);
        $this->guardar();
    }

    private function comprobarQueExiste(string $nombre): void {
        if (!isset($this->contactos[$nombre])) {
            throw new InvalidArgumentException("No existe el contacto: $nombre");
        }
    }

    // --- Persistencia en JSON ---
    private function cargar(): void {
        if (file_exists($this->archivo)) {
            $this->contactos = json_decode(file_get_contents($this->archivo), true) ?? [];
        }
    }

    private function guardar(): void {
        // JSON_UNESCAPED_UNICODE conserva los acentos en lugar de escribir á.
        $json = json_encode($this->contactos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($this->archivo, $json);
    }
}
