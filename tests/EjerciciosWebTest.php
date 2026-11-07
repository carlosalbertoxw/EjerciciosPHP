<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/** Levanta el servidor integrado de PHP y prueba los ejercicios del navegador. */
final class EjerciciosWebTest extends TestCase {

    private const string BASE = 'http://127.0.0.1:8791';

    /** @var resource|null */
    private static $servidor = null;

    public static function setUpBeforeClass(): void {
        $comando = [PHP_BINARY, '-d', 'display_errors=1', '-S', '127.0.0.1:8791', '-t', __DIR__ . '/..'];
        self::$servidor = proc_open($comando, [1 => ['file', '/dev/null', 'w'], 2 => ['file', '/dev/null', 'w']], $tuberias);

        for ($intento = 0; $intento < 50; $intento++) {
            $conexion = @fsockopen('127.0.0.1', 8791, timeout: 0.1);
            if ($conexion !== false) {
                fclose($conexion);
                return;
            }
            usleep(100_000);
        }
        self::fail('El servidor de pruebas no arrancó');
    }

    public static function tearDownAfterClass(): void {
        proc_terminate(self::$servidor);
        proc_close(self::$servidor);
    }

    /** @return array{int, string, array<int, string>} código, cuerpo y cabeceras */
    private function pedir(string $ruta, ?array $datosPost = null): array {
        $opciones = ['ignore_errors' => true, 'follow_location' => 0];
        if ($datosPost !== null) {
            $opciones += [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query($datosPost),
            ];
        }
        $cuerpo    = file_get_contents(self::BASE . $ruta, false, stream_context_create(['http' => $opciones]));
        $cabeceras = http_get_last_response_headers();
        preg_match('/\s(\d{3})\s/', $cabeceras[0], $coincidencia);
        return [(int) $coincidencia[1], $cuerpo, $cabeceras];
    }

    /** @return array<string, array{string}> */
    public static function paginas(): array {
        return [
            'indice'    => ['/'],
            'post'      => ['/05_formularios/formulario_post.php'],
            'get'       => ['/05_formularios/formulario_get.php'],
            'validar'   => ['/05_formularios/validar_datos.php'],
            'sesion'    => ['/05_formularios/sesion_contador.php'],
            'galeria'   => ['/06_libreria_GD/index.php'],
        ];
    }

    #[DataProvider('paginas')]
    public function testLaPaginaCargaSinErrores(string $ruta): void {
        [$codigo, $cuerpo] = $this->pedir($ruta);

        $this->assertSame(200, $codigo);
        $this->assertDoesNotMatchRegularExpression('/\b(Warning|Notice|Deprecated|Fatal error):/', $cuerpo);
    }

    public function testElIndiceSoloEnlazaPaginasQueExisten(): void {
        [, $cuerpo] = $this->pedir('/');
        preg_match_all('/href="([^"]+)"/', $cuerpo, $enlaces);

        $this->assertNotEmpty($enlaces[1]);
        foreach ($enlaces[1] as $enlace) {
            $this->assertFileExists(__DIR__ . '/../' . $enlace);
        }
    }

    public function testFormularioPostEscapaUnaSolaVez(): void {
        [, $apostrofo] = $this->pedir('/05_formularios/formulario_post.php', ['nombre' => "O'Brien"]);
        $this->assertStringContainsString('¡Hola, O&#039;Brien!', $apostrofo);
        $this->assertStringNotContainsString('&amp;#039;', $apostrofo);

        [, $codigoMalicioso] = $this->pedir('/05_formularios/formulario_post.php', ['nombre' => '<script>x</script>']);
        $this->assertStringNotContainsString('<script>x', $codigoMalicioso);
    }

    public function testBuscadorEscapaLaBusqueda(): void {
        [, $cuerpo] = $this->pedir('/05_formularios/formulario_get.php?q=' . urlencode('<b>pi'));
        $this->assertStringNotContainsString('<b>pi', $cuerpo);
    }

    public function testValidarDatos(): void {
        [, $invalidos] = $this->pedir('/05_formularios/validar_datos.php', ['correo' => 'malo', 'edad' => '200']);
        $this->assertStringContainsString('Escribe un correo válido', $invalidos);
        $this->assertStringContainsString('entre 0 y 120', $invalidos);

        [, $validos] = $this->pedir('/05_formularios/validar_datos.php', ['correo' => 'a@b.com', 'edad' => '30']);
        $this->assertStringContainsString('Datos correctos', $validos);
    }

    /** @return array<string, array{string}> */
    public static function imagenes(): array {
        return [
            'proporcional' => ['type=proporcional&img-name=image1.jpg'],
            'recortada'    => ['type=cortar&img-name=image1.jpg'],
            'estirada'     => ['type=estrechar&img-name=image2.jpg'],
            'texto'        => ['type=text-img&img-name=Hola+desde+GD'],
        ];
    }

    #[DataProvider('imagenes')]
    public function testVisorDevuelveUnaImagenValida(string $consulta): void {
        [$codigo, $cuerpo, $cabeceras] = $this->pedir("/06_libreria_GD/visor.php?$consulta");

        $this->assertSame(200, $codigo);
        $this->assertContains('Content-Type: image/jpeg', $cabeceras);
        $this->assertNotFalse(getimagesizefromstring($cuerpo), 'La respuesta no es una imagen: ' . substr($cuerpo, 0, 200));
    }

    public function testRecorteTieneElTamanoExacto(): void {
        [, $cuerpo] = $this->pedir('/06_libreria_GD/visor.php?type=cortar&img-name=image1.jpg');
        [$ancho, $alto] = getimagesizefromstring($cuerpo);

        $this->assertSame([200, 100], [$ancho, $alto]);
    }

    public function testVisorRechazaPeticionesInvalidas(): void {
        $this->assertSame(400, $this->pedir('/06_libreria_GD/visor.php?type=otro')[0]);
        $this->assertSame(404, $this->pedir('/06_libreria_GD/visor.php?type=cortar&img-name=no-existe.jpg')[0]);
        $this->assertSame(404, $this->pedir('/06_libreria_GD/visor.php?type=cortar&img-name=gd.php')[0]);
        // basename() deja solo "composer.json", que no está en la carpeta del visor.
        $this->assertSame(404, $this->pedir('/06_libreria_GD/visor.php?type=cortar&img-name=../composer.json')[0]);
    }
}
