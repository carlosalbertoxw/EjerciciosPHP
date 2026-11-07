<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Prueba de humo: ejecuta cada ejercicio de consola y comprueba que termina bien y
 * sin avisos de PHP. Un ejercicio nuevo queda cubierto sin registrarlo.
 */
final class EjerciciosConsolaTest extends TestCase {

    private const string RAIZ = __DIR__ . '/..';

    /** @return array{int, string} código de salida y lo que imprimió */
    private static function ejecutar(string $comando): array {
        exec(escapeshellarg(PHP_BINARY) . ' -d display_errors=1 -d error_reporting=-1 ' . $comando . ' 2>&1', $salida, $codigo);
        return [$codigo, implode("\n", $salida)];
    }

    /** @return iterable<string, array{string}> */
    public static function ejercicios(): iterable {
        $archivos = array_merge(
            glob(self::RAIZ . '/0[1-4]_*/*.php'),
            glob(self::RAIZ . '/07_*/*.php'),
            glob(self::RAIZ . '/1[0-9]_*/*.php'),
            [
                self::RAIZ . '/08_avanzado/cargador_dinamico/ejemplo.php',
                self::RAIZ . '/09_proyectos/agenda_contactos.php',
                self::RAIZ . '/09_proyectos/todo_list.php',
            ],
        );
        foreach ($archivos as $archivo) {
            yield substr($archivo, strlen(self::RAIZ) + 1) => [$archivo];
        }
    }

    #[DataProvider('ejercicios')]
    public function testSeEjecutaSinErroresNiAvisos(string $archivo): void {
        [$codigo, $salida] = self::ejecutar(escapeshellarg($archivo));

        $this->assertSame(0, $codigo, $salida);
        $this->assertDoesNotMatchRegularExpression('/\b(Warning|Notice|Deprecated|Fatal error):/', $salida);
    }

    /** @return array<string, array{string, int, string}> */
    public static function casosCalculadora(): array {
        return [
            'suma'             => ['5 + 3', 0, '5 + 3 = 8'],
            'multiplicacion'   => ['10 x 4', 0, '10 x 4 = 40'],
            'decimales'        => ['1.5 + 1', 0, '1.5 + 1 = 2.5'],
            'texto rechazado'  => ['abc + 3', 1, 'No es un número: abc'],
            'entre cero'       => ['5 / 0', 1, 'No se puede dividir entre cero'],
            'operador erroneo' => ['5 % 2', 1, 'Operador no válido'],
            'sin argumentos'   => ['', 1, 'Uso:'],
        ];
    }

    #[DataProvider('casosCalculadora')]
    public function testCalculadora(string $argumentos, int $codigoEsperado, string $textoEsperado): void {
        $calculadora = escapeshellarg(self::RAIZ . '/09_proyectos/calculadora.php');
        [$codigo, $salida] = self::ejecutar("$calculadora $argumentos");

        $this->assertSame($codigoEsperado, $codigo, $salida);
        $this->assertStringContainsString($textoEsperado, $salida);
    }
}
