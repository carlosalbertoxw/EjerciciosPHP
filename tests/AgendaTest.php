<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../09_proyectos/Agenda.php';

final class AgendaTest extends TestCase {

    private string $archivo;

    protected function setUp(): void {
        $this->archivo = tempnam(sys_get_temp_dir(), 'agenda');
        unlink($this->archivo); // la agenda debe funcionar aunque el archivo no exista
    }

    protected function tearDown(): void {
        if (file_exists($this->archivo)) {
            unlink($this->archivo);
        }
    }

    public function testAgregarYBuscar(): void {
        $agenda = new Agenda($this->archivo);
        $agenda->agregar('Ana', '555-1111');

        $this->assertSame('555-1111', $agenda->buscar('Ana'));
        $this->assertNull($agenda->buscar('Luis'));
    }

    public function testAgregarUnContactoRepetidoEsUnError(): void {
        $agenda = new Agenda($this->archivo);
        $agenda->agregar('Ana', '555-1111');

        $this->expectException(InvalidArgumentException::class);
        $agenda->agregar('Ana', '555-2222');
    }

    public function testActualizarUnContactoInexistenteEsUnError(): void {
        $this->expectException(InvalidArgumentException::class);
        (new Agenda($this->archivo))->actualizar('Nadie', '555-0000');
    }

    public function testEliminar(): void {
        $agenda = new Agenda($this->archivo);
        $agenda->agregar('Ana', '555-1111');
        $agenda->eliminar('Ana');

        $this->assertSame([], $agenda->todos());
    }

    public function testLosDatosPersistenYConservanLosAcentos(): void {
        (new Agenda($this->archivo))->agregar('José', '555-1111');

        $this->assertSame('555-1111', (new Agenda($this->archivo))->buscar('José'));
        $this->assertStringContainsString('José', file_get_contents($this->archivo));
    }
}
