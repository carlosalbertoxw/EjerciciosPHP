<?php

declare(strict_types=1);

class UserController {

    public function hola(string $usuario): void {
        echo 'Hola ' . $usuario . ' :)';
    }
}
