<?php

/**
 * Patrón Factory (Fábrica)
 * ------------------------
 * Idea: en vez de crear los objetos con "new" por todos lados, una "fábrica"
 * decide qué clase construir según lo que le pidamos. Quien usa la fábrica no
 * necesita conocer las clases concretas, solo la interfaz común.
 *
 * Ventaja: si mañana agregamos un nuevo tipo, solo tocamos la fábrica;
 * el resto del código sigue igual.
 *
 * Ejemplo: una fábrica de notificaciones que crea Email o SMS según el tipo.
 * Ejecuta con:  php design_patterns/factory.php
 *
 * (En la carpeta factory/ hay una variante avanzada del mismo patrón que
 *  carga cada clase desde su propio archivo.)
 */

// El contrato común: toda notificación sabe enviarse.
interface Notificacion {
    public function enviar(string $mensaje): string;
}

class NotificacionEmail implements Notificacion {
    public function enviar(string $mensaje): string {
        return "Email enviado: $mensaje";
    }
}

class NotificacionSms implements Notificacion {
    public function enviar(string $mensaje): string {
        return "SMS enviado: $mensaje";
    }
}

// La fábrica: recibe un tipo y devuelve el objeto correcto.
class NotificacionFactory {
    public static function crear(string $tipo): Notificacion {
        return match ($tipo) {
            'email' => new NotificacionEmail(),
            'sms'   => new NotificacionSms(),
            default => throw new InvalidArgumentException("Tipo de notificación desconocido: $tipo"),
        };
    }
}

// --- Uso ---
// Pedimos objetos a la fábrica sin usar "new" con la clase concreta.
foreach (['email', 'sms'] as $tipo) {
    $notificacion = NotificacionFactory::crear($tipo);
    echo $notificacion->enviar('Bienvenido :)') . PHP_EOL;
}

// Si pedimos un tipo que no existe, la fábrica avisa con una excepción.
try {
    NotificacionFactory::crear('paloma_mensajera');
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
