<?php

declare(strict_types=1);

/**
 * Generadores (yield)
 * -------------------
 * Una función con yield entrega los valores de uno en uno, solo cuando se piden, en
 * lugar de construir un array completo. Sirve para datos muy grandes o infinitos.
 * Ejecuta con:  php 10_php_moderno/generadores.php
 */

function contarHasta(int $limite): Generator {
    for ($i = 1; $i <= $limite; $i++) {
        yield $i; // pausa aquí hasta que se pida el siguiente valor
    }
}

foreach (contarHasta(3) as $numero) {
    echo $numero . PHP_EOL;
}


echo PHP_EOL . '== Secuencia infinita ==' . PHP_EOL;

function fibonacci(): Generator {
    [$a, $b] = [0, 1];
    while (true) {
        yield $a;
        [$a, $b] = [$b, $a + $b];
    }
}

foreach (fibonacci() as $posicion => $valor) {
    if ($posicion === 10) {
        break; // quien recorre decide cuándo parar
    }
    echo $valor . ' ';
}
echo PHP_EOL;


echo PHP_EOL . '== Ahorro de memoria ==' . PHP_EOL;

$antes = memory_get_usage();
$lista = range(1, 500_000);
echo 'Array de 500 000 elementos: ' . round((memory_get_usage() - $antes) / 1024 / 1024, 1) . ' MB' . PHP_EOL;
unset($lista);

$antes = memory_get_usage();
$generador = contarHasta(500_000);
echo 'Generador equivalente: ' . round((memory_get_usage() - $antes) / 1024, 1) . ' KB' . PHP_EOL;
