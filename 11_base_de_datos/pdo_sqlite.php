<?php

declare(strict_types=1);

/**
 * Base de datos con PDO y SQLite
 * ------------------------------
 * PDO es la forma estándar de hablar con bases de datos en PHP. SQLite no necesita
 * servidor: aquí la base vive en memoria y desaparece al terminar el script. Para
 * usar MySQL o PostgreSQL, casi solo cambia la cadena de conexión.
 * Ejecuta con:  php 11_base_de_datos/pdo_sqlite.php
 */

// ERRMODE_EXCEPTION: un error de SQL lanza una excepción en vez de pasar inadvertido.
$pdo = new PDO('sqlite::memory:', options: [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$pdo->exec('CREATE TABLE contactos (
    id INTEGER PRIMARY KEY,
    nombre TEXT NOT NULL,
    telefono TEXT NOT NULL UNIQUE
)');


echo '== Create: consulta preparada ==' . PHP_EOL;
// Los datos van aparte de la consulta, marcados con :nombre. NUNCA los concatenes al
// SQL: es la causa de la inyección SQL.
$insertar = $pdo->prepare('INSERT INTO contactos (nombre, telefono) VALUES (:nombre, :telefono)');
$insertar->execute(['nombre' => 'Ana', 'telefono' => '555-1111']);
$insertar->execute(['nombre' => 'Luis', 'telefono' => '555-2222']);
echo 'Último id insertado: ' . $pdo->lastInsertId() . PHP_EOL;


echo PHP_EOL . '== Read ==' . PHP_EOL;
foreach ($pdo->query('SELECT id, nombre, telefono FROM contactos ORDER BY nombre') as $fila) {
    echo "{$fila['id']}. {$fila['nombre']}: {$fila['telefono']}" . PHP_EOL;
}


echo PHP_EOL . '== Update ==' . PHP_EOL;
$actualizar = $pdo->prepare('UPDATE contactos SET telefono = :telefono WHERE nombre = :nombre');
$actualizar->execute(['telefono' => '555-9999', 'nombre' => 'Ana']);
echo 'Filas modificadas: ' . $actualizar->rowCount() . PHP_EOL;


echo PHP_EOL . '== La consulta preparada neutraliza la inyección SQL ==' . PHP_EOL;
// Con concatenación, este texto borraría la condición del WHERE y traería todas las filas.
$entradaMaliciosa = "x' OR '1'='1";
$buscar = $pdo->prepare('SELECT nombre FROM contactos WHERE nombre = :nombre');
$buscar->execute(['nombre' => $entradaMaliciosa]);
echo 'Resultados: ' . count($buscar->fetchAll()) . PHP_EOL; // 0: se trata como un simple texto


echo PHP_EOL . '== Transacción: todo o nada ==' . PHP_EOL;
$pdo->beginTransaction();
try {
    $insertar->execute(['nombre' => 'Marta', 'telefono' => '555-3333']);
    $insertar->execute(['nombre' => 'Otro', 'telefono' => '555-3333']); // teléfono repetido: falla
    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack(); // deshace también el INSERT de Marta
    echo 'Se revirtió la transacción por un teléfono repetido' . PHP_EOL;
}


echo PHP_EOL . '== Delete ==' . PHP_EOL;
$borrar = $pdo->prepare('DELETE FROM contactos WHERE nombre = :nombre');
$borrar->execute(['nombre' => 'Luis']);
echo 'Contactos restantes: ' . $pdo->query('SELECT COUNT(*) FROM contactos')->fetchColumn() . PHP_EOL; // 1
