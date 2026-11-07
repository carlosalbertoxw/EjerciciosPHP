# EjerciciosPHP

Colección de ejercicios sencillos para aprender **PHP** paso a paso, desde lo más
básico (variables, bucles, condicionales) hasta programación orientada a objetos,
patrones de diseño, bases de datos y pequeños proyectos integradores. Cada archivo es
autónomo, está muy comentado y al ejecutarlo muestra su resultado en pantalla.

Las carpetas están numeradas siguiendo el orden de estudio sugerido: empieza por
`01_basico/` y avanza hacia arriba.

## Requisitos

Necesitas **una** de estas dos opciones:

- **PHP 8.5** instalado en tu equipo, con las extensiones `gd`, `mbstring` y `pdo_sqlite`, o
- **Docker** (para ejecutar los ejercicios sin instalar PHP). Ver más abajo.

## Cómo ejecutar los ejercicios

Todos los comandos se ejecutan desde la raíz del repositorio.

### Opción A — con PHP instalado

```bash
php 01_basico/arrays.php
```

Para los ejercicios del navegador:

```bash
php -S localhost:8080
```

### Opción B — con Docker (sin instalar PHP)

Este repo incluye un `docker-compose.yml` listo para usar.

```bash
# Ejecutar un ejercicio de consola:
docker compose run --rm php php 01_basico/arrays.php

# Abrir una consola interactiva de PHP:
docker compose run --rm php php -a

# Ejercicios que se ven en el navegador (formularios, libreria_GD):
docker compose up web
# luego abre http://localhost:8080
```

La primera vez Docker construirá la imagen de PHP; después queda en caché y es
instantáneo.

## Contenido

### 📗 `01_basico/` — Fundamentos del lenguaje
| Archivo | Tema |
|---|---|
| [hola_mundo.php](01_basico/hola_mundo.php) | Mostrar texto con `echo` / `print` |
| [tipos_de_datos.php](01_basico/tipos_de_datos.php) | int, float, string, bool, null y `var_dump()` |
| [constantes.php](01_basico/constantes.php) | Constantes con `define()` y `const` |
| [operadores.php](01_basico/operadores.php) | Operadores aritméticos, comparación, lógicos y asignación |
| [conversion_tipos.php](01_basico/conversion_tipos.php) | Casting y comparación `==` vs `===` |
| [if_else.php](01_basico/if_else.php) | Condicionales `if` / `elseif` / `else` |
| [ternario.php](01_basico/ternario.php) | Operador ternario y null coalescing (`??`) |
| [switch.php](01_basico/switch.php) | Estructura `switch` |
| [match.php](01_basico/match.php) | Estructura `match` (PHP 8) |
| [for.php](01_basico/for.php) | Bucle `for` |
| [while.php](01_basico/while.php) | Bucle `while` |
| [do_while.php](01_basico/do_while.php) | Bucle `do / while` |
| [break_continue.php](01_basico/break_continue.php) | `break` y `continue` en bucles |
| [foreach.php](01_basico/foreach.php) | Recorrer arrays con `foreach` |
| [arrays.php](01_basico/arrays.php) | Arrays simples y asociativos |
| [arrays_funciones.php](01_basico/arrays_funciones.php) | `array_map`, `array_filter`, `array_reduce`... |
| [arrays_multidimensionales.php](01_basico/arrays_multidimensionales.php) | Arrays dentro de arrays (tablas) |
| [funciones.php](01_basico/funciones.php) | Definir y usar funciones |
| [funciones_avanzadas.php](01_basico/funciones_avanzadas.php) | Referencias, `...args`, closures y arrow functions |
| [strings.php](01_basico/strings.php) | Manejo de cadenas de texto |
| [strings_formato.php](01_basico/strings_formato.php) | `sprintf`, `number_format`, `str_pad`... |
| [expresiones_regulares.php](01_basico/expresiones_regulares.php) | `preg_match` / `preg_replace` |
| [fechas.php](01_basico/fechas.php) | Fechas y horas con `date()` y `DateTimeImmutable` |

### 📘 `02_poo/` — Programación Orientada a Objetos
A partir de esta carpeta, todos los ejercicios usan `declare(strict_types=1)`.

| Archivo | Tema |
|---|---|
| [clase.php](02_poo/clase.php) | Definir una clase, constructor, propiedades y métodos |
| [herencia.php](02_poo/herencia.php) | Encapsulamiento (`private` + getters/setters) y herencia |
| [constantes_y_estaticos.php](02_poo/constantes_y_estaticos.php) | Constantes de clase y miembros `static` |
| [interfaces.php](02_poo/interfaces.php) | Interfaces como "contrato" entre clases |
| [clases_abstractas.php](02_poo/clases_abstractas.php) | Clases y métodos `abstract` |
| [traits.php](02_poo/traits.php) | Reutilizar métodos con `trait` |
| [propiedades_tipadas.php](02_poo/propiedades_tipadas.php) | Tipos, `constructor promotion` y `readonly` |

### 🧩 `03_errores/` — Manejo de errores
| Archivo | Tema |
|---|---|
| [try_catch.php](03_errores/try_catch.php) | `try` / `catch` / `finally`, `throw` y `Error` frente a `Exception` |
| [excepciones_personalizadas.php](03_errores/excepciones_personalizadas.php) | Crear tu propia clase de excepción |

