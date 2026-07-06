<?php

class Load {

    // Método Factory parametrizado: recibe un nombre y devuelve el controlador.
    public static function controller($controller_name) {
        // __DIR__ asegura que se busque el archivo junto a esta clase,
        // sin importar desde qué carpeta ejecutemos el script.
        $ruta = __DIR__ . '/' . $controller_name . '_controller.php';
        if (include_once $ruta) {
            $classname = ucfirst($controller_name) . '_controller';
            return new $classname;
        } else {
            throw new Exception('File not found: ' . $controller_name . '_controller');
        }
    }

}
