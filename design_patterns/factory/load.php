<?php

class Load {

    // Método Factory parametrizado
    public static function controller($controller_name) {
        if (include_once $controller_name . '_controller.php') {
            $classname = ucfirst($controller_name) . '_controller';
            return new $classname;
        } else {
            throw new Exception('File not found: ' . $controller_name . '_controller');
        }
    }

}
