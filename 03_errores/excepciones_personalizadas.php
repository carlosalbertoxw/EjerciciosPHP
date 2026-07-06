<?php

/**
 * Excepciones personalizadas
 * --------------------------
 * Podemos crear nuestros propios tipos de error extendiendo la clase Exception.
 * Así el código queda más claro y podemos capturar cada tipo por separado.
 * Ejecuta con:  php errores/excepciones_personalizadas.php
 */

// Nuestra propia excepción: hereda todo de Exception.
class SaldoInsuficienteException extends Exception {
}

class CuentaBancaria {

    private float $saldo;

    public function __construct(float $saldoInicial) {
        $this->saldo = $saldoInicial;
    }

    public function retirar(float $monto): void {
        if ($monto > $this->saldo) {
            throw new SaldoInsuficienteException(
                "Saldo insuficiente: tienes $this->saldo y quieres retirar $monto"
            );
        }
        $this->saldo -= $monto;
    }

    public function getSaldo(): float {
        return $this->saldo;
    }
}

$cuenta = new CuentaBancaria(100);

try {
    $cuenta->retirar(30);
    echo 'Retiro exitoso. Saldo: ' . $cuenta->getSaldo() . PHP_EOL; // 70

    $cuenta->retirar(500); // este falla
} catch (SaldoInsuficienteException $e) {
    // capturamos específicamente nuestro tipo de error.
    echo 'Operación rechazada: ' . $e->getMessage() . PHP_EOL;
}

echo 'Saldo final: ' . $cuenta->getSaldo() . PHP_EOL; // 70