### 🗂️ `04_archivos/` — Lectura y escritura de archivos
| Archivo | Tema |
|---|---|
| [archivos.php](04_archivos/archivos.php) | Leer/escribir texto (`file_get_contents`, `file_put_contents`) |
| [leer_json.php](04_archivos/leer_json.php) | `json_encode` / `json_decode` |
| [leer_csv.php](04_archivos/leer_csv.php) | Leer y escribir CSV (`fgetcsv` / `fputcsv`) |

### 📝 `05_formularios/` — Datos de formularios (navegador)
| Archivo | Tema |
|---|---|
| [formulario_post.php](05_formularios/formulario_post.php) | Leer `$_POST` y protegerse de XSS |
| [formulario_get.php](05_formularios/formulario_get.php) | Leer `$_GET` (un buscador) |
| [validar_datos.php](05_formularios/validar_datos.php) | Validar en el servidor con `filter_var` |
| [sesion_contador.php](05_formularios/sesion_contador.php) | Recordar datos entre visitas con sesiones |

> Estos se ven en el navegador: levanta el servidor y entra desde el índice en http://localhost:8080

### 🖼️ `06_libreria_GD/` — Imágenes con la librería GD
| Archivo | Tema |
|---|---|
| [index.php](06_libreria_GD/index.php) | Galería que muestra las imágenes originales y transformadas |
| [gd.php](06_libreria_GD/gd.php) | Funciones GD: redimensionar, recortar, estirar y generar texto |
| [visor.php](06_libreria_GD/visor.php) | Router que devuelve cada imagen ya transformada |

> Se ven en el navegador: http://localhost:8080/06_libreria_GD/
> Requiere la extensión **GD**, que el `Dockerfile` incluido ya instala automáticamente.

### 📙 `07_design_patterns/` — Patrones de diseño
| Archivo | Patrón |
|---|---|
| [factory.php](07_design_patterns/factory.php) | Factory (fábrica que crea el objeto correcto según un tipo) |
| [singleton.php](07_design_patterns/singleton.php) | Singleton (una única instancia) |
| [strategy.php](07_design_patterns/strategy.php) | Strategy (intercambiar algoritmos) |
| [observer.php](07_design_patterns/observer.php) | Observer (notificar a suscriptores) |

### 🧠 `08_avanzado/` — Ejemplos avanzados
| Archivo | Tema |
|---|---|
| [cargador_dinamico/ejemplo.php](08_avanzado/cargador_dinamico/ejemplo.php) | Autoload con `spl_autoload_register` y lista permitida (la idea detrás de los frameworks MVC) |

### 🚀 `09_proyectos/` — Proyectos integradores
| Archivo | Descripción |
|---|---|
| [calculadora.php](09_proyectos/calculadora.php) | Calculadora por línea de comandos (usa `$argv`) |
| [todo_list.php](09_proyectos/todo_list.php) | Lista de tareas en memoria |
| [agenda_contactos.php](09_proyectos/agenda_contactos.php) | CRUD de contactos con POO + JSON (clase en [Agenda.php](09_proyectos/Agenda.php)) |

### ✨ `10_php_moderno/` — PHP moderno
| Archivo | Tema |
|---|---|
| [enums.php](10_php_moderno/enums.php) | Enumeraciones |
| [namespaces.php](10_php_moderno/namespaces.php) | Espacios de nombres |
| [atributos.php](10_php_moderno/atributos.php) | Atributos, `#[Override]` y Reflection |
| [argumentos_con_nombre.php](10_php_moderno/argumentos_con_nombre.php) | Argumentos con nombre y operador `?->` |
| [generadores.php](10_php_moderno/generadores.php) | Generadores con `yield` |
| [property_hooks.php](10_php_moderno/property_hooks.php) | Property hooks y visibilidad asimétrica (PHP 8.4) |
| [novedades_recientes.php](10_php_moderno/novedades_recientes.php) | `array_find` (PHP 8.4) y operador pipe `\|>` (PHP 8.5) |

### 🗄️ `11_base_de_datos/` — Bases de datos y contraseñas
| Archivo | Tema |
|---|---|
| [pdo_sqlite.php](11_base_de_datos/pdo_sqlite.php) | CRUD con PDO, consultas preparadas, inyección SQL y transacciones |
| [contrasenas.php](11_base_de_datos/contrasenas.php) | `password_hash` y `password_verify` |

## Recomendación de estudio

Sigue las carpetas en el orden en que están numeradas: `01_basico` → `02_poo` →
`03_errores` → `04_archivos` → `05_formularios` → `06_libreria_GD` →
`07_design_patterns` → `08_avanzado` → `09_proyectos` → `10_php_moderno` →
`11_base_de_datos`.

## Pruebas

Las pruebas usan PHPUnit: ejecutan todos los ejercicios de consola, levantan el servidor
integrado para probar los del navegador y comprueban la clase `Agenda`.

```bash
docker compose run --rm php composer install
docker compose run --rm php vendor/bin/phpunit
```

## Licencia

[MIT](LICENSE)
