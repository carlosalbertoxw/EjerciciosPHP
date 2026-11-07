<?php

declare(strict_types=1);

/**
 * Sesiones
 * --------
 * HTTP no recuerda nada entre una petición y otra. Una sesión guarda datos en el
 * servidor y el navegador solo conserva un identificador en una cookie.
 * $_SESSION es un array cuyo contenido sigue ahí en la siguiente visita.
 *
 * Cómo probar:
 *   docker compose up web
 *   abre http://localhost:8080/05_formularios/sesion_contador.php y recarga
 */

// Opciones recomendadas para la cookie de sesión. Debe ir antes de cualquier salida.
session_start([
    'cookie_httponly' => true,   // JavaScript no puede leerla
    'cookie_samesite' => 'Lax',  // no se envía en peticiones de otros sitios
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cerrar la sesión: borra los datos y genera un identificador nuevo.
    $_SESSION = [];
    session_regenerate_id(true);
    // Redirigir evita que recargar la página repita el envío del formulario.
    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    exit;
}

$_SESSION['visitas'] = ($_SESSION['visitas'] ?? 0) + 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesiones</title>
</head>
<body>
    <h1>Contador de visitas con sesiones</h1>
    <p>Has visitado esta página <strong><?= $_SESSION['visitas'] ?></strong> vez/veces. Recarga para comprobarlo.</p>
    <form method="post">
        <button type="submit">Reiniciar la sesión</button>
    </form>
</body>
</html>
