<?php

/**
 * Patrón Strategy (Estrategia)
 * ----------------------------
 * Permite intercambiar el ALGORITMO que usa un objeto en tiempo de ejecución.
 * Cada algoritmo se encapsula en su propia clase que cumple una interfaz común.
 *
 * Ejemplo: una tienda que calcula el precio final aplicando distintos
 * descuentos (sin descuento, por porcentaje, cliente VIP). Podemos cambiar
 * la estrategia sin tocar la clase que la usa.
 * Ejecuta con:  php design_patterns/strategy.php
 */

// El contrato común a todas las estrategias de descuento.
interface Descuento {
    public function aplicar(float $precio): float;
}

class SinDescuento implements Descuento {
    public function aplicar(float $precio): float {
        return $precio;
    }
}

class DescuentoPorcentaje implements Descuento {
    public function __construct(private float $porcentaje) {
    }

    public function aplicar(float $precio): float {
        return $precio - ($precio * $this->porcentaje / 100);
    }
}

class DescuentoVip implements Descuento {
    public function aplicar(float $precio): float {
        return $precio * 0.5; // los VIP pagan la mitad
    }
}

// La clase que USA la estrategia; no le importa cuál sea, solo que sepa "aplicar".
class Carrito {
    public function __construct(private Descuento $estrategia) {
    }

    public function cambiarEstrategia(Descuento $estrategia): void {
        $this->estrategia = $estrategia;
    }

    public function total(float $precio): float {
        return $this->estrategia->aplicar($precio);
    }
}

$carrito = new Carrito(new SinDescuento());
echo 'Sin descuento:  ' . $carrito->total(100) . PHP_EOL; // 100

$carrito->cambiarEstrategia(new DescuentoPorcentaje(20));
echo 'Con 20%:        ' . $carrito->total(100) . PHP_EOL; // 80

$carrito->cambiarEstrategia(new DescuentoVip());
echo 'Cliente VIP:    ' . $carrito->total(100) . PHP_EOL; // 50
