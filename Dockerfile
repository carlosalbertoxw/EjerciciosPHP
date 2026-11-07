# Imagen de PHP para los ejercicios: agrega la extensión GD (necesaria para
# 06_libreria_GD/) y Composer (para instalar PHPUnit y correr las pruebas).
FROM php:8.5.12-cli-alpine3.23

# Las librerías sin "-dev" se quedan porque GD las usa al ejecutarse. Las "-dev"
# solo hacen falta para compilar la extensión, así que se eliminan al terminar.
RUN apk add --no-cache freetype libjpeg-turbo libpng unzip \
    && apk add --no-cache --virtual .dependencias-gd freetype-dev libjpeg-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd \
    && apk del .dependencias-gd

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app
