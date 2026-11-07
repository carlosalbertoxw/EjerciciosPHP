<?php

declare(strict_types=1);

/**
 * Espacios de nombres (namespace)
 * -------------------------------
 * Permiten que dos clases se llamen igual sin chocar, como dos archivos con el mismo
 * nombre en carpetas distintas. Lo normal es un namespace por archivo, que coincide
 * con su carpeta (PSR-4). Aquí van varios en un archivo solo para verlo de un vistazo.
 * Ejecuta con:  php 10_php_moderno/namespaces.php
 */

namespace Tienda\Ventas {

    class Reporte {
        public function titulo(): string {
            return 'Reporte de ventas';
        }
    }
}

namespace Tienda\Inventario {

    class Reporte {
        public function titulo(): string {
            return 'Reporte de inventario';
        }
    }
}

namespace {

    // use importa una clase, y "as" le da otro nombre para evitar el choque.
    use Tienda\Ventas\Reporte as ReporteVentas;
    use Tienda\Inventario\Reporte as ReporteInventario;

    echo (new ReporteVentas())->titulo() . PHP_EOL;
    echo (new ReporteInventario())->titulo() . PHP_EOL;

    // ::class da el nombre completo de la clase, sin crear ningún objeto.
    echo ReporteVentas::class . PHP_EOL; // Tienda\Ventas\Reporte
}
