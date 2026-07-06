<?php

/**
 * Proyecto: Agenda de contactos (CRUD con POO + JSON)
 * ---------------------------------------------------
 * Junta: clases, encapsulamiento, arrays, JSON y archivos.
 *
 * CRUD = las 4 operaciones básicas sobre datos:
 *   Create (crear), Read (leer), Update (actualizar), Delete (borrar).
 *
 * Los contactos se guardan en un archivo .json, así que persisten aunque
 * cerremos el programa (a diferencia de todo_list.php, que vive en memoria).
 * Ejecuta con:  php proyectos/agenda_contactos.php
 */

class Agenda {

    private array $contactos = [];

    public function __construct(private string $archivo) {
        $this->cargar(); // al iniciar, leemos lo que haya en el archivo
    }

    // CREATE
    public function agregar(string $nombre, string $telefono): void {
        $this->contactos[$nombre] = $telefono;
        $this->guardar();
    }

    // READ
    public function buscar(string $nombre): ?string {
        return $this->contactos[$nombre] ?? null;
    }

    public function todos(): array {
        return $this->contactos;
    }

    // UPDATE (reutiliza agregar, porque sobrescribe si ya existe)
    public function actualizar(string $nombre, string $telefono): void {
        $this->agregar($nombre, $telefono);
    }

    // DELETE
    public function eliminar(string $nombre): void {
        unset($this->contactos[$nombre]);
        $this->guardar();
    }

    // --- Persistencia en JSON ---
    private function cargar(): void {
        if (file_exists($this->archivo)) {
            $this->contactos = json_decode(file_get_contents($this->archivo), true) ?? [];
        }
    }

    private function guardar(): void {
        file_put_contents($this->archivo, json_encode($this->contactos, JSON_PRETTY_PRINT));
    }
}

// --- Demostración ---
$ruta   = __DIR__ . '/contactos.json';
$agenda = new Agenda($ruta);

// Create
$agenda->agregar('Ana',  '555-1111');
$agenda->agregar('Luis', '555-2222');

// Read
echo 'Teléfono de Ana: ' . $agenda->buscar('Ana') . PHP_EOL;

// Update
$agenda->actualizar('Ana', '555-9999');
echo 'Teléfono de Ana actualizado: ' . $agenda->buscar('Ana') . PHP_EOL;

// Delete
$agenda->eliminar('Luis');

echo PHP_EOL . '== Contactos en la agenda ==' . PHP_EOL;
foreach ($agenda->todos() as $nombre => $telefono) {
    echo "- $nombre: $telefono" . PHP_EOL;
}

// Comprobamos que persistió: creamos otra Agenda que lee el mismo archivo.
echo PHP_EOL . '== Releyendo desde el archivo ==' . PHP_EOL;
$agenda2 = new Agenda($ruta);
echo 'Total de contactos guardados: ' . count($agenda2->todos()) . PHP_EOL;

unlink($ruta); // limpiamos el archivo de ejemplo
